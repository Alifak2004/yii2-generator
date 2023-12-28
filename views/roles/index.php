<?php

use app\models\roles;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\gridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\RolesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    app\models\roles
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'id' => 'crud-datatable-force-reloaded-roles',
        "striped" => true,
        "bordered" => false,
        "persistResize" => true,
        'pjax' => true,
        'pjaxSettings' => [
            'options' => [
                'id' => 'crud-datatable-pjax-roles', // ID of the container to refresh
            ],
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fas fa-circle"></i>roles</h3>',
            'type' => 'light',
            // 'before'=>Html::a('<i class="fas fa-plus"></i> Create roles', ['create'], ['class' => 'btn btn-success']),
            'after' => '{pager}',
            'footer' => false
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'role_name',
            'role_description',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye"></i>', ['roles/view', 'id' => $model->id], ['title' => 'View', 'data-toggle' => 'tooltip', 'data-pjax' => 0]);
                    },
                    'update' => function ($url, $model) {
                        return Html::button('<span class="fas fa-pencil"></span>', [
                            "data" => [
                                "pjax" => 1,
                                "item_id" => $model->id
                            ],
                            'data-toggle' => 'tooltip',
                            "class" => "edit_row"
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::button('<span class="fas fa-trash"></span>', [
                            'data' => [
                                'pjax' => 1,
                                'item_id' => $model->id
                            ],
                            'data-toggle' => 'tooltip',
                            "class" => "btn_conv_link Roles_delete_btn"
                        ]);
                    }
                ],
            ]
        ,],
        'responsiveWrap' => true,
        'responsive' => true,
        "pjax" => true,
        'hover' => true,
        'resizableColumns' => true,
        // 'toolbarOptions' => [
        //     'skip-export-json' => true,
        // ],

        'toolbar' => [
            [
                'content' =>
                Html::button('<i class="fas fa-plus"></i>', [
                    'type' => 'button',
                    'title' => Yii::t('app', "Create  roles"),
                    'class' => 'toolbar_btn btn_create',
                    "id" => "btn_create_Roles"
                ]) . ' ' .
                    Html::a('<i class="fas fa-redo"></i>', ["roles/index"], [
                        'data-pjax' => 1,
                        'class' => 'toolbar_btn btn_redo',
                        'title' => Yii::t('app', 'Reset Grid')
                    ]),
            ],
            '{export}',
            '{toggleData}'
        ],

        'pager' => [
            'options' => ['class' => 'pagination justify-content-center'], // CSS class for the pager container
            'prevPageCssClass' => 'page-item ',
            'nextPageCssClass' => 'page-item ',
            'prevPageLabel' => '<span aria-hidden="true">&laquo;</span>',
            'nextPageLabel' => '<span aria-hidden="true">&raquo;</span>',
            'linkOptions' => ['class' => 'page-link'],
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
            'activePageCssClass' => 'active2', // CSS class for the current page number
        ],
        'toggleDataContainer' => ['class' => 'btn_create_toggle '],
        'exportContainer' => ['class' => 'btn_create_export ']


    ]); ?>

    <?php Pjax::end(); ?>

</div>