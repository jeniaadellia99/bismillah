<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lab */
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

<div class="lab-form box box-primary"><br>

    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    
    <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-3">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>