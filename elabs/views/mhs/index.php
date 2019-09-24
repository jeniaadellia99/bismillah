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

         <div class="btn-group">
            <?= Html::a('<i class="fa fa-print"> Export Excel All</i>', ['export-excel'], ['class' => 'btn bg-olive']) ?>
            <button type="button" class="btn bg-navy" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><?= Html::a('Export Excel Teknik Informatika', ['export-excel-ti'], ['class' => 'btn btn-flat']) ?></li>
              <li><?= Html::a('Export Excel Teknik Mesin', ['export-excel-tm'], ['class' => 'btn btn-flat']) ?></li>
              <li><?= Html::a('Export Excel Teknik Pendingin dan tata udara', ['export-excel-tp'], ['class' => 'btn btn-flat']) ?></li>
            </ul>
          </div>
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
