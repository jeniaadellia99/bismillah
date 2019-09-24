<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\models\DosenStaf;
use app\models\InventarisBrg;
use app\models\User;
use app\models\Mhs;
use yii\helpers\ArrayHelper;
use dosamigos\multiselect\MultiSelect;

/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */
/* @var $form yii\widgets\ActiveForm */
$tagsUrl = \yii\helpers\Url::to(['tag/autocomplete']);
$tagsUrls = \yii\helpers\Url::to(['tag/autocomplete', 'id' => 'id_inventaris_brg']);
$initScript = <<< SCRIPT
    function (element, callback) {
      var id = \$(element).val();
      if (id !== "") {
        var url = "{$tagsUrls}";
        \$.ajax(url.replace('id_inventaris_brg', id), {dataType: "json"}).done(
          function(data) {
            callback(data.results);
          });
      }
    }
SCRIPT;
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

<div class="peminjaman-form box box-primary">

 <div class="box-header">
        <h3 class="box-title">Form Permohonan Peminjaman</h3>       
    </div>
        <div class="box-body">
<?php 
$date = date('y-m-d'); // untuk tanggal hari ini
$weekend = "[0,6]"; // mendisable weekend
// $disableDates = ['2018-03-18','2018-03-07']; // tanggal-tanggal hari libur
?>

   <?= $form->errorSummary($model); ?>


    <?= $form->field($model, 'tgl_kembali')->widget(DatePicker::className(), [
                'removeButton' => false,

                'options' => ['placeholder' => 'Tanggal Kembali'],
                'pluginOptions' => [
      'weekStart' => 1,
      'autoclose' => true,
      'format' => 'yyyy-mm-dd',
      'startDate' => $date,
      'endDate' => '+1m',
      'daysOfWeekDisabled' => $weekend,
      'todayHighlight' => true,
      'disabled' => !empty($model->tgl_kembali),
  ]
]) ?>


<?php if (User::isAdmin()) { ?>
   
       <?= $form->field($model, 'id_mhs')->widget(Select2::classname(), [
            'data' =>  Mhs::getList(),
            'options' => [
              'placeholder' => '',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
<?php  } ?>
<?= $form->field($model, 'keterangan')->textArea(['maxlength' => true]) ?>


     </div>
    <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-3">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>