<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\InventarisBrg;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\DetailPinjam */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="detail-pinjam-form">


    <?php $form = ActiveForm::begin(); ?>

   <!-- ?= $form->field($model, 'kode_brg')->textInput(['maxlength' => true]) ?> -->
    
    <?= $form->field($model, 'id_inventaris_brg')->widget(Select2::classname(), [
    	'options' => [
              'placeholder' => '- SEarch Kode Barang -',
            ],
        'data' =>  InventarisBrg::getList(),
       
    ]); ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
