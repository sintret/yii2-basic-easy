<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SettingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'applicationName') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'sms') ?>

    <?= $form->field($model, 'sms_key') ?>

    <?php // echo $form->field($model, 'sms_pass') ?>

    <?php // echo $form->field($model, 'gcm') ?>

    <?php // echo $form->field($model, 'gcm_api_key') ?>

    <?php // echo $form->field($model, 'gcm_sender') ?>

    <?php // echo $form->field($model, 'emailAdmin') ?>

    <?php // echo $form->field($model, 'emailSupport') ?>

    <?php // echo $form->field($model, 'emailOrder') ?>

    <?php // echo $form->field($model, 'sendgridUsername') ?>

    <?php // echo $form->field($model, 'sendgridPassword') ?>

    <?php // echo $form->field($model, 'whatsappNumber') ?>

    <?php // echo $form->field($model, 'whatsappPassword') ?>

    <?php // echo $form->field($model, 'whatsappSend') ?>

    <?php // echo $form->field($model, 'facebook') ?>

    <?php // echo $form->field($model, 'instagram') ?>

    <?php // echo $form->field($model, 'google') ?>

    <?php // echo $form->field($model, 'twitter') ?>

    <?php // echo $form->field($model, 'userCreate') ?>

    <?php // echo $form->field($model, 'userUpdate') ?>

    <?php // echo $form->field($model, 'updateDate') ?>

    <?php // echo $form->field($model, 'createDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
