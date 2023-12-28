<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        < ?= "< ?= " ?>Html::a(< ?= $generator->generateString('Update') ?>, ['update', < ?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
        < ?= "< ?= " ?>Html::a(< ?= $generator->generateString('Delete') ?>, ['delete', < ?= $urlParams ?>], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => < ?= $generator->generateString('Are you sure you want to delete this item?') ?>,
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'name',
            'description_sm:ntext',
            'description_lg:ntext',
            'qty',
            'actual_qty',
            'views',
            'weight',
            'cost',
            'wholesale_price',
            'retail_price',
            'clearance_price',
            'brand',
            'shipping_cost',
            'vat',
            'low_qty_alert',
            'discount_rate',
            'product_condition',
            'status',
            'featured',
            'visible',
            'recommended',
            'main_page',
    ],
    ]) ?>

</div>