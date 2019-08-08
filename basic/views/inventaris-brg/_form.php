
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
use app\models\KategoriBrg;

/* @var $this yii\web\View */
/* @var $model app\models\InventarisBrg */
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

<div class="inventaris-brg-form box box-primary">

     <div class="box-header">
        <h3 class="box-title">Form Inventaris Barang</h3>       
    </div>
        <div class="box-body">
            
   <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'nama_brg')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'id_kategori_brg')->widget(Select2::classname(), [
            'data' =>  KategoriBrg::getList(),
            'options' => [
              'placeholder' => '- Pilih Kategori -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'jumlah_brg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->widget(FileInput::classname(), [
        'options' => ['accept' => 'upload/*'],
        'pluginOptions'=>[
        	'allowedFileExtensions'=>['jpg', 'png'],
        	'showUpload' =>true,
        	'initialPreview' => [
        		$model->foto ? Html::img($model->foto):null,
        	],
        	'overwriteInitial'=>false,
        ],
    ]); ?>

    <?= $form->field($model, 'kode_brg')->textInput(['maxlength' => true]) ?>

     </div>
    <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-3">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>


    <?php ActiveForm::end(); ?>
<!-- <script type="text/javascript" class="scan" src="utilities.js">
    $(document).on('keypress', '.scan',function (e) {
        console.log('barcode_sparepart_code on keypress');
        if (e.keyCode==13) {
            e.preventDefault();
        }
    })
</script> -->