<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogUploadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log Uploads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-upload-index">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>


    <?php
    $toolbars = [
        ['content' =>
            // Html::a('<i class="fa fa-file-excel-o"></i>', ['log-upload/parsing'], ['type' => 'button', 'title' => 'Parsing Excel ' . $this->title, 'class' => 'btn btn-warning']) . ' ' .
            //Html::button('<i class="fa fa-download"></i>', ['type' => 'button', 'title' => 'Excel Backup ' . $this->title, 'class' => 'btn btn-default', 'id' => 'backupExcel']) . ' ' .
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['log-upload/index', 'p_reset' => true], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Reset Grid']) . ' '
        ],
        ['content' => '{dynagridFilter}{dynagridSort}{dynagrid}'],
        '{export}',
    ];
    $panels = [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  ' . $this->title . '</h3>',
        'before' => '<div style="padding-top: 7px;"><em>* The table at the right you can pull reports & personalize</em></div>',
    ];
    $columns = [
        ['class' => 'kartik\grid\SerialColumn', 'order' => DynaGrid::ORDER_FIX_LEFT],
        'title',
        [
            'attribute' => 'fileori',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(basename($data->fileori), \yii\helpers\Url::to('@web/uploads/' . basename($data->filename)), ['target' => '__blank']);
            },
                ],
                [
                    'attribute' => 'type',
                    'filter' => \app\models\LogUpload::$typies_parsing,
                    'value' => function ($data) {
                        return \app\models\LogUpload::$typies_parsing[$data->type];
                    },
                ],
                [
                    'attribute' => 'userCreate',
                    'filter' => User::dropdown(),
                    'value' => function ($data) {
                        return app\components\Util::usernameOne($data->userCreate);
                    },
                ],
                'updateDate',
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'dropdown' => false,
                    'vAlign' => 'middle',
                    'template' => '{view}',
                ],
            ];

            $dynagrid = DynaGrid::begin([
                        'id' => 'user-grid',
                        'columns' => $columns,
                        'theme' => 'panel-primary',
                        'showPersonalize' => true,
                        'storage' => 'db',
                        'allowSortSetting' => true,
                        'gridOptions' => [
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'showPageSummary' => true,
                            'floatHeader' => false,
                            'pjax' => true,
                            'panel' => $panels,
                            'toolbar' => $toolbars,
                            'export' => [
                                'fontAwesome' => true,
                                'showConfirmAlert' => false,
                            //'target' => GridView::TARGET_SELF
                            ],
                            'exportConfig' => [
                                'html' => [
                                    'filename' => 'location-' . $date,
                                ],
                                'csv' => [
                                    'filename' => 'location-' . $date,
                                ],
//                        'pdf' => [
//                            'filename' => 'location-' . $date,
//                        ],
                                'xls' => [
                                    'filename' => 'location-' . $date,
                                ],
                                'txt' => [
                                    'filename' => 'location-' . $date,
                                ],
                                'json' => [
                                    'filename' => 'location-' . $date,
                                ],
                            ],
                        ],
                        'options' => ['id' => 'LogUpload' . Yii::$app->user->identity->id] // a unique identifier is important
            ]);

            DynaGrid::end();
            ?> </div>
            <?php $this->registerJs('$("#deleteSelected").on("click",function(){
var array = "";
$(".simple").each(function(index){
    if($(this).prop("checked")){
        array += $(this).val()+",";
    }
})
if(array==""){
    alert("No data selected?");
} else {
    if(window.confirm("Are You Sure to delete selected data?")){
        $.ajax({
            type:"POST",
            url:"' . Yii::$app->urlManager->createUrl(['log-upload/delete-all']) . '",
            data :{pk:array},
            success:function(){
                location.href="";
            }
        });
    }
}
});'); ?>
