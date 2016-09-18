<?php

use yii\bootstrap\Nav;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo yii::$app->user->identity->thumbnailTrue; ?>" class="img-circle" alt="<?php echo Yii::$app->user->identity->username; ?>" />

            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <?=
        Nav::widget(
                [
                    'encodeLabels' => false,
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        '<li class="header">Yii2 Basic Easy</li>',
                        [
                            'label' => '<i class="glyphicon glyphicon-lock"></i><span>Login</span>', //for basic
                            'url' => ['/site/login'],
                            'visible' => Yii::$app->user->isGuest
                        ],
                        //['label' => '<i class="fa fa-file-code-o"></i><span>Gii</span>', 'url' => ['/gii']],
                        //['label' => '<i class="fa fa-dashboard"></i><span>Debug</span>', 'url' => ['/debug']],
                        [
                            'label' => '<i class="glyphicon glyphicon-lock"></i><span>Sign in</span>', //for basic
                            'url' => ['/site/login'],
                            'visible' => Yii::$app->user->isGuest
                        ],
                    ],
                ]
        );
        ?>
        
        <?php if (sintret\diesel\controllers\Controller::checkAccess("report.index", Yii::$app->user->identity->roleId)) { ?>
            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="<?= \yii\helpers\Url::to(['/report']) ?>">
                        <i class="fa fa-file-o"></i> <span>Report</span>
                    </a>
                </li>
            </ul>
        <?php } ?>
        
          <?php if (sintret\diesel\controllers\Controller::checkAccess("user.index", Yii::$app->user->identity->roleId)) { ?>
            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="<?= \yii\helpers\Url::to(['/user']) ?>">
                        <i class="fa fa-user-secret"></i> <span>User</span>
                    </a>
                </li>
            </ul>
        <?php } ?>

        <?php if (sintret\diesel\controllers\Controller::checkManyAccess(['setting.index', 'role.index'], Yii::$app->user->identity->roleId)) { ?>
            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-wrench"></i> <span>Settings</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (sintret\diesel\controllers\Controller::checkAccess("setting.index", Yii::$app->user->identity->roleId)) { ?>
                            <li><a href="<?= \yii\helpers\Url::to(['/setting/update', 'id' => 1]) ?>"><span class="fa fa-cog"></span> General</a>
                            </li>
                        <?php } ?>
                        <?php if (sintret\diesel\controllers\Controller::checkAccess("role.index", Yii::$app->user->identity->roleId)) { ?>
                            <li><a href="<?= \yii\helpers\Url::to(['/role']) ?>"><span class="fa fa-unlock-alt"></span> Access Role</a>
                            </li>
                        <?php } ?>
                        <li><a href="<?= \yii\helpers\Url::to(['/log-upload']) ?>"><span class="fa fa-life-saver"></span> Log</a>
<!--                        <li><a href="<?= \yii\helpers\Url::to(['/debug']) ?>"><span class="fa fa-wrench"></span> Debug</a>-->
                        </li>
                    </ul>
                </li>
            </ul>
        <?php } ?>
    </section>

</aside>
