<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HotelCorporaterateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hotel Corporaterates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-corporaterate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hotel Corporaterate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hotel_id',
            'start_date',
            'end_date',
            'price',
            // 'created_by',
            // 'active',
            // 'created_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
