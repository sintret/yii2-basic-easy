<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = $settings->applicationName . ' - Dashboard';
//$this->registerCssFile(Yii::$app->request->baseUrl . '/css/xenon-components.css');
//$this->registerCssFile(Yii::$app->request->baseUrl . '/css/fonts/linecons/css/linecons.css');
$this->registerCssFile('//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css');
////code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css
//echo \Yii::$app->session->get('branch');
//echo 'branchId :'.Yii::$app->user->identity->branchId;
//echo 'role :'.Yii::$app->user->identity->role;
$this->registerJsFile('https://apis.google.com/js/platform.js', ['jsOptions' => ['asynch', 'defer'], 'depends' => [app\assets\AppAsset::className()]]);
?>
<p>&nbsp;</p>
<div class="row">
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>
                    <?php echo \app\models\User::find()->count(); ?>
                </h3>
                <p>
                    Users
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a class="small-box-footer" href="<?php echo Url::to(['user']); ?>">
                Go to Users <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->

    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-fuchsia">
            <div class="inner">
                <h3>
                    100
                </h3>
                <p>
                    Blogs
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-home"></i>
            </div>
            <a class="small-box-footer" href="<?php echo Url::to(['/blog']); ?>">
                Go to Locations <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->

    

    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    Reports
                </h3>
                <p>
                    Graphic
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a class="small-box-footer" href="<?php echo Url::to(['report']); ?>">
                Go to Reports <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
</div>
<hr>
<div class="row">
    <!-- Left col -->
    <section class="col-lg-9 connectedSortable ui-sortable">

        <!-- Chat box -->

        <!-- To Do List -->


    </section><!-- /.Left col -->
    <div class="col-md-3">

    </div><!-- /.end col-md-3 -->

</div>