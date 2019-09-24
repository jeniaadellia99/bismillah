<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KategoriBrg */
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
<div class="kategori-brg-form box box-primary">
	<div class="box-header">
        <h3 class="box-title">Form Kategori Barang</h3>       
    </div>
        <div class="box-body">
 <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'nama')->textInput() ?>

    </div>
    <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-3">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>