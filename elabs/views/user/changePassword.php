<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
 
/* @var $this yii\web\View */
/* @var $model frontend\models\ChangePasswordForm */
/* @var $form ActiveForm */
 
$this->title = 'Password';
?>
<div class="user-form box box-primary">

	<div class="box-header">
        <h3 class="box-title">Ganti Password.</h3>
    </div>
 	
 	<div class="box-body">

		<?php $form = ActiveForm::begin(); ?>

		    <?= $form->field($model, 'password')->passwordInput() ?>

		    <?= $form->field($model, 'confirm_password')->passwordInput() ?>

		    <?= $form->field($model, 'verifyCode')->widget(Captcha::className()) ?>

		    <div class="form-group">
		    	<button type="button" class="btn btn-default" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>
		        <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
		    </div>
		     
		<?php ActiveForm::end(); ?>
		
	</div>
 
</div>