<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Test $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-form">

    <?php $form = ActiveForm::begin([
    "id" => "active_form_Test",
    'options'=>['enctype'=>'multipart/form-data'], // important 'enableAjaxValidation' => true,
    'enableClientScript' => true,
    'enableClientValidation' => true,
    'validateOnChange' => true,
    'validateOnBlur' => true,
    ]); ?>

    
      
                <?= $this->render('_form_inputs', [
                'model' => $model,
                "form" => $form,
                "isAjax" => $isAjax,
            ]) ?>
            



    <?php ActiveForm::end(); ?>

</div>