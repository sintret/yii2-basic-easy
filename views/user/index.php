<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
$date = date("YmdHis");
?>
<div class="user-index">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>


    <?php
    $toolbars = [
        ['content' =>
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['user/index', 'p_reset' => true], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Reset Grid']) . ' '
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
        //'id',
        ['attribute' => 'avatar', 'format' => 'html', 'value' => function($data) {
                return $data->thumb;
            }],
        'username',
        'email:email',
        'name',
        'phone',
        'city',
        [
            'attribute' => 'roleId',
            'filter' => app\models\Role::dropdown(),
            'value' => function($data) {
                return $data->roles->name;
            }
        ],
        [
            'class' => 'kartik\grid\BooleanColumn',
            'attribute' => 'status',
            'vAlign' => 'middle',
        ],
        // 'position',
        'createDate',
        // 'updateDate',
        [
            'class' => 'kartik\grid\ActionColumn',
            'dropdown' => false,
            'vAlign' => 'middle',
            'viewOptions' => ['title' => 'view', 'data-toggle' => 'tooltip'],
            'updateOptions' => ['title' => 'update', 'data-toggle' => 'tooltip'],
            'deleteOptions' => ['title' => 'delete', 'data-toggle' => 'tooltip'],
        ],
//        [
//            'class' => '\kartik\grid\CheckboxColumn',
//            'checkboxOptions' => [
//                'class' => 'simple'
//            ],
//            //'pageSummary' => true,
//            'rowSelectedClass' => GridView::TYPE_SUCCESS,
//        ],
    ];

    $dynagrid = DynaGrid::begin([
                'id' => 'user-grid',
                'columns' => $columns,
                'theme' => 'panel-primary',
                'showPersonalize' => true,
                'storage' => 'db',
                //'maxPageSize' =>500,
                'allowSortSetting' => true,
                'gridOptions' => [
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    //'showPageSummary' => true,
                    //'floatHeader' => true,
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
                        ]
                    ],
                ],
                'options' => ['id' => 'User' . Yii::$app->user->identity->id] // a unique identifier is important
    ]);

    DynaGrid::end();
    ?> 
</div>