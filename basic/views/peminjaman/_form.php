<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\models\DosenStaf;
use app\models\InventarisBrg;
use app\models\User;
use app\models\Mhs;

/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */
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

<div class="peminjaman-form box box-primary">

 <div class="box-header">
        <h3 class="box-title">Form Permohonan Peminjaman</h3>       
    </div>
        <div class="box-body">


            
   <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_dosen_staf')->widget(Select2::classname(), [
        'data' =>  DosenStaf::getList(),
        'options' => [
          'placeholder' => '- Pilih Dosen/Staff -',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

     <?= $form->field($model, 'id_inventaris_brg')->widget(Select2::classname(), [
        'data' =>  InventarisBrg::getList(),
        'options' => [
          'placeholder' => '- Pilih Barang -',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

  

    <?= $form->field($model, 'tgl_pinjam')->widget(DatePicker::className(), [
                'removeButton' => false,
                'value' => date('Y-m-d'),
                'options' => ['placeholder' => 'Tanggal Pinjam'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
        ]) ?>

     <?= $form->field($model, 'tgl_kembali')->widget(DatePicker::className(), [
                'removeButton' => false,
                'value' => date('Y-m-d'),
                'options' => ['placeholder' => 'Tanggal Kembali'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
        ]) ?>

    <?= $form->field($model, 'keterangan')->textArea(['maxlength' => true]) ?>

<?php if (User::isAdmin()) { ?>
    <?php echo $form->field($model, 'status')->dropDownList(
        ['1' => 'menunggu verifikasi', '2' => 'Approved', '3' => 'denied']
    )?>
       <?= $form->field($model, 'id_mhs')->widget(Select2::classname(), [
            'data' =>  Mhs::getList(),
            'options' => [
              'placeholder' => '- Pilih Jurusan -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
<?php  } ?>


     </div>
    <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-3">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>