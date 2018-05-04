<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HotelCorporaterate */

$this->title = 'Update Hotel Corporaterate: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Hotel Corporaterates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hotel-corporaterate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
