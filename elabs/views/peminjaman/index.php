<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\InventarisBrg;
use app\models\DosenStaf;
use app\models\Mhs;
use kartik\date\DatePicker;
use app\components\Helper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeminjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peminjaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-index box box-primary">

    <h1><?= Html::encode($this->title) ?></h1>
<?php if (User::isAdmin()):?>
    <p>
        <?= Html::a('Tambah Peminjaman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php endif ?>

<?php if (User::isAdmin()):?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No.',
                'headerOptions' => ['style' => 'text-align:center'],
                'contentOptions' => ['style' => 'text-align:center']
            ],
             [
               'attribute' =>'id_mhs',
               'filter' => Mhs::getList(),
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
               'value' => function($data){
                return @$data->mhs->nama;
               }
           ],
           //   [
           //     'attribute' =>'id_inventaris_brg',
           //     'filter' => InventarisBrg::getList(),
           //     'headerOptions' => ['style' => 'text-align:center;'],
           //     'contentOptions' => ['style' => 'text-align:center'],
           //     'value' => function($data){
           //      return @$data->inventarisBrg->nama_brg;
           //     }
           // ],

           
           [
                'label' => 'Tanggal Pinjam',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tgl_pinjam);
                },
          ],
           [
                'label' => 'Tanggal Kembali',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tgl_kembali);
                },
            ],
            [
                        'attribute' => 'status',
                        'label'=>'Status<br>Peminjaman',
                        'encodeLabel'=>false,
                        'value' => function ($model) {
                            if ($model->status == 1) {
                                return "menunggu verifikasi";
                            };
                            if ($model->status == 2) {
                                return "sedang di pinjam";
                            };
                            if ($model->status == 3) {
                                return "sudah dibalikan";
                            };
                        },
                        'filter'=>[
                            1 => 'menunggu verifikasi',
                            2 => 'sedang dipinjam',
                            3 => 'sudah dibalikan',
                        ],
                    ],
            'keterangan',
            [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {kembalikan} {delete}',
                        'buttons' => [
                            'kembalikan' => function($url, $model, $key) {
                                return Html::a('<i class="fa fa-check-square-o"></i>', ['acc-barang', 'id' => $model->id], ['data' => ['confirm' => 'Apa anda yakin ingin memberi barang ini?'],]);
                            }
                        ]
                    ],
        ],
    ]); ?>
<?php endif ?>
<?php if (User::isMhs()): ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No.',
                'headerOptions' => ['style' => 'text-align:center'],
                'contentOptions' => ['style' => 'text-align:center']
            ],
           //   [
           //     'attribute' =>'id_inventaris_brg',
           //     'filter' => InventarisBrg::getList(),
           //     'headerOptions' => ['style' => 'text-align:center;'],
           //     'contentOptions' => ['style' => 'text-align:center'],
           //     'value' => function($data){
           //      return @$data->inventarisBrg->nama_brg;
           //     }
           // ],

            [
               'attribute' =>'id_mhs',
               'filter' => Mhs::getList(),
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
               'value' => function($data){
                return @$data->mhs->nama;
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
            [
                        'attribute' => 'status',
                        'label'=>'Status<br>Peminjaman',
                        'encodeLabel'=>false,
                        'value' => function ($model) {
                            if ($model->status == 1) {
                                return "menunggu verifikasi";
                            };
                            if ($model->status == 2) {
                                return "sedang di pinjam";
                            };
                            if ($model->status == 3) {
                                return "sudah dibalikan";
                            };
                        },
                        'filter'=>[
                            1 => 'menunggu verifikasi',
                            2 => 'sedang dipinjam',
                            3 => 'sudah dibalikan',
                        ],
                    ],
            'keterangan',
            [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {kembalikan}',
                        'buttons' => [
                            'kembalikan' => function($url, $model, $key) {
                                return Html::a('<i class="fa fa-check-square-o"></i>', ['kembalikan-barang', 'id' => $model->id], ['data' => ['confirm' => 'Apa anda yakin ingin mengembalikan barang ini?'],]);
                            }
                        ]
                    ],

        ],
    ]); ?>

    <?php endif ?>

</div>
