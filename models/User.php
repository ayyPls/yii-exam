<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string|null $patronymic
 * @property string $login
 * @property string $email
 * @property string $password
 * @property int $role_id
 *
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $rules;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'login', 'email', 'password', 'password_repeat', 'rules'], 'required'],
//            [['role_id'], 'integer'],
            ['email', 'email'],
            [['email', 'login'], 'unique'],
            ['password', 'string', 'min'=>6],
            [['firstname', 'lastname', 'patronymic'], 'match', 'pattern'=>'/^[а-яА-Я0-9 -]*$/u', 'message'=>'Кириллица и цифры и пробел'],
            ['login', 'match', 'pattern'=>'/^[a-zA-Z0-9-]*$/u', 'message'=>'Латинница и цифры'],
            [['firstname', 'lastname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 255],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>'Пароли не совпадают'],
            ['rules', 'compare', 'compareValue'=>true, 'message'=>'Необходимо согласие'],
//            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'role_id' => 'Роль пользователя',
            'password_repeat' => 'Повтор пароля',
            'rules' => 'Согласие с правилами регистрации',
        ];
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }

    public static function findByUsername($username)
    {
        return self::findOne(['login' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function isAdmin()
    {
        return $this->role->name === 'admin';
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->password = md5($this->password);
        return true;
    }
}
