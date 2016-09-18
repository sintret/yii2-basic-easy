<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

$this->registerJsFile('js/checkall.js', ['position' => \yii\web\View::POS_BEGIN]);


/* @var $this yii\web\View */
/* @var $searchModel app\models\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="row">

        <?php
        $form = ActiveForm::begin([
                    'type' => ActiveForm::TYPE_HORIZONTAL,
                    'options' => ['enctype' => 'multipart/form-data']   // important, needed for file upload
        ]);
        ?>
    </div>
    <?= $form->field($model, 'role_name')->dropDownList(app\models\Role::dropdown()) ?>

    <table class="table">
        <tr>
            <th>Name</th>
            <?php
            foreach ($methods as $method) {
                echo '<th>' . $method . ' &nbsp;<input  onclick="checkthis(\'' . $method . '\')" type="checkbox" id="all' . $method . '" ></th>';
            }
            ?>
        </tr>
        <?php foreach ($controllers as $controller) { ?>
            <tr>
                <td><?php echo $controller; ?></td>
                <?php
                foreach ($methods as $method) {
                    $name = "Roles[$controller][$method]";
                    $elementId = $method;
                    $access = \app\models\Access::find()->where([
                                'roleId' => $roleId,
                                'controller' => $controller,
                                'method' => $method])->exists();

                    if ($access)
                        $checked = ' checked="checked" ';
                    else
                        $checked = '';

                    echo '<td> <input type="checkbox" name="' . $name . '" id="' . $elementId . '" ' . $checked . '  title="Role for ' . $controller . ' ' . $method . '" /> </td>';
                }
                ?>
            </tr>
        <?php } ?>
    </table>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php $this->registerJs('$("#role-role_name").on("change", function() {
            location.href = "' . yii\helpers\Url::to(['/role']) . '?roleId=" + $(this).val();
        });'); ?>