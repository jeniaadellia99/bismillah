<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $id_mhs
 * @property int $id_user_role
 * @property string $token
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
            [['username', 'password', 'id_mhs', 'id_user_role', 'token'], 'required'],
            [['id', 'id_mhs', 'id_user_role'], 'integer'],
            [['username', 'password'], 'string', 'max' => 255],
            [['token'], 'string', 'max' => 50],
            [['id'], 'unique'],
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
            'id_mhs' => 'Mahasiswa',
            'id_user_role' => 'User Role',
            'token' => 'Token',
        ];
    }

    // Cunstom sendiri interface.
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
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

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        //return $this->password == $password;
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

     public static function isAdmin()
    {
        // Jika bila user login trs keluar dan user terus masuk lewat url itu tidak bisa maka balik ke login.
        if (Yii::$app->user->isGuest) {
           return false;
        }

        // Buat id akses login user
        if (($user = User::findOne(Yii::$app->user->identity->id_user_role == 1))) {
            return $user;
        } else {
            return false;
        }
    }

    public static function isMhs()
    {
        // Jika bila user login trs keluar dan user terus masuk lewat url itu tidak bisa maka balik ke login.
        if (Yii::$app->user->isGuest) {
           return false;
        }

        // Buat id akses login user
        if (($user = User::findOne(Yii::$app->user->identity->id_user_role == 2))) {
            return $user;
        } else {
            return false;
        }
    }

    public static function getFotoAdmin($htmlOptions=[])
    {
        return Html::img('@web/img/polindra.png', $htmlOptions);
    }

    public static function getFotoMhs($htmlOptions=[])
    {
        $query = Mhs::find()
            ->andWhere(['id' => Yii::$app->user->identity->id_mhs])
            ->one();

        if ($query->foto != null) {
            return Html::img('@web/upload/mhs/' . $query->foto, $htmlOptions);
        } else {
            return Html::img('@web/foto/no-images.png', $htmlOptions);
        }
    }


    public function beforeSave($insert)
    {
        if ($insert) {
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }
        return true;
    }

    public function getMhs()
    {
        return $this->hasOne(Mhs::className(), ['id' => 'id_mhs']);
    }

}
