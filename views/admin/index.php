<?php
/* @var $this yii\web\View */;

use app\models\Category;
use app\models\Product;
use yii\grid\ActionColumn;
use yii\grid\DataColumn;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<nav class="position-fixed p-3 w-100 m-0" style="background-color: white; top: 50px;">
    <a class="nav-item" href="#users">
        Пользователи
    </a><a href="#categories">
        Категории
    </a><a href="#products">
        Товары
    </a>
</nav>
<h3 id="users" class="mt-5">Пользователи:</h3>
<?= GridView::widget([
    'dataProvider' => $users,
    'filterModel' => $userSearch,
    'columns' => [

        'firstname',
        'lastname',
        'patronymic',
        'login',
        'email:email',
        [
            'class' => DataColumn::class, // this line is optional
            'attribute' => 'name',
            'format' => 'text',
            'label' => 'Роль',
            'value' => function ($model) {
                return $model->role->name ==="admin" ? 'Администратор' : 'Пользователь';
            }
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, User $model, $key, $index, $column) {
                return Url::toRoute(['/user/' . $action, 'id' => $model->id]);
            }
        ],
    ],
]); ?>

<h3 id="products">Категории товаров:</h3>

<p>
    <?= Html::a('Добавить категорию', ['/category/create'], ['class' => 'btn btn-success']) ?>
</p>
<?= GridView::widget([
    'dataProvider' => $categories,
//    'filterModel' => $searchModel,
    'columns' => [
        'name',
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Category $model, $key, $index, $column) {
                return Url::toRoute(['/category/' . $action, 'id' => $model->id]);
            }
        ],
    ],
]); ?>


<h3 id="products">Товары</h3>
<p>
    <?= Html::a('Создать товар', ['/product/create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $products,
    'filterModel' => $productSearch,
    'columns' => [
        'name',
        'quantity',
        'price',
        'description',
        'year',
        'model',
     [
            'class' => DataColumn::class, // this line is optional
            'attribute' => 'name',
            'format'=>'html',
            'label' => 'Изображение',
            'value' => function ($model) {
                return \yii\helpers\Html::img($model->image, ['width'=>100, 'height'=>'auto']);
            }
        ],
        [
            'class' => DataColumn::class, // this line is optional
            'attribute' => 'name',
            'format' => 'text',
            'label' => 'Категория',
            'value' => function ($model) {
                return $model->getCategory()->one()->name;
            }
        ], [
            'class' => DataColumn::class, // this line is optional
            'attribute' => 'name',
            'format' => 'text',
            'label' => 'Полное название',
            'value' => function ($model) {
                return $model->name . ' (' . $model->year . ') ' . $model->model;
            }
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }
        ],

    ],
]); ?>
