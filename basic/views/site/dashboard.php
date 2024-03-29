<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Mhs;
use app\models\InventarisBrg;
use app\models\InventarisBrgSearch;
use app\models\Peminjaman;
use app\models\PemakaianLab;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;
use miloschuman\highcharts\Highcharts;
use app\models\KategoriBrg;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (User::isAdmin()): ?>
<div class="row">
    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
    <div class="inner">
            <b>Jumlah Mahasiswa</b>
            <h3><?= Yii::$app->formatter->asInteger(Mhs::getCount()); ?></h3>
        </div>
        <div class="icon">
            <i class="fa fa-users"></i>
        </div>
        <a href="<?=Url::to(['mhs/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
    <!-- ./col -->


    <div class="col-md-3 col-xs-6">
        <!-- small box -->
          <div class="small-box bg-teal">
    <div class="inner">
            <b>Jumlah Invetaris Barang</b>
            <h3><?= Yii::$app->formatter->asInteger(InventarisBrg::getCount()); ?></h3>
        </div>
        <div class="icon">
            <i class="fa fa-database"></i>
        </div>
        <a href="<?=Url::to(['InventarisBrg/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
    <!-- ./col -->

    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-light-blue">
            <div class="inner">
            <b>Jumlah Peminjaman</b>
            <h3><?= Yii::$app->formatter->asInteger(Peminjaman::getCount()); ?></h3>
        </div>
        <div class="icon">
            <i class="fa fa-comments-o"></i>
        </div>
        <a href="<?=Url::to(['Peminjaman/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
    <!-- ./col -->

    <div class="col-md-3 col-xs-6">
        <!-- small box -->
       <div class="small-box bg-lime">
            <div class="inner">
            <b>Jumlah Pemakaian Lab</b>
            <h3><?= Yii::$app->formatter->asInteger(PemakaianLab::getCount()); ?></h3>
        </div>
        <div class="icon">
            <i class="fa fa-comments-o"></i>
        </div>
        <a href="<?=Url::to(['pemakaian-lab/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
</div>

<div class="row">
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Barang Berdasarkan Kategori</h3>
                </div>
                <div class="box-body">
                    <?=Highcharts::widget([
                    'options' => [
                        'credits' => false,
                        'title' => ['text' => 'KATEGORI'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'pie' => [
                                'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                                'type' => 'pie',
                                'name' => 'Kategori',
                                'data' => KategoriBrg::getGrafikList(),
                            ],
                        ],
                    ],
                ]);?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Peminjaman Berdasarkan Barang</h3>
                </div>
                <div class="box-body">
                    <?= \miloschuman\highcharts\Highcharts::widget([
                    'options' => [
                        'credits' => true,
                        'title' => ['text' => 'PEMINJAMAN'],
                        'exporting' => ['enabled' => true],
                        'xAxis' => [
                            'categories' => \app\components\Helper::getListBulanGrafik(),
                        ],
                        'series' => [
                            [
                                'type' => 'column',
                                'colorByPoint' => true,
                                'name' => 'Peminjaman',
                                'data' => \app\models\Peminjaman::getCountGrafik(),
                                'showInLegend' => false
                            ],
                        ],
                    ]
                ]) ?>
                </div>
            </div>
        </div>

    </div>

<?php endif ?>

<?php if (User::isMhs()): ?>
    <!-- CARIII -->
    <div class="row">
    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pencarian Barang</h3>
            </div>
            <div class="box-body">
                <?= $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
    </div>
</div>

    <?php foreach ($provider->getModels() as $inventarisBrg) {?> 
        <!-- Kolom box mulai -->
        <div class="col-md-4" style="height: 550px;">

            <!-- Box mulai -->
            <div class="box box-widget">

                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle"  <?= User::getFotoMhs(['class' => 'user-image']); ?> 
                        <span class="username"><?= Html::a($inventarisBrg->nama_brg, ['inventaris_brg/view', 'id' => $inventarisBrg->id]); ?></span>
                    </div>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read"><i class="fa fa-circle-o"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <center>
                        <img style="height: 300px" class="img-responsive pad" src="<?= Yii::$app->request->baseUrl.'/upload/barang/'.$inventarisBrg['foto']; ?>" alt="Photo">
                    </center>
                    <?= Html::a("<i class='fa fa-eye'> Detail Barang</i>",["inventaris_brg/view","id"=>$inventarisBrg->id],['class' => 'btn btn-default']) ?>
                    <?= Html::a('<i class="fa fa-file"> Pinjam Barang</i>', ['peminjaman/create', 'id_brg' => $inventarisBrg->id], ['class' => 'btn btn-primary',
                        'data' => [
                            'confirm' => 'Do you want to borrow it?',
                        ],
                    ]) ?>
                    <!-- <span class="pull-right text-muted">127 Peminjam - 3 Komentar</span> -->
               </div>

            </div>
            <!-- Box selesai -->

        </div>
        <!-- Kolom box selesai -->  
    <?php
        }
    ?>

<!-- Pagingation -->
<div class="row">
    <center>
        <?= LinkPager::widget([
            'pagination' => $provider->pagination,
        ])?>
    </center>
</div>

<?php endif ?>


