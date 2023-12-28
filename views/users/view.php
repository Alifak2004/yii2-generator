<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Users $model */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-view">

    <div class="d-flex swal2-custom-header" style="">
        <h1 style="color: #222;margin: auto;padding:.5rem 0">#<?= Html::encode($this->title) ?></h1>
        <?= !empty($isAjax) ? "<button class='btn-danger' id='cancel_btn' style='border: none;background: transparent;'><i class='fas fa-x' style='margin-right:1.5rem'></i></button>" : "" ?>
    </div>
    <!-- <p>
        < ?= Html::a(Yii::t('app', 'Update'), ['update', 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        < ?= Html::a(Yii::t('app', 'Delete'), ['delete', 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'user_name',
            'first_name',
            'last_name',
            'birth_date',
            'email:email',
            'last_url:url',
            'password',
            'created_at',
            'created_by',
            'address',
            'phone',
            'zip_code',
            'role',
        ],
    ]) ?>

</div>
