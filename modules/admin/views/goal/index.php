<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GoalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Goal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_id',
            'pro_cat_id',
            'goal_type',
            'goal_amount',
            // 'goal_period',
            // 'sip_amount',
            // 'lumsum_amount',
            // 'goal_start_date',
            // 'goal_end_date',
            // 'sip_date',
            // 'investment_start_date',
            // 'investment_end_date',
            // 'created_date',
            // 'modified_date',
            // 'created_by',
            // 'goal_status',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
