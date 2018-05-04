<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StatesMaster */

$this->title = 'Update States Master: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'States Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="states-master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
