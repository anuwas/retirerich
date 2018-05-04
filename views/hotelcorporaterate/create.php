<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HotelCorporaterate */

$this->title = 'Create Hotel Corporaterate';
$this->params['breadcrumbs'][] = ['label' => 'Hotel Corporaterates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-corporaterate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
