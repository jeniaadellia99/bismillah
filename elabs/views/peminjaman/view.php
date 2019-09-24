<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use app\components\Helper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title = "Nama Peminjam: ".@$model->mhs->nama;
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
         <?= Html::a('<i class="fa fa-print"></i> Download', ['pdf', 'id' => $model->id], ['class' => 'btn bg-olive']) ?>
    </p>
<?php if (User::isAdmin()) { ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
            'attribute' => 'Nama',
             'value' =>function ($model){
                    if (@$model->mhs->nama) {
                      return $model->mhs->nama;
                    };
                    if (@$model->dosenStaf->nama) {
                        return$model->dosenStaf->nama;
                    };
                }
            
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
            'keterangan',
    
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
            'keterangan',
        ],
    ]) ?>
<?php } ?>

<?php if (User::isDosenStaf()) { ?>
 <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
            'attribute' => 'id_dosen_staf',
            'value' => @$model->dosenStaf->nama,
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
            'keterangan',
        ],
    ]) ?>
<?php } ?>

</div>
<div>&nbsp;</div>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Daftar Barang yang di pinjam</h3>
    </div>
    
    <div class="box-body">
        <?php if (User::isAdmin() ) { ?>
            <?php if ($model->status == 1) { ?>
                      <?= Html::a('<i class="fa fa-plus"> Tambah Barang</i>', ['detail-pinjam/create', 'id_pinjam' => $model->id], ['class' => 'btn btn-success']) ?> 
            <?php } else { ?>
     <?= Html::a('<i class="fa fa-plus"> Tambah Barang</i>', ['detail-pinjam/create', 'id_pinjam' => $model->id], ['class' => 'btn btn-success']) ?> 
     <?= Html::a('Mengembalikan Barang', ['pengembalian/create', 'id_pinjam' => $model->id], ['class'=>'btn btn-default','data' => ['confirm' => 'Apa anda yakin ingin mengembalikan barang ini?'],]) ?> 
 <?php } ?>
 <?php } ?>

     <?php if (User::isMhs() || User::isDosenStaf()) { ?>
          <?php if ($model->status == 1) { ?>
            <?= Html::a('<i class="fa fa-plus"> Pilih Barang</i>', ['site/dashboard', 'id_pinjam' => $model->id], ['class' => 'btn btn-success']) ?> 
            <?php } else { ?>
            <?php if ($model->status !== 3) { ?>
          <?= Html::a('<i class="fa fa-plus"> Pilih Barang</i>', ['site/dashboard', 'id_pinjam' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php if ($model->detailPinjam->status == 2) { ?>
           <?= Html::a('Mengembalikan Barang Semua', ['pengembalian/create', 'id_pinjam' => $model->id], ['class'=>'btn btn-default','data' => ['confirm' => 'Apa anda yakin ingin mengembalikan barang ini?'],]) ?> <?php } ?> <?php } ?> 
          <?php } ?>

         <?php } ?>
        <div>&nbsp;</div>
          <table class="table">
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Barang</th>
                <th>Stok Barang</th>
                <th>Jumlah</th>
                <th>Status</th>
                 <?php if (User::isAdmin()): ?>
                <th>Aksi</th>
                <th>Mengembalikan</th>
                 <?php endif ?>
                <th>&nbsp;</th>

            </tr>
            <?php $no=1; ?> 
            <?php $semuaPeminjaman = $model->findAllDetailPinjam(); ?>
            <?php foreach ($semuaPeminjaman as $peminjaman): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $peminjaman->inventarisBrg->kode_brg ?></td>
                <td><?= $peminjaman->inventarisBrg->nama_brg ?></td>
                <td><?= $peminjaman->inventarisBrg->jumlah_brg ?> pcs</td>
                <td><?= $peminjaman->jumlah ?></td>
                 <?php if ($peminjaman->status==1) { ?>
                        <td>Belum diverifikasi</td>
                        <?php } else { ?>
                        <td>sedang dipinjam</td>
                        <?php } ?>

                <?php if (User::isAdmin()): ?>
                <td><?= Html::a('<i class="fa fa-check-square-o">Konfirmasi</i>', ['detail-pinjam/acc-barang', 'id_detail_pinjam' => $peminjaman->id_detail_pinjam], ['data' => ['confirm' => 'Apa anda yakin ingin menyutujui barang ini?'],]); ?><br>
                    
                  <!--   <?= Html::a('<i class="fa fa-check-square-o">Konfirmasi Sebagian</i>', ['detail-pinjam/acc-sebagian', 'id_detail_pinjam' => $peminjaman->id_detail_pinjam], ['data' => ['confirm' => 'Apa anda yakin ingin menyutujui peminjaman ini?'],]); ?> -->
                <?php endif ?>
                </td>
                 <?php if ($peminjaman->status !==1) { ?>
                <td> <?= Html::a('Mengembalikan Barang', ['pengembalian/create', 'id_detail_pinjam' => $peminjaman->id_detail_pinjam, 'id_pinjam' => $peminjaman->id_pinjam], ['class'=>'btn btn-default','data' => ['confirm' => 'Apa anda yakin ingin mengembalikan barang ini?'],]) ?></td>
                 <?php } ?>
                    <?php if ($model->status !==3) { ?>
                    <!-- <?= Html::a("<i class='fa fa-pencil'> Edit</i>",["detail-pinjam/update","id"=>$peminjaman->id_detail_pinjam],['class' => 'btn btn-primary']) ?>&nbsp; -->
                <?php } ?>
                <td>
                    <?php if (User::isAdmin()) { ?>
                    <?= Html::a("<i class='fa fa-pencil'> Edit</i>",["detail-pinjam/update","id"=>$peminjaman->id_detail_pinjam],['class' => 'btn btn-primary']) ?>&nbsp;
                    <?= Html::a("<i class='fa fa-trash'> Hapus</i>",["detail-pinjam/delete","id"=>$peminjaman->id_detail_pinjam],['class' => 'btn btn-danger', 'data-method' => 'post', 'data-confirm' => 'Yakin hapus data ini?']) ?>&nbsp;
                <?php } ?>
                </td>
            </tr>
            <?php endforeach ?>
        </table>