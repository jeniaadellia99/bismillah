<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $id_mhs
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
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
            [['id', 'username', 'password', 'id_mhs', 'id_user_role'], 'required'],
            [['id', 'id_mhs', 'id_user_role'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'id_mhs' => 'Id Mhs',
            'id_user_role' => 'Id User Role'
        ];
    }

     public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $Type = null)
    {
        return static::findOne(['access_token' => $token]);
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
        return $this->authKey === $authKey;
    }


    public function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);

        // cek password
         // return $password == $this->password;
    }
     // CEK LOGIN USER
    public static function isAdmin()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }
        $model = User::findOne(['username'=> Yii::$app->user->identity->username]);
        if ($model == null) {
            return false;
        }elseif ($model->id_user_role == 1) {
            return true;
        }
            return false;
    }

    public static function isMhs()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }
        $model = User::findOne(['username'=> Yii::$app->user->identity->username]);
        if ($model == null) {
            return false;
        }elseif ($model->id_user_role == 2) {
            return true;
        }
            return false;
    }

    public static function actionHash()
    {
        $mhs=Yii::$app->getSecurity()->generatePasswordHash("mhs123");
        echo $mhs;
    }

}
