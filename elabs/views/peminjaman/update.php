<?php

use yii\helpers\Html;
use app\models\Mhs;

/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title = 'Update Peminjaman: ' .  $model->mhs->nama;
$this->params['breadcrumbs'][] = ['label' => 'Peminjaman', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mhs->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peminjaman-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
