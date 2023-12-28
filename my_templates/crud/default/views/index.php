<?php

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\gii\generators\crud\Generator $generator */

$modelClass = StringHelper::basename($generator->modelClass);

echo "<?php\n";
?>

use <?= $generator->modelClass ?>;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use <?= $generator->indexWidgetType === 'grid' ? "kartik\\grid\\gridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/** @var yii\web\View $this */
<?= !empty($generator->searchModelClass) ? "/** @var " . ltrim($generator->searchModelClass, '\\') . " \$searchModel */\n" : '' ?>
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

    <h1><?= "<?= " ?>Html::encode($this->title) ?></h1>
    <?= 
    $modelClass = $generator->modelClass;
    $modelName = basename(str_replace('\\', '/', $modelClass)); 
    ?>

<?= $generator->enablePjax ? "    <?php Pjax::begin(); ?>\n" : '' ?>
<?php if(!empty($generator->searchModelClass)): ?>
<?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?= " ?>GridView::widget([
        'id' => 'crud-datatable-force-reloaded- <?= $modelName ?>',
        "striped" => true,
        "bordered" => false,
        "persistResize" => true,
        'pjax' => true,
        'pjaxSettings' => [
            'options' => [
                'id' => 'crud-datatable-pjax-<?=$modelName?>', // ID of the container to refresh
            ],
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fas fa-circle"></i> <?= $modelName ?></h3>',
            'type' => 'light',
            // 'before'=>Html::a('<i class="fas fa-plus"></i> Create <?= $modelName ?>', ['create'], ['class' => 'btn btn-success']),
            'after' => '{pager}',
            'footer' => false
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
            ['class' => 'yii\grid\SerialColumn'],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "            '" . $name . "',\n";
        } else {
            echo "            //'" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6) {
            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        } else {
            echo "            //'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye"></i>', ['<?= $modelName ?>/view', 'item_id' => $model->item_id], ['title' => 'View', 'data-toggle' => 'tooltip', 'data-pjax' => 0]);
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
                            "class" => "btn_conv_link <?= $modelName ?>_delete_btn"
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
                    'title' => Yii::t('app', "Create  <?=$modelName?>"),
                    'class' => 'toolbar_btn btn_create',
                    "id" => "btn_create_<?=$modelName ?>"
                ]) . ' ' .
                    Html::a('<i class="fas fa-redo"></i>', ["<?=$modelName?>/index"], [
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
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $generator->getNameAttribute() ?>), ['view', <?= $generator->generateUrlParams() ?>]);
        },
    ]) ?>
<?php endif; ?>

<?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>

</div>