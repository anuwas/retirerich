<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StatesMaster */

$this->title = 'Create States Master';
$this->params['breadcrumbs'][] = ['label' => 'States Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="states-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
