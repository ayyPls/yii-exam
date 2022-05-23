<?php

namespace app\controllers;

use app\models\Category;
use app\models\SearchCategory;
use app\models\SearchProduct;
use app\models\User;
use app\models\UserSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class AdminController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return !\Yii::$app->user->isGuest && \Yii::$app->user->identity->isAdmin();
                        }
                    ],
                ],
            ],

        ];
    }

    public
    function actionIndex()
    {
        $userSearch = new UserSearch();
        $users = $userSearch->search($this->request->queryParams);


        $categorySearch = new SearchCategory();
        $categories = $categorySearch->search($this->request->queryParams);

        $productSearch = new SearchProduct();
        $products = $productSearch->search($this->request->queryParams);

        return $this->render('index', [
            'userSearch' => $userSearch,
            'users' => $users,
            'categorySearch' => $categorySearch,
            'categories' => $categories,
            'products' => $products,
            'productSearch' => $productSearch,
        ]);

    }

}
