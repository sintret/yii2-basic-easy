<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\FileInput;
use kartik\widgets\SwitchInput;
use mihaildev\ckeditor\CKEditor;
use kartik\widgets\DatePicker;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model app\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-form">

    <?php
    $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'options' => ['enctype' => 'multipart/form-data']   // important, needed for file upload
    ]);
    ?>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#general-info" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
        <li role="presentation"><a href="#approval" aria-controls="profile" role="tab" data-toggle="tab">Approval Value</a></li>
        <li role="presentation"><a href="#application" aria-controls="profile" role="tab" data-toggle="tab">Application</a></li>


    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="general-info">
            <div class="row" >
                <h5>    </h5>
            </div>

            <?= $form->field($model, 'applicationName')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>
            <?php
            echo $form->field($model, 'sms')->widget(CheckboxX::classname(), [
                'autoLabel' => true
            ])
            ?>
            <?= $form->field($model, 'sms_key')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'sms_pass')->textInput(['maxlength' => true]) ?>
            <?php
//            echo $form->field($model, 'gcm')->widget(CheckboxX::classname(), [
//                'autoLabel' => true
//            ])
            ?>
            <?php //echo  $form->field($model, 'gcm_sender')->textInput(['maxlength' => true]) ?>
            <?php // echo $form->field($model, 'gcm_api_key')->textInput(['maxlength' => true]) ?>

        </div>
        <div role="tabpanel" class="tab-pane" id="application">
            <div class="row" >
                <h5> </h5>
            </div>

            <?php $form->field($model, 'emailSupport')->textInput(['maxlength' => 255]) ?>
            <?php $form->field($model, 'emailAdmin')->textInput(['maxlength' => 255]) ?>
            <?php $form->field($model, 'emailOrder')->textInput(['maxlength' => 255]) ?>
            <?php //echo $form->field($model, 'whatsappNumber')->textInput(['maxlength' => 255]) ?>
            <?php // echo $form->field($model, 'whatsappPassword')->textInput(['type' => 'password']) ?>
            <?php //echo $form->field($model, 'whatsappSend')->textInput(['maxlength' => 255]) ?>
            <?php //echo $form->field($model, 'sendgridUsername')->textInput(['maxlength' => 255]) ?>
            <?php //echo $form->field($model, 'sendgridPassword')->textInput(['type' => 'password']) ?>

            <?php $form->field($model, 'facebook')->textInput(['maxlength' => 255]) ?>
            <?php $form->field($model, 'google')->textInput(['maxlength' => 255]) ?>
            <?php $form->field($model, 'instagram')->textInput(['maxlength' => 255]) ?>
            <?php $form->field($model, 'twitter')->textInput(['maxlength' => 255]) ?>
        </div>

        <div role="tabpanel" class="tab-pane" id="approval">
            <div class="row" >
                <h5> </h5>
            </div>

            <?php echo $form->field($model, 'approval')->textInput(['type' => 'text', 'class' => 'form-control number']) ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 

$this->registerJs('$("input.number").number(true,0,",",".");');?>