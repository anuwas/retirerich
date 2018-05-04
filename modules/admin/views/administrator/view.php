<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Administrator */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Administrators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrator-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->administratorid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->administratorid], [
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
            'administratorid',
            'name',
            'email:email',
            'password',
            'active',
            'lastLogin',
        ],
    ]) ?>

</div>
