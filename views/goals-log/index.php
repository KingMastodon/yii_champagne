<?php

use app\models\GoalsLog;
use app\models\GoalsApis;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var app\models\GoalsLogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Goals Logs';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="goals-log-index">
<?php 
$form = ActiveForm::begin(['id' => 'form',  'action' => 'goals-log/set-approved']); 
$model2 = new GoalsApis;
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Goals Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [         

            'id',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('d-m-Y H:i:s', $model->created_at);
                },
                'format' => 'raw',
            ],
            'goal:ntext',
            'price',
            'data_provider',
            'status',
            [
                'attribute' => 'status',
                'value' =>function($model){                    
                    return GoalsLog::STATUS_MAP[$model->status];
                },
                'format' =>'raw', 
            ],

           
            [
            'label' => 'Выбор поставщика',
            'value' =>function($model){
                if($model->data_provider){
                    $GoalsApi = GoalsApis::findOne(['id' =>$model->data_provider]);
                    return $GoalsApi->base_url;
                }else{
                    return Html::dropDownList(
                        'id', 
                        $model->data_provider,
                        ArrayHelper::map(GoalsApis::find()->all(), 'id', 'base_url'),
                        ['id' =>'goal_id_' . $model->id]   
                    );
                }                     

                },
            'format' =>'raw', 
            ],
            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $column) {
                    $options = ['class' => 'btn btn-save', 'id'=>$model->id];
                    return Html::tag('div', 'Подтвердить событие', $options);
                }

            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, GoalsLog $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],

        ],
    ]); ?>
    
<?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS

$('.btn-save').click(function(event){

    var goal_id = event.target.id;
    
    var selected_goal_api_id = "#goal_id_" + goal_id;
    var api_provider_id = $(selected_goal_api_id).val();
    console.log(api_provider_id);
    window.location.href = 'set-approved?goalId=' + goal_id + '&apiId=' + api_provider_id;
    
    /*$.ajax({
        type: 'POST',
        url: 'set-approved',
        data: {'goalId' : goal_id, apiId : selected_goal_api_id},
        success: function(data){
            window.location.href
        }
    });*/
});

JS;
$this->registerJs($script);
?>