<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\InventarisBrg;
use kartik\select2\Select2;
use app\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\DetailPinjam */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    function sum() {
        var jumlah_brg = document.getElementById('jumlah_brg').value;
        var jumlah = document.getElementById('jumlah').value;
        var result = parseInt(jumlah) - parseInt(jumlah);
        if (!isNaN(result)) {
            document.getElementById('profit').value = result;
        }
    }
</script>
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



<div class="detail-pinjam-form box box-primary">


   <?= $form->errorSummary($model); ?><br>

   <?php if (User::isAdmin()) { ?>
    
    <?= $form->field($model, 'id_inventaris_brg')->widget(Select2::classname(), [
    	'options' => [
              'placeholder' => '- Pilih Barang -',
            ],
        'data' =>  InventarisBrg::getList(),
    ]); ?>

<?php } else { ?>
      <?= $form->field($model, 'id_inventaris_brg')->widget(Select2::classname(), [
        'options' => [
              'placeholder' => '- Pilih Barang -',                   
            ],
        'data' =>  InventarisBrg::getList(),
        'pluginOptions' => [
            'allowClear' => true
        ]
    ]); ?>
<?php } ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>

    <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-3">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>