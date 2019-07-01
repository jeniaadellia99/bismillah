<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Jurusan;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Mhs */
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
<div class="mhs-form box box-primary">

    <div class="box-header">
        <h3 class="box-title">Form Data Mahasiswa</h3>       
    </div>
        <div class="box-body">
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'id_jurusan')->widget(Select2::classname(), [
            'data' =>  Jurusan::getList(),
            'options' => [
              'placeholder' => '- Pilih Jurusan -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    <?= $form->field($model, 'nim')->textInput() ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    

<!--  -->

</div>
    <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-3">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>