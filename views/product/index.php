<?php

use yii\grid\DataColumn;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Product;
use app\models\Cart;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchProduct */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div style="display: flex; justify-content: center; flex-wrap: wrap">
        <?php foreach ($dataProvider->models as $item) {
            echo "<div class='card' style='width: 18rem; margin: 50px auto;'>
        <img src='{$item['image']}' class='card-img-top'>
        <div class='card-body'>
            <h5 class='card-title'>${item['name']}</h5>
            <p class='card-text'>{$item['description']}</p>
            ".(Yii::$app->user->isGuest ?  '':  "<button' class='btn btn-success' onclick='addProductInCart(".Yii::$app->user->id.", {$item['id']})'>В корзину</button>")."
            
        </div>
    </div>";
        }
        ?>
    </div>

    <?php Pjax::end(); ?>

</div>
