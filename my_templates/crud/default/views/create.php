<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var yii\gii\generators\crud\Generator $generator */

echo "<?php\n";
?>

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var <?= ltrim($generator->modelClass, '\\') ?> $model */


<style>
    .mb {
        border: 1px solid #555;
        display: block;
        margin: 0 -4vw;
        width: 120vw;
    }
</style>

$this->title = <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">

    <div class="d-flex" style="justify-content: space-between;">
        <h1><?= "<?= " ?>Html::encode($this->title) ?></h1>
        <?= "<?= " ?> $isAjax == true ? "<button class='btn-danger' id='cancel_btn' style='border: none;background: transparent;'><i class='fas fa-x'></i></button>" : "" ?>
    </div>

    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
