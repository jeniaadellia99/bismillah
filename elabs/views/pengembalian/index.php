<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PengembalianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengembalian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengembalian-index box box-primary">

    <h1><?= Html::encode($this->title) ?></h1>

   <!--  <p>
         <?= Html::a('Tambah Pengembalian', ['create'], ['class' => 'btn btn-success']) ?> 
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
            'id_pinjam',
            [
                'label' => 'Tanggal Kembali',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tgl_kembali);
                },
            ],

            //  [
            //     'label' => 'Download',
            //     'format' => 'raw',
            //     'value' => function($data) {
            //         return Html::a('<i class="fa fa-print"></i> Download', ['export-pdf', 'id' => $data->id], ['class' => 'btn bg-olive']);
            //     },
            // ],
           
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
