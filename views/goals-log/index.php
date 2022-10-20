<?php

use app\models\GoalsLog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\GoalsLogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Goals Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goals-log-index">

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
            'created_at',
            'goal:ntext',
            'price',
            'data_provider',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, GoalsLog $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $column) {
                        return Html::a(
                            'Подтвердить',
                            Url::to(['goals-log/set-approved', 'id' => $model->id]), 

                            [
                                'id'=>'grid-custom-button',
                                'action'=>Url::to(['goals-log/set-approved', 'id' => $model->id]),
                                
                            ]

                        );

                }

            ],

        ],
    ]); ?>


</div>
