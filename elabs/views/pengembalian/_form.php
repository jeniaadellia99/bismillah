<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Pengembalian */
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

<div class="pengembalian-form box box-primary">

     <?= $form->errorSummary($model); ?><br>

    <?php $list = [1 => 'Baik dan Lengkap', 2 => 'Baik dan Tidak Lengkap', 3 => 'Rusak Ringan', 4 => 'Rusak berat']; echo $form->field($model, 'kondisi')->radioList($list); ?>

   </div>
<div class="box-footer">
  <div class="col-sm-offset-2 col-sm-3">
   <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
 </div>
</div>

<?php ActiveForm::end(); ?>
