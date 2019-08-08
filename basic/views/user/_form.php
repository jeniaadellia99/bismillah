<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\User;
use app\models\Mhs;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'layout'=>'horizontal',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
    'fieldConfig' => [
        'horizontalCssClasses' => [
           
            'wrapper' => 'col-sm-4',
            'error' => '',
            'hint' => '',
        ],
    ]
]); ?>

<div class="user-form">
    <?php if (User::isAdmin()): ?>
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <button type="button" class="btn btn-default" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>
        <?= Html::submitButton('Simpan Username', ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-key"> Ganti Password</i>', ['change-password', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>

    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php endif ?>
 <?php if (User::isMhs()): ?>
    <div class="user-form">

    <div class="form-group">
        <?= Html::a('<i class="fa fa-user"> Biodata</i>', ['mhs/view', 'id' => $model->id_mhs], ['class' => 'btn btn-primary']); ?>
        <?= Html::a('<i class="fa fa-key"> Ganti Password</i>', ['change-password', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

     <div class="form-group">
        <button type="button" class="btn btn-default" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>
        <?= Html::submitButton('Simpan Username', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

     <?php endif ?>