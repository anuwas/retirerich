<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="fixed">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/css/default.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
    <!-- Core JS files -->
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/loaders/blockui.min.js"></script>


    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
    <!--<script type="text/javascript" src="<?php /*echo Yii::getAlias('@web') . '/web/' */?>assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>-->
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/ui/moment/moment.min.js"></script>
   <!-- <script type="text/javascript" src="<?php /*echo Yii::getAlias('@web') . '/web/' */?>assets/js/plugins/pickers/daterangepicker.js"></script>-->

    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/core/app.js"></script>
    <!--<script type="text/javascript" src="<?php /*echo Yii::getAlias('@web') . '/web/' */?>assets/js/pages/components_modals.js"></script>-->
    <!--<script type="text/javascript" src="<?php /*echo Yii::getAlias('@web') . '/web/' */?>assets/js/pages/dashboard.js"></script>-->

    <!-- /theme JS files -->

	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body class="navbar-bottom" style="background:url(<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg.jpg) repeat;">
<?php $this->beginBody() ?>

<!-- Main navbar -->
<div class="navbar mynav navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo Yii::getAlias('@web');?>"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/logo.png" alt=""></a>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">



        <ul class="nav navbar-nav navbar-right">


            <li <?php if(strstr($_SERVER['REQUEST_URI'],"login")){ ?>class="active"<?php }?>><a href="<?php echo Yii::$app->homeUrl.'customer-master/login'?>">LOGIN</a></li>
            <li <?php if(strstr($_SERVER['REQUEST_URI'],"register")){ ?>class="active"<?php }?>><a href="<?php echo Yii::$app->homeUrl.'customer-master/register'?>">REGISTER</a></li>

        </ul>
    </div>
</div>
<!-- /main navbar -->

<?= $content ?>


<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
