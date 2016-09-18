<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">My</span><span class="logo-lg">' . Yii::$app->name. '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <?php echo \app\models\Notification::notification(); ?>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo yii::$app->user->identity->thumbnailTrue; ?>" width="25" class="img-circle" alt="<?php echo Yii::$app->user->identity->username; ?>" />
                        <span class="hidden-xs"><?php echo Yii::$app->user->identity->username; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo yii::$app->user->identity->thumbnailTrue; ?>" width="25" class="img-circle" alt="<?php echo Yii::$app->user->identity->username; ?>" />
                            <p>
                                <?php echo Yii::$app->user->identity->username.' - '. app\models\User::$userLevel[Yii::$app->user->identity->roleId] ; ?>
                                <small>Member since <?php echo date('F Y', strtotime(Yii::$app->user->identity->createDate)); ?> </small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo Yii::$app->urlManager->createUrl('site/me'); ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?=
                                Html::a(
                                        'Sign out', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                )
                                ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
               
            </ul>
        </div>
    </nav>
</header>
