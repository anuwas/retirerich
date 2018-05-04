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
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/plugins/ui/moment/moment.min.js"></script>

    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/core/app.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/pages/components_modals.js"></script>
    <!--<script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/pages/dashboard.js"></script>-->
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/application.js"></script>
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/' ?>assets/js/calculation.js"></script>
    <!-- /theme JS files -->

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="navbar-bottom" style="background:url(<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg.jpg) repeat;">
<?php $this->beginBody() ?>
<?php
$session = Yii::$app->session;

if(!isset($session['loggedUser'])){
	return Yii::$app->getResponse()->redirect(array('customer-master/login',));
}else if($session['loggedUser']==''){
	return Yii::$app->getResponse()->redirect(array('customer-master/login',));
}
?>
<!-- Main navbar -->
<div class="navbar mynav navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo Yii::getAlias('@web');?>"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/logo.png" alt=""></a>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">



        <ul class="nav navbar-nav navbar-right">
            <p class="navbar-text"><a href="<?php echo Yii::$app->homeUrl.'customer-master/goaldashboard'?>">My Goals</a></p>
            <p class="navbar-text"><a href="<?php echo Yii::$app->homeUrl.'customer-master/profiledashboard'?>">My Investment</a></p>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-cart"></i>
                    <span class="visible-xs-inline-block position-right">CART</span>
                    <span class="badge bg-warning-400">2</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" style="width:230px;">
                    <li><a href="#"> PENDING PAYMENT</a></li>
                    <li><a href="#"> UNCONFIRMED ORDERS</a></li>
                    <li><a href="#"> ORDER HISTORY</a></li>
                </ul>
            </li>

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/demo/users/face11.jpg" alt="">
                    <span><?php echo $session['loggedUser']['customer_name'];?></span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="<?php echo Yii::$app->homeUrl.'customer-master/profile'?>"><i class="icon-user-plus"></i> My profile</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl.'customer-master/logout'?>"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

        <?= $content ?>


<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
