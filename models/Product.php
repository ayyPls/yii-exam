<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;


/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property int $quantity
 * @property int $price
 * @property string $description
 * @property string $year
 * @property string $model
 * @property string $image
 * @property int $category_id
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{


    public $imageFile;

    public function upload()
    {
        if ($this->validate()) {
            $imageName = 'uploads/'.$this->imageFile->baseName.'.'.$this->imageFile->extension;
//
            $this->imageFile->saveAs($imageName);
            $this->image = '/'.$imageName;
//            var_dump($imageName);
//            die();
            //            $this->image = 'uploads/'.$this->imageFile->baseName.'.'.$this->imageFile->extension;
            return true;
        } else {
            return false;
        }
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'quantity', 'price', 'description', 'year', 'model', 'category_id'], 'required'],
            [['quantity', 'price', 'category_id'], 'integer'],
            [['year'], 'safe'],
            [['name', 'description', 'model', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'quantity' => 'Кол-во',
            'price' => 'Цена',
            'description' => 'Описание товара',
            'year' => 'Год',
            'model' => 'Модель',
            'image' => 'Изображение',
            'category_id' => 'Категория товара',
            'imageFile'=>'Загрузите изображение товара'
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
