<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
$fieldOptionsUser = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];
$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Yii2</b> Basic Easy</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
         <p>Please fill out the following fields to Register:</p>

        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptionsUser)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
        
         <?= $form
            ->field($model, 'email', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
           
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

         <p><a href="<?php echo Url::to(['site/login']);?>">I already have a membership</a></p>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->