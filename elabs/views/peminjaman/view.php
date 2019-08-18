<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use app\components\Helper;
use app\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title = "Nama Peminjam:".@$model->mhs->nama;
$this->params['breadcrumbs'][] = ['label' => 'Peminjamen', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="peminjaman-view box box-primary">

    <br>

    <p>
        <?php if (User::isAdmin()) { ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?php } ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php if (User::isAdmin()) { ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //  [
            // 'attribute' => 'id_dosen_staf',
            // 'value' => $model->dosenStaf->nama,
            // ],
            [
            'attribute' => 'id_mhs',
            'value' => @$model->mhs->nama,
            ],
            [
                'label'=> 'Status',
                'value' =>function ($model){
                    if ($model->status == 1) {
                      return  "menunggu verifikasi";
                    };
                    if ($model->status == 2) {
                        return "sedang dipinjam";
                    };
                    if ($model->status == 3) {
                        return "sudah dibalikan";
                    };
                }
            ],

            [
                'attribute' => 'tgl_pinjam',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tgl_pinjam);
                },
            ],
              [
                'attribute' => 'tgl_kembali',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tgl_kembali);
                },
            ],
            // [

            //     'attribute' => 'tgl_kembali',
            //     'format' => 'raw',
            //     'value' => function($data) {
            //         return Helper::getTanggalSingkat($data->tgl_kembali);
            //     },
            // ],
            'keterangan',
             // [
             //        'label' => 'Jumlah Barang yang dipinjam',
             //        'value' => $model->getJumlahBarangPinjam()
             //    ],

            // [
            //     'label'=>'pilih barang',
            //     'format' => 'raw',
            //     'value' =>  Html::a(' Pilih barang', ['detail-pinjam/create/','id_pinjam' => $model->id], ['class' => 'btn btn-warning btn-flat']) 
            // ],
             [
                'label'=>'Konfirmasi Peminjaman',
                'format' => 'raw',
                'value' =>  Html::a('<i class="fa fa-check"></i> Konfirmasi', ['peminjaman/acc-barang', 'id' => $model->id], ['data' => ['confirm' => 'Apa anda yakin ingin menyutujui peminjaman ini?'],] ) 
            ],
        ],
    ]) ?>

<?php } ?>
 
 <?php if (User::isMhs()) { ?>
 <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //  [
            // 'attribute' => 'id_dosen_staf',
            // 'value' => $model->dosenStaf->nama,
            // ],
            [
            'attribute' => 'id_mhs',
            'value' => @$model->mhs->nama,
            ],
            [
                'label'=> 'Status',
                'value' =>function ($model){
                    if ($model->status == 1) {
                      return  "menunggu verifikasi";
                    };
                    if ($model->status == 2) {
                        return "sedang dipinjam";
                    };
                    if ($model->status == 3) {
                        return "sudah dibalikan";
                    };
                }
            ],

            [
                'attribute' => 'tgl_pinjam',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tgl_pinjam);
                },
            ],
              [
                'attribute' => 'tgl_kembali',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tgl_kembali);
                },
            ],
            // [

            //     'attribute' => 'tgl_kembali',
            //     'format' => 'raw',
            //     'value' => function($data) {
            //         return Helper::getTanggalSingkat($data->tgl_kembali);
            //     },
            // ],
            'keterangan',
             // [
             //        'label' => 'Jumlah Barang yang dipinjam',
             //        'value' => $model->getJumlahBarangPinjam()
             //    ],

            // [
            //     'label'=>'pilih barang',
            //     'format' => 'raw',
            //     'value' =>  Html::a(' Pilih barang', ['detail-pinjam/create/','id_pinjam' => $model->id], ['class' => 'btn btn-warning btn-flat']) 
            // ],
        ],
    ]) ?>
<?php } ?>

</div>


 <?php if (User::isMhs()): ?>
    <p>NB: Jika meminjam laptop/komputer sangat disarankan untuk tidak menyimpan data permanen</p>
<?php endif ?>
<div>&nbsp;</div>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Daftar Barang yang di pinjam.</h3>
    </div>
    
    <div class="box-body">
        <?php if (User::isAdmin()) { ?>
     <?= Html::a('<i class="fa fa-plus"> Tambah Barang</i>', ['detail-pinjam/create', 'id_pinjam' => $model->id], ['class' => 'btn btn-success']) ?> 
 <?php } ?>
     <?php if (User::isMhs()) { ?>
          <?= Html::a('<i class="fa fa-plus"> Pilih Barang</i>', ['site/dashboard', 'id_pinjam' => $model->id], ['class' => 'btn btn-success']) ?>
          <?php } ?>
        <div>&nbsp;</div>
          <table class="table">
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Barang</th>
                <th>Jumlah</th>
            </tr>
            <?php $no=1; ?>
            <?php $semuaPeminjaman = $model->findAllDetailPinjam(); ?>
            <?php foreach ($semuaPeminjaman as $peminjaman): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $peminjaman->inventarisBrg->kode_brg ?></td>
                <td><?= $peminjaman->inventarisBrg->nama_brg ?></td>
                <td><?= $peminjaman->inventarisBrg->jumlah_brg ?></td>
            </tr>
            <?php endforeach ?>
        </table>