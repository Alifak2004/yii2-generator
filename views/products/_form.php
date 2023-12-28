<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Products $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="products-form" style=" <?= !$subMenu ? 'margin: 1rem;' : ''?>   ">

    <?php $form = ActiveForm::begin([
    "id" => "active_form_Products",
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
                "subMenu" => $subMenu,
                "images" => $images
            ]) ?>
            



    <?php ActiveForm::end(); ?>

</div>