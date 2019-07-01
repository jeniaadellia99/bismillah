<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PemakaianLabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemakaian Laboratorium';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemakaian-lab-index box box-primary">

   <div class="box-header">
     <!--    <?= Html::a('Tambah Data Penduduk', ['create'], ['class' => 'btn btn-success']) ?> -->
       
    </div>

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
            //     'attribute' => 'id_mhs',
            //     'headerOptions' => ['style' => 'text-align:center'],
            // ],
            [
                'attribute' => 'kode_lab',
                'headerOptions' => ['style' => 'text-align:center'],
            ],

            [
                'attribute' => 'nama_lab',
                'headerOptions' => ['style' => 'text-align:center'],
            ],
            [
                'attribute' => 'mata_kuliah',
                'headerOptions' => ['style' => 'text-align:center'],
            ],
            // [
            //     'attribute' => 'waktu_mulai',
            //     'headerOptions' => ['style' => 'text-align:center'],
            // ],
           
            // [
            //     'attribute' => 'waktu_selesai',
            //     'headerOptions' => ['style' => 'text-align:center'],
            // ],
            // //'keterangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
