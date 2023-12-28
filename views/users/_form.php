<?php
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Users $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div>
    <?php $form = ActiveForm::begin([
        "id" => "active_form_id",
        // "ajax" => true,
        'options'=>['enctype'=>'multipart/form-data'], // important        'enableAjaxValidation' => true,
        'enableClientScript' => true,
        'enableClientValidation' => true,
        'validateOnChange' => true,
        'validateOnBlur' => true,
        // 'options' => [
        //     'data-pjax' => true, // Optional: Enable PJAX for AJAX-based updates
        // ],
        // 'ajaxVar' => 'ajax', // Name of the AJAX parameter (can be any name)
        // 'ajaxParam' => 'ajax', // Name of the AJAX flag parameter (can be any name)
    ]); ?>

<?= $this->render('_form_inputs', [
        'model' => $model,
        "form" => $form,
        "images" => $images
    ]) ?>
    

</div>
<?php ActiveForm::end(); ?>


