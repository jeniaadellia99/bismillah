<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PemakaianLab */
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

<div class="pemakaian-lab-form box box-primary">

    <?= $form->errorSummary($model); ?>

   <!--  <?= $form->field($model, 'id')->textInput() ?> -->

    <?= $form->field($model, 'id_mhs')->textInput() ?> 

    <?= $form->field($model, 'kode_lab')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_lab')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mata_kuliah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waktu_mulai')->textInput() ?>

    <?= $form->field($model, 'waktu_selesai')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
</div>
    <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-3">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>
