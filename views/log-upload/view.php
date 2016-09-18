<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\LogUpload */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Log Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-upload-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'title',
            //[Html::a(basename($model->fileori), \yii\helpers\Url::to('@web/uploads/' . basename($model->filename)), ['target' => '__blank'])],
            [
                'attribute' => 'filename',
                'format' => 'raw',
                'value' => Html::a(basename($model->fileori), \yii\helpers\Url::to('@web/uploads/' . basename($model->filename)), ['target' => '__blank'])
            ],
//            'params:ntext',
//            'values:ntext',
//            'warning:ntext',
//            'keys:ntext',
            [
                'attribute' => 'type',
                'value' => \app\models\LogUpload::$typies_parsing[$model->type]
            ],
            [
                'attribute' => 'userCreate',
                'value' => Yii::$app->util->getUserId($model->userCreate)->username,
            ],
            [
                'attribute' => 'userUpdate',
                'value' => Yii::$app->util->getUserId($model->userUpdate)->username,
            ],
            [
                'attribute' => 'updateDate',
                'value' => $model->updateDate,
            ],
            [
                'attribute' => 'createDate',
                'value' => $model->createDate,
            ],
    ]]);
    ?>

</div>

<h2>Warning Here</h2>
<hr>
<style type="text/css">
    .kotak {
        margin-top:10px;
        border: #cdcdcd medium solid;
        border-radius: 2px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
    }
</style>
<div class="container">
    <div class="row">
        <?php

        function isJson($string) {
            json_decode($string);
            return (json_last_error() == JSON_ERROR_NONE);
        }

        if (substr($model->warning, 0, 6) == '<table') {
            echo $model->warning;
        } else if (isJson($model->warning)) {

            $array = \yii\helpers\Json::decode($model->warning);

            //echo '<pre>'; print_r($array);
            $div = '<div class="row">';
            $num = 1;
            if ($array)
                foreach ($array as $k => $v) {
                    if ($v)
                    //foreach ($v as $key => $val) {
                        $div .='<div class="col-md-12"><div class="kotak"><b>' . $num . '.</b> ' . $v . '</div></div>';
                    // }
                    $num++;
                }
            $div .= '<div class="row">';
            echo $div;
        } else {
            if ($model->warning)
                echo '<pre>';
            print_r($model->warning);
        }
        ?>
    </div>
</div>