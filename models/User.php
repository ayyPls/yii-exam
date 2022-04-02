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
 * @property string $patronymic
 * @property string $login
 * @property string $email
 * @property int $role_id
 * @property string $password
 *
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $password_repeat;
    public $rules;

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
            [['firstname', 'lastname', 'patronymic', 'login', 'email', 'password', 'rules', 'password_repeat'], 'required'],
            [['role_id'], 'integer'],
            [['firstname', 'lastname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 255],
            [['login'], 'unique'],
            [['firstname', 'lastname'], 'match', 'pattern'=>'/[А-я ]/u', 'message'=>'Только кириллица'],
            [['email'], 'unique'],
            [['email'], 'email'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
            ['rules', 'compare', 'compareValue'=>true, 'message'=>'Необходимо согласие с правилами регистрации']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'patronymic' => 'Patronymic',
            'login' => 'Login',
            'email' => 'Email',
            'role_id' => 'Role ID',
            'password' => 'Password',
            'password_repeat' => 'Повтор пароля',
            'rules' => 'Согласие с правилами',
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

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->password = md5($this->password);
        return true;
    }


}
