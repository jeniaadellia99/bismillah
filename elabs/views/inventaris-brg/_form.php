<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\InventarisBrg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventaris-brg-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_brg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kategori_brg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumlah_brg')->textInput(['maxlength' => true]) ?>

    <?php /*<?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>*/ ?>
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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
