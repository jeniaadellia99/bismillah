<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Mhs;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Selamat Datang, <?= Yii::$app->user->identity->mhs->nama; ?></h1>

    

   <!--  <code><?= __FILE__ ?></code> -->
</div>
