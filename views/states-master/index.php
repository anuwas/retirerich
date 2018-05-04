<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatesMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'States Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="states-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create States Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'code',
            'add_on',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
