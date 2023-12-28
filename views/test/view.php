<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Test $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="test-view">

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
            'column1',
            'column2',
            'column3',
            'column4',
            'column5:ntext',
            'column6',
            'column7',
            'column8',
    ],
    ]) ?>

</div>