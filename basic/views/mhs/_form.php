<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use app\models\Jurusan;

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

    <?= $form->field($model, 'nim')->textInput(['maxlength' => true]) ?>

    <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-3">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    

