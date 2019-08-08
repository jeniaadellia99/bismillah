<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DosenStaf */
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
<div class="dosen-staf-form box box-primary">

    <div class="box-header">
        <h3 class="box-title">Form Data Dosen dan Staff</h3>       
    </div>
        <div class="box-body">

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'nidn')->textInput() ?>

    <?= $form->field($model, 'nip')->textInput() ?>

    <?= $form->field($model, 'nik')->textInput() ?>

    <?= $form->field($model, 'nama')->textArea() ?>

    <?= $form->field($model, 'jabatan')->textInput() ?>
    

   <!--  -->

</div>
    <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-3">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>