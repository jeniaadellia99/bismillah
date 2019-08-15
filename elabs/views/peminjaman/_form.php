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


   <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_dosen_staf')->widget(Select2::classname(), [
            'data' =>  DosenStaf::getList(),
            'options' => [
              'placeholder' => '- Pilih Dosen Staf -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    
    <!--<table class='table table-striped'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>kategori barang</th>
                                            <th>Jumlah barang</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            // $no = 1;
                                            // $sql = $koneksi->query("SELECT * FROM detail_pinjam, inventaris_brg WHERE inventaris_brg.kode_brg=inventaris_brg.kode_brg AND id_pinjam='$kode'");
                                            // while ($data = $sql->fetch_assoc()) {

                                        ?>
                                        <tr>
                                            <td><?php //echo $no++; ?></td>
                                            <td><?php //echo $data['Kode_brg'] ?></td>
                                            <td><?php //echo $data['nama_brg'] ?></td>
                                            <td><?php //echo $data['id_kategori_brg'] ?></td>
                                            <td><?php //echo $data['jumlah'] ?></td>
                                            <td>
                                                <a href="?page=penjualan&aksi=ubah&id=<?php //echo $data['id']?>&kode_pj=<?php// echo $data['kode_penjualan']?>&harga_jual=<?php //echo $data['harga_jual']?>&kode_barcode=<?php// echo $data['kode_barcode']?>" class="btn btn-success"><i class="material-icons">add</i></a>
                                                <a href="?page=penjualan&aksi=ubah&id=<?php //echo $data['id']?>&kode_pj=<?php //echo $data['kode_penjualan']?>&harga_jual=<?php //echo $data['harga_jual']?>&kode_barcode=<?php //echo $data['kode_barcode']?>" class="btn btn-success"><i class="material-icons">remove</i></a>
                                                <a href="?page=penjualan&aksi=ubah&id=<?php //echo $data['id']?>&kode_pj=<?php //echo $data['kode_penjualan']?>&harga_jual=<?php //echo $data['harga_jual']?>&kode_barcode=<?php //echo $data['kode_barcode']?>" class="btn btn-danger"><i class="material-icons">clear</i></a>
                                            </td>
                                        </tr>

                                        <?php

//                                            $total_bayar = $total_bayar + $data['total'];
  //                                          }
                                        ?>
                                    </tbody>

?>-->

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

<?php if (User::isAdmin()) { ?>
   
       <?= $form->field($model, 'id_mhs')->widget(Select2::classname(), [
            'data' =>  Mhs::getList(),
            'options' => [
              'placeholder' => '- Pilih Mahasiswa -',
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

<?php

?>