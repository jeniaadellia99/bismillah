<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use app\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title = "Nama Peminjam:".@$model->id_mhs->nama;
$this->params['breadcrumbs'][] = ['label' => 'Peminjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="peminjaman-view box box-primary">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
             [
            'attribute' => 'id_dosen_staf',
            'value' => $model->dosenStaf->nama,
            ],
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
            // [

            //     'attribute' => 'tgl_kembali',
            //     'format' => 'raw',
            //     'value' => function($data) {
            //         return Helper::getTanggalSingkat($data->tgl_kembali);
            //     },
            // ],
            'keterangan',

            [
                'label'=>'pilih barang',
                'format' => 'raw',
                'value' =>  Html::a(' Pilih barang', ['detail-pinjam/create/','id_pinjam' => $model->id], ['class' => 'btn btn-warning btn-flat']) 
            ],
        ],
    ]) ?>

</div>

<div>&nbsp;</div>

<div class="box box-primary">

    <div class="box-header">
        <h3 class="box-title">Daftar Barang yang terkait.</h3>
    </div>
    
    <div class="box-body">

        <?= Html::a('<i class="fa fa-plus"> Tambah Peminjaman</i>', ['detail-pinjam/create', 'id_pinjam' => $model->id], ['class' => 'btn btn-success']) ?>
        <div>&nbsp;</div>
          <table class="table">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>&nbsp;</th>
            </tr>
            <?php $no=1; ?>
            <?php $semuaPeminjaman = $model->findAllDetailPinjam(); ?>
            <?php foreach ($semuaPeminjaman as $peminjaman): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $detail_pinjam->id_pinjam ?></td>
                
            </tr>
            <?php $no++; endforeach ?>
        </table>