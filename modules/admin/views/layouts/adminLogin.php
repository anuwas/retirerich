<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAdminAsset;
AppAdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/style.css" rel="stylesheet">
    <!-- Head Libs -->
		<link rel="shortcut icon" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/img/fav.ico" type="image/x-icon"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="login-page" style="height: auto;">
<!-- -------- body start  -->
<?php $this->beginBody() ?>
<?= $content ?>

<!-- -------- body end  -->



<?php $this->endBody() ?>
</body>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/jquery-2.1.1.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/bootstrap.min.js"></script>

<!-- Jquery Core Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/node-waves/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-validation/jquery.validate.js"></script>

<!-- Custom Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/admin.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/pages/examples/sign-in.js"></script>
</html>
<?php $this->endPage() ?>
