<?php

use yii\widgets\Breadcrumbs;
?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <?php
            ///this case just for label dashboard, you can remove this if don't like
            $controllerId = strtolower(Yii::$app->controller->id);
            $methodId = strtolower(Yii::$app->controller->action->id);
            $dashboard = 'Dashboard: ';
            if ($controllerId == 'site') {
                $dashboard = 'Dashboard: ';
            } else {
                if ($methodId == 'create') {
                    $dashboard = 'Form: ';
                } else if ($methodId == 'update') {
                    $dashboard = 'Form: ';
                } else if ($methodId == 'index') {
                    $dashboard = 'Grid: ';
                } else if ($methodId == 'view') {
                    $dashboard = 'View: ';
                }
            }
            ?>
            <h4><?php echo $dashboard; ?>
                <?php
                if ($this->title !== null) {
                    echo '<small>' . \yii\helpers\Html::encode($this->title) . '</small>';
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                            \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>SM</small>' : '';
                }
                ?>
            </h4>
        <?php } ?>

        <?=
        Breadcrumbs::widget(
                [
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]
        )
        ?>
    </section>

    <section class="content">
        <?php foreach (Yii::$app->session->getAllFlashes() as $key => $message): ?>
            <?php
            echo \kartik\widgets\Growl::widget([
                'type' => (!empty($message['type'])) ? $message['type'] : 'info',
                //'title' => $message,
                'title' => 'Notification',
                'icon' => 'fa fa-envelope',
                'body' => (!empty($message['title'])) ? \yii\helpers\Html::encode($message['title']) : $message,
                'showSeparator' => true,
                'delay' => 1, //This delay is how long before the message shows
                'pluginOptions' => [
                    'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
                    'placement' => [
                        'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                        'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                    ]
                ]
            ]);
            ?>
        <?php endforeach; ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer no-print">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2016-<?php echo date('Y'); ?> <a href="http://sintret.com" target="_blank">Basic 9</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
