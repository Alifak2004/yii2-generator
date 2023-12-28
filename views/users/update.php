<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Users $model */

$this->title = Yii::t('app', 'Update User #{name}', [
    'name' => $model->user_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<style>
    .mb {
        border: 1px solid #555;
        display: block;
        margin: 0 -4vw;
        width: 120vw;
    }
</style>
<div class="users-update">

    <div class="d-flex swal2-custom-header" style="">
        <h1 style="color: #222;margin: auto;padding:.5rem 0"><?= Html::encode($this->title) ?></h1>
        <?= !empty($isAjax) ? "<button class='btn-danger' id='cancel_btn' style='border: none;background: transparent;'><i class='fas fa-x'></i></button>" : "" ?>
    </div>
    <span class="mb"></span>

    <?= $this->render('_form', [
        'model' => $model,
        "isAjax" => $isAjax,
        "images" => $images

    ]) ?>

</div>
