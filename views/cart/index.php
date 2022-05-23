<?php

use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Cart;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => DataColumn::class, // this line is optional
                'attribute' => 'name',
                'format' => 'html',
                'label' => 'Изображение',
                'value' => function ($model) {
                    return Html::img(\app\models\Product::findOne($model->product_id)->image, ['width' => 150]);
                }
            ],
            [
                'class' => DataColumn::class, // this line is optional
                'attribute' => 'name',
                'format' => 'text',
                'label' => 'Товар в корзине',
                'value' => function ($model) {
                    return \app\models\Product::findOne($model->product_id)->name;
                }
            ], [
                'class' => DataColumn::class, // this line is optional
                'attribute' => 'name',
                'format' => 'text',
                'label' => 'Кол-во заказанного товара',
                'value' => function ($model) {
                    return $model->quantity;
                }
            ],
//            [
//                'class' => ActionColumn::className(),
//                'urlCreator' => function ($action, Cart $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                }
//            ],
            [
                'class' => DataColumn::class, // this line is optional
                'format' => 'html',
                'content' => function ($model) {
                    return Html::button('+', ['class' => 'btn btn-success', 'onclick' => 'plusProduct(' . $model->id . ')']);
                }
            ],[
                'class' => DataColumn::class, // this line is optional
                'format' => 'html',
                'content' => function ($model) {
                    return Html::button('-', ['class' => 'btn btn-success', 'onclick' => 'minusProduct(' . $model->id . ')']);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
