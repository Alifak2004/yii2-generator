<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProductsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description_sm') ?>

    <?= $form->field($model, 'description_lg') ?>

    <?= $form->field($model, 'qty') ?>

    <?php // echo $form->field($model, 'actual_qty') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'wholesale_price') ?>

    <?php // echo $form->field($model, 'retail_price') ?>

    <?php // echo $form->field($model, 'clearance_price') ?>

    <?php // echo $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'shipping_cost') ?>

    <?php // echo $form->field($model, 'vat') ?>

    <?php // echo $form->field($model, 'low_qty_alert') ?>

    <?php // echo $form->field($model, 'discount_rate') ?>

    <?php // echo $form->field($model, 'product_condition') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'featured') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'recommended') ?>

    <?php // echo $form->field($model, 'main_page') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
