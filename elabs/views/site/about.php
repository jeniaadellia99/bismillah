<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Mhs;
use app\models\User;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

      <?php if (User::isMhs()): ?>
               <h1>Selamat Datang, <?= Yii::$app->user->identity->mhs->nama; ?></h1>
               <?php endif ?>
             <?php if (User::isDosenStaf()): ?>
               <h1>Selamat Datang, <?= Yii::$app->user->identity->dosenStaf->nama; ?></h1>
               <?php endif ?>

   <!--  <code><?= __FILE__ ?></code> -->
</div>
