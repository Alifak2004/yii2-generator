<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Test $model */

$this->title = Yii::t('app', 'Update Test: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="test-update">
    
<div class="d-flex swal2-custom-header">
<h1 style="color: #222;margin: auto;padding:.5rem 0"> <?= Html::encode($this->title) ?> </h1>
    <?= !empty($isAjax) ? "<button class='btn-danger' id='cancel_btn' style='border: none;background: transparent;'><i class='fas fa-x'></i></button>" : "" ?>
</div>
<span class="mb"></span>


  
                    <?= $this->render('_form', [
            'model' => $model,
            "isAjax" => $isAjax,
            ]) ?>
            
</div>
