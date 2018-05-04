<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Goal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pro_cat_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goal_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goal_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goal_period')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sip_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lumsum_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goal_start_date')->textInput() ?>

    <?= $form->field($model, 'goal_end_date')->textInput() ?>

    <?= $form->field($model, 'sip_date')->textInput() ?>

    <?= $form->field($model, 'investment_start_date')->textInput() ?>

    <?= $form->field($model, 'investment_end_date')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'modified_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'goal_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
