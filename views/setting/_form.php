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
     
        </div>
        <div role="tabpanel" class="tab-pane" id="application">
            <div class="row" >
                <h5> </h5>
            </div>

            <?= $form->field($model, 'emailSupport')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'emailAdmin')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'emailOrder')->textInput(['maxlength' => 255]) ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>


    

    
    <?php ActiveForm::end(); ?>

</div>
