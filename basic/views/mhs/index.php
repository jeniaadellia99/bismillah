<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Jurusan;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MhsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mahasiswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhs-index box box-primary">
  <div class="box-body table-responsive">
  

    <p>
        <?= Html::a('Tambah Mahasiswa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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


            ['attribute'=>'nama',
              'headerOptions' => ['style'=>'text-align:center;'],
              'contentOptions' => ['style'=>'text-align:center']
            ],
            [
               'attribute' =>'id_jurusan',
               'filter' => Jurusan::getList(),
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
               'value' => function($data){
                return @$data->jurusan->nama;
               }
           ],
           'nim',
           [
              'attribute' => 'foto',
              'format' =>'raw',
              'headerOptions' => ['style' => 'text-align:center;'],
              'value' => function ($model){
                if ($model->foto != '') {
                    return Html::img('@web/upload/mhs/'. $model->foto,['class'=>'img-responsive','style' => 'height:150px', 'align'=>'center']);
                }else{
                  return '<div align="center"><h2>No Image</h2></div>';
                }
              },
            ],
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
