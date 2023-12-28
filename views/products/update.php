<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = Yii::t('app', 'Update Products: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="products-update">
    
<div class="d-flex swal2-custom-header">
<h1 style="color: #222;margin: auto;padding:.5rem 0"> <?= Html::encode($this->title) ?> </h1>
    <?= !empty($isAjax) ? "<button class='btn-danger' id='cancel_btn' style='border: none;background: transparent;'><i class='fas fa-x'></i></button>" : "" ?>
</div>
<span class="mb"></span>


  
                    <?= $this->render('_form', [
                        'model' => $model,
                        "isAjax" => $isAjax,
                        "subMenu" => $subMenu,
                        "images" => $images
                    ]) ?>
            
</div>
