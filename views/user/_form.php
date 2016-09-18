<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'disabled' => true]) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => 255, 'disabled' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => 255, 'disabled' => true]) ?>

        </div>
        <div class="col-md-6">
            <p>&nbsp;</p>
            <?php
            echo $form->field($model, 'status')->widget(CheckboxX::classname(), [
                'pluginOptions' => ['threeState' => false],
            ]);
            ?>
            <?= $form->field($model, 'roleId')->dropDownList(app\models\Role::dropdown()) ?>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs(''
        . '$("#user-roleid").on("change", function(){'
        . 'if($(this).val() == 5) {'
        . '$(".branch").show(); '
        . '} else {'
        . '$(".branch").hide();'
        . '}'
        . '});');
