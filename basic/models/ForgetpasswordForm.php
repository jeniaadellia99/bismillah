<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Anggota;
use app\models\User;


class ForgetpasswordForm extends Model

{
    // DEKLARASI  //
    
    public $email;
    public $verifyCode;
    public $token;

   
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['token'],'safe'],
            ['verifyCode', 'captcha'],
          
        ];
    }

    public function sendEmail()
    {
        $model = Anggota::findOne(['email'=>$this->email]);
        if ($model !== null) {
            return Yii::$app->mail->compose('@app/template/sendemail', ['model'=> $model])
             ->setFrom('adellia.jenia@gmail.com')
             ->setTo($this->email)
             ->setSubject('Ubah Password "Perpustakaan Website"')
             ->send();

             return true;

        }
        return false;
    }
}
