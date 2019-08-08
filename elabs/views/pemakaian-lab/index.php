<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use app\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PemakaianLabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemakaian Laboratorium';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemakaian-lab-index box box-primary">

   <div class="box-header">
    
    <?= Html::a('<i class="fa fa-print"></i> Export Pdf', Yii::$app->request->url.'&export-pdf=1', ['class' => 'btn btn-danger btn-flat','target' => '_blank']) ?> 
    <?= Html::a('<i class="fa fa-print"></i> Export Excel', Yii::$app->request->url.'&export-excel=1', ['class' => 'btn btn-warning btn-flat','target' => '_blank']) ?>
       
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
            [
                'attribute' => 'nama_pengguna',
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
             [
                'attribute' => 'date',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->date);
                },
                'headerOptions' => ['style' => 'text-align:center; width:100px'],
                'contentOptions' => ['style' => 'text-align:center;'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
