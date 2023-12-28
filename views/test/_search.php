<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TestSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'column1') ?>

    <?= $form->field($model, 'column2') ?>

    <?= $form->field($model, 'column3') ?>

    <?= $form->field($model, 'column4') ?>

    <?php // echo $form->field($model, 'column5') ?>

    <?php // echo $form->field($model, 'column6') ?>

    <?php // echo $form->field($model, 'column7') ?>

    <?php // echo $form->field($model, 'column8') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
