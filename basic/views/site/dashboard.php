<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Mhs;
use app\models\InventarisBrg;
use app\models\Peminjaman;
use app\models\PemakaianLab;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
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
    <!-- ./col -->








   
</div>




