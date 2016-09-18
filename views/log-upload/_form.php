<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\FileInput;
use kartik\widgets\SwitchInput;
use mihaildev\ckeditor\CKEditor;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\LogUpload */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-upload-form">

    <?php     $form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'options' => ['enctype' => 'multipart/form-data']   // important, needed for file upload
    ]);?>


            <div class="row">
        <div class="col-md-6">
        
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'fileori')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'values')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'keys')->textarea(['rows' => 6]) ?>
        </div>

        <div class="col-md-6">
        
            <?= $form->field($model, 'userId')->textInput() ?>

            <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'params')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'warning')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'type')->textInput() ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

        <?php ActiveForm::end(); ?>

</div>
