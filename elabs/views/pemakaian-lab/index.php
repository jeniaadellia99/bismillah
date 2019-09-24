<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use app\components\Helper;
use  app\models\Lab;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PemakaianLabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemakaian Laboratorium';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemakaian-lab-index box box-primary">

   <div class="box-header">
    
    <?= Html::a('<i class="fa fa-print"></i> Export Excel', Yii::$app->request->url.'&export-excel=1', ['class' => 'btn btn-warning btn-flat','target' => '_blank']) ?>

         <div class="btn-group">
        <?= Html::a('<i class="fa fa-print"></i> Export Pdf', Yii::$app->request->url.'&export-pdf=1', ['class' => 'btn btn-warning btn-flat','target' => '_blank']) ?> 
            <button type="button" class="btn btn-warning" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><?= Html::a('Export PDF LAB SO', ['pdf-so'], ['class' => 'btn btn-flat']) ?></li>
              <li><?= Html::a('Export PDF LAB Pemrograman', ['pdf-pemrog'], ['class' => 'btn btn-flat']) ?></li>
              <li><?= Html::a('Export PDF TUK', ['pdf-tuk'], ['class' => 'btn btn-flat']) ?></li>
            </ul>
          </div>
       
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
               'attribute' =>'id_lab',
               'filter' => Lab::getList(),
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
               'value' => function($data){
                return @$data->lab->nama;
               }
           ],
            [
                'attribute' => 'mata_kuliah',
                'headerOptions' => ['style' => 'text-align:center'],
            ],
             [
                'attribute' => 'date',
                'format' => 'raw',
                'filter'=>DatePicker::widget([
                            'model'=>$searchModel,
                            'attribute'=>'date',
                            'pluginOptions'=>[
                                'format' => 'dd-mm-yyyy'
                            ]
                        ]),
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->date);
                },
                'headerOptions' => ['style' => 'text-align:center; width:100px'],
                'contentOptions' => ['style' => 'text-align:center;'],
            ],

             [
                'attribute' => 'tgl_keluar',
                'format' => 'raw',
                'filter'=>DatePicker::widget([
                            'model'=>$searchModel,
                            'attribute'=>'tgl_keluar',
                            'pluginOptions'=>[
                                'format' => 'dd-mm-yyyy'
                            ]
                        ]),
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tgl_keluar);
                },
                'headerOptions' => ['style' => 'text-align:center; width:100px'],
                'contentOptions' => ['style' => 'text-align:center;'],
            ],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
