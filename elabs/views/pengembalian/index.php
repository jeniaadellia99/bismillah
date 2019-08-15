<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\InventarisBrg;
use app\models\DosenStaf;
use app\models\Mhs;
use kartik\date\DatePicker;
use app\components\Helper;
use app\models\User;
use app\models\Pengembalian;
use app\models\Peminjaman;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeminjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengembalian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-index box box-primary">

    <h1><?= Html::encode($this->title) ?></h1>
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
               'attribute' =>'id_dosen_staf',
               'filter' => DosenStaf::getList(),
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
               'value' => function($data){
                return @$data->dosenStaf->nama;
               }
           ],
             [
               'attribute' =>'id_inventaris_brg',
               'filter' => InventarisBrg::getList(),
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
               'value' => function($data){
                return @$data->inventarisBrg->nama_brg;
               }
           ],

            [
               'attribute' =>'id_mhs',
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
                        'attribute' => 'status',
                        'label'=>'Status',
                        'encodeLabel'=>false,
                    //     'value' => function($data) {
                    // return Pengembalian::getStatus($data->status);
                    // },
                         'value' => function($data) {
                     return Peminjaman::find()->andWhere(['status' => 2]);
                },
            ],
             [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{kembalikan}',
                        'buttons' => [
                            'kembalikan' => function($url, $model, $key) {
                                return Html::a('<i class="fa fa-check-square-o"></i>', ['kembalikan-barang', 'id' => $model->id], ['data' => ['confirm' => 'Apa anda yakin ingin mengembalikan Barang ini?'],]);
                            }
                        ]
                    ],           
           
          
        ],
    ]); ?>