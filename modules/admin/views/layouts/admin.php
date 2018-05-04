<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAdminAsset;

AppAdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="fixed">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <link rel="shortcut icon" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/img/fav.ico" type="image/x-icon"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/style.css" rel="stylesheet">

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/themes/all-themes.css" rel="stylesheet" />
    <!-- JQuery DataTable Css -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Jquery Core Js -->
    <script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery/jquery.min.js"></script>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="theme-indigo">

<?php $this->beginBody() ?>
<?php
$session = Yii::$app->session;

if (!isset($session['administrator'])) {
    return Yii::$app->getResponse()->redirect(array('admin/administrator/login',));
} else if ($session['administrator'] == '') {
    return Yii::$app->getResponse()->redirect(array('admin/administrator/login',));
}
?>

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="#"><img src="<?php echo Yii::getAlias('@web').'/web/assets/admin/'?>img/logo.png"  alt="Hyatt" height="32px"></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="pull-right"> <a href="<?php echo Yii::$app->homeUrl . 'admin/administrator/logout' ?>">
                        <i class="material-icons">input</i> <span style="position: relative;top: -6px;">Sign out</span>
                </a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/img/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $session['administrator']->name; ?></div>
                <div class="email"><?php echo $session['administrator']->email; ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo Yii::$app->request->baseUrl; ?>/admin/administrator/editprofile?id=<?php echo $session['administrator']->administratorid; ?>"><i class="material-icons">person</i>Profile</a></li>
                        <li><a href="<?php echo Yii::$app->homeUrl . 'admin/administrator/logout' ?>"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
               <!-- <li class="header">MAIN NAVIGATION</li>-->
                <li <?php if (strstr($_SERVER['REQUEST_URI'], "admin")){ ?>class="active"<?php } ?>>
                    <a href="<?php echo Yii::$app->homeUrl . 'admin' ?>">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>

                <li <?php if(strstr($_SERVER['REQUEST_URI'],"product-category/list") || strstr($_SERVER['REQUEST_URI'],"fund/list") || strstr($_SERVER['REQUEST_URI'],"customer-master/list")){ ?>class="active"<?php }?>>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">assignment</i>
                        <span>Configuration</span>
                    </a>
                    <ul class="ml-menu">
                       <li <?php if(strstr($_SERVER['REQUEST_URI'],"product-category")){?> class="active"<?php }?>>
                            <a href="<?php echo Yii::$app->homeUrl . 'admin/product-category/list' ?>">Services</a>
                        </li>
                        <li <?php if(strstr($_SERVER['REQUEST_URI'],"fund")){?> class="active"<?php }?>>
                            <a href="<?php echo Yii::$app->homeUrl . 'admin/fund/list' ?>">Funds</a>
                        </li>
                        <li <?php if(strstr($_SERVER['REQUEST_URI'],"customer-master")){?> class="active"<?php }?>>
                            <a href="<?php echo Yii::$app->homeUrl . 'admin/customer-master/list' ?>">Customers</a>
                        </li>
                    </ul>
                </li>
                <li <?php if(strstr($_SERVER['REQUEST_URI'],"goal/list")){ ?>class="active"<?php }?>>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">view_list</i>
                        <span>Transaction</span>
                    </a>
                    <ul class="ml-menu">
                        <li <?php if(strstr($_SERVER['REQUEST_URI'],"goal")){?> class="active"<?php }?>>
                            <a href="<?php echo Yii::$app->homeUrl . 'admin/goal/list' ?>">Customer Goals</a>
                        </li
                    </ul>
                </li>

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2018 <a href="javascript:void(0);"> CRM - GRAND HYATT KOCHI</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>

<section class="content">


	    <?= $content ?>

</section>

<?php $this->endBody() ?>
</body>

<!-- Bootstrap Core Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/bootstrap/js/bootstrap.js"></script>
<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/
<!-- Select Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/node-waves/waves.js"></script>
<!-- Autosize Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/autosize/autosize.js"></script>

<!-- Moment Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/momentjs/moment.js"></script>
<!-- Jquery CountTo Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Morris Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/morrisjs/morris.js"></script>



<!-- ChartJs -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/chartjs/Chart.bundle.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Custom Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/admin.js"></script>

<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/pages/forms/basic-form-elements.js"></script>
<!-- Demo Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/demo.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<!-- Autosize Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/autosize/autosize.js"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="http://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/pages/tables/jquery-datatable.js"></script>

</html>
<?php $this->endPage() ?>
