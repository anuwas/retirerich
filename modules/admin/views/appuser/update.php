<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Appuser */

$this->title = 'Update Appuser: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Appusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->appuser_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
