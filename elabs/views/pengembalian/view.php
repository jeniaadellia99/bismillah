<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\Helper;
use app\models\User;
use app\models\Peminjaman;


/* @var $this yii\web\View */
/* @var $model app\models\Pengembalian */

$this->title = "Pengembalian";
$this->params['breadcrumbs'][] = ['label' => 'Pengembalian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pengembalian-view box box-primary">
    <div class="box-header">
        <h3 class="box-title">Daftar Barang yang di kembalikan</h3>
    </div>
    <div class="box-body">
          <!-- <div>&nbsp;</div> -->
          <table class="table">
             <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <!-- <th>Jumlah</th> -->
                <th>total barang yang dipinjam</th>
            </tr>
            <?php $no=1; ?> 
            <?php //print_r($semuaPeminjaman); //= $model->findAllDetailPinjam(); ?>
            <?php foreach ($semuaPeminjaman as $peminjaman): ?>
             <tr>
                <td><?= $no++;?></td>
                <td><?= $peminjaman->inventarisBrg->kode_brg ?></td>
                <td><?= $peminjaman->inventarisBrg->nama_brg ?></td>
               <!--  <td><?= $peminjaman->inventarisBrg->jumlah_brg ?> pcs</td> -->
                <td><?= $peminjaman->jumlah ?></td>
            </tr>
            <?php endforeach ?>
        </table><div>&nbsp;</div>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="fa fa-print"></i> Download', ['pdf', 'id' => $model->id], ['class' => 'btn bg-olive']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'tgl_kembali',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tgl_kembali);
                },
            ],
            [
                        'attribute' => 'Telat',
                        'value' => function ($model) {
                            if ($model->peminjaman->tgl_kembali <= date('Y-m-d')) {
                                return $model->getSelisih() . " Hari";
                            } else {
                                return "0 Hari";
                            };
                        },
                    ],
            [
                'label'=> 'Kondisi',
                'value' =>function ($model){
                    if ($model->kondisi == 1) {
                      return  "Baik dan Lengkap";
                    };
                    if ($model->kondisi == 2) {
                        return "Baik dan Tidak Lengkap";
                    };
                    if ($model->kondisi == 3) {
                        return "Rusak Ringan";
                    };
                    if ($model->kondisi == 4) {
                        return "Rusak berat";
                    }
                }
            ],
        ],
    ]) ?>

</div>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Peminjaman</h3>
        <?php //print_r($model->peminjaman); ?>
         <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
            'attribute' => 'Nama',
            'value' => $mahasiswa->nama,
            ],
            [
                'label'=> 'Status',
                'value' =>function ($model){
                    if ($model->peminjaman->status == 1) {
                      return  "menunggu verifikasi";
                    };
                    if ($model->peminjaman->status == 2) {
                        return "sedang dipinjam";
                    };
                    if ($model->peminjaman->status == 3) {
                        return "sudah dibalikan";
                    };
                }
            ],

            [
                'label' => 'Tanggal Pinjam',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->peminjaman['tgl_pinjam']);
                },
            ],
              [
                'attribute' => 'Rencana Tanggal Kembali',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->peminjaman['tgl_kembali']);
                },
            ],
             [
                'label' => 'Keterangan',
                'format' => 'raw',
                'value' => $model->peminjaman->keterangan,
            ],
        ],
    ]) ?>
    </div>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Daftar Barang yang di pinjam</h3>
    </div>
    <div class="box-body">
          <table class="table">
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Barang</th>
                <th>Stok Barang</th>
                <th>Jumlah</th>
                <th>Aksi</th>
                <th>d</th>
            </tr>
            <?php $no=1; ?> 
            <?php //$semuaPeminjaman = $model->findAllDetailPinjam(); ?>
            <?php foreach ($semuaPeminjaman as $peminjaman): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $peminjaman->inventarisBrg->kode_brg ?></td>
                <td><?= $peminjaman->inventarisBrg->nama_brg ?></td>
                <td><?= $peminjaman->inventarisBrg->jumlah_brg ?> pcs</td>
                <td><?= $peminjaman->jumlah ?></td>
                  <td>
                    <?php if (User::isAdmin()) { ?>
                    <?= Html::a("<i class='fa fa-trash'> Hapus</i>",["detail-pinjam/delete","id"=>$peminjaman->id_detail_pinjam],['class' => 'btn btn-danger', 'data-method' => 'post', 'data-confirm' => 'Yakin hapus data ini?']) ?>&nbsp;
                <?php } ?>
            </td>
            <td><?= $peminjaman->status ?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
</div>
