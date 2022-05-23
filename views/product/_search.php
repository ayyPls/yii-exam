<?php

//use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',

        'options' => [
            'data-pjax' => 1
        ],
        'fieldConfig' => [
            'template' => "{label}\n{input}",
            'labelOptions' => ['class' => 'row-lg-4 col-form-label '],
            'inputOptions' => ['class' => 'row-lg-8 form-control'],
        ],
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?php  echo $form->field($model, 'year') ?>

    <?php  echo $form->field($model, 'model') ?>

<!--    --><?php // echo $form->field($model, 'category_id') ?>
<!--    --><?php // echo $form->dropDownList() ?>
    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
