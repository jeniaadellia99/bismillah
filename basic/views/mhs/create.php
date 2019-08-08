<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mhs */

$this->title = 'Tambah Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'mahasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhs-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
