<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GoalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'pro_cat_id') ?>

    <?= $form->field($model, 'goal_type') ?>

    <?= $form->field($model, 'goal_amount') ?>

    <?php // echo $form->field($model, 'goal_period') ?>

    <?php // echo $form->field($model, 'sip_amount') ?>

    <?php // echo $form->field($model, 'lumsum_amount') ?>

    <?php // echo $form->field($model, 'goal_start_date') ?>

    <?php // echo $form->field($model, 'goal_end_date') ?>

    <?php // echo $form->field($model, 'sip_date') ?>

    <?php // echo $form->field($model, 'investment_start_date') ?>

    <?php // echo $form->field($model, 'investment_end_date') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'modified_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'goal_status') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
