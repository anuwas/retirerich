<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Goal */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Goals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_id',
            'pro_cat_id',
            'goal_type',
            'goal_amount',
            'goal_period',
            'sip_amount',
            'lumsum_amount',
            'goal_start_date',
            'goal_end_date',
            'sip_date',
            'investment_start_date',
            'investment_end_date',
            'created_date',
            'modified_date',
            'created_by',
            'goal_status',
            'status',
        ],
    ]) ?>

</div>
