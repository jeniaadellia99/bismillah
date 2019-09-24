<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
use app\models\KategoriBrg;
use wbraganca\dynamicform\DynamicFormWidget;
use app\assets\AppAsset;
/* @var $this yii\web\View */
/* @var $model app\models\InventarisBrg */
/* @var $form yii\widgets\ActiveForm */
?>
<?php AppAsset::register($this); ?>
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

 <?= $form->field($model, 'kode_brg')->textInput(['maxlength' => true, 'id'=>'scan']) ?>

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

</div>
<div class="box-footer">
  <div class="col-sm-offset-2 col-sm-3"> 
  <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
 </div>
</div>
</div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">
 $(document).on('keypress', '#scan',function (e) {
  console.log('barcode_sparepart_code on keypress');
  if (e.keyCode==13) {
    e.preventDefault();
  }
})
 $("#scan").keypress(function(event){
  if (event.which == '10' || event.which == '13') {
    event.preventDefault();
  }
});
</script>
<!-- 
<input id="scan" type="text" autocomplete="off">
 <input id="send" type="submit" value="Send">


<script>

var

  messageEl = $('#message'),

  sendEl = $('#send');


messageEl.keypress(function(e) { // menangkap 'on keypress'

  if(e.charCode == 13 || e.keyCode == 13) { // kalo user menekan tombol Enter

    panggilFunction();

    e.preventDefault(); // menon-aktifkan event bawaannya, (mencegah submit form langsung)

  }

});


sendEl.click(function(e) { // menangkap event 'on click'

  var message = messageEl.val();

  messageEl.val('');

  panggilFunction(message);

});
 -->