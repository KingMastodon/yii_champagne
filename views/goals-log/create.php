<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\GoalsLog $model */

$this->title = 'Create Goals Log';
$this->params['breadcrumbs'][] = ['label' => 'Goals Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goals-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
