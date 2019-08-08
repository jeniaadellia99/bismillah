<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div  class="login-pages">
            <div class="login-logo">
              <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/laptop.png">
              <p style="font-weight: bold; color: #FFFFFF">E-labs</p>
              <p class="txt-l" style="font-weight: bold">Politeknik Negeri Indramayu</p>

            </div>

<div class="login-box">
    <div class="login-box-body">
    <p class="login-box-msg">Sign In</p>
        <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-signin'],
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['placeholder'=>'Username'])->label(false); ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])->label(false); ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
              <!--   <?= Html::a('Lupa Password', ['#'], ['class' => 'text-center']) ?><br>
                <?= Html::a('Register', ['#'], ['class' => 'text-center']) ?> -->
            </div>
            <div class="col-xs-4">

                <?= Html::submitButton('Login',
                    [
                        'id' => 'btnLogin',
                        'class' => 'btn btn-flat btn-primary btn-block btn-signin',
                        'name' => 'login-button'
                    ]) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
