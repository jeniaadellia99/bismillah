<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PemakaianLab */

$this->title = 'Tambah Pemakaian Lab';
$this->params['breadcrumbs'][] = ['label' => 'Pemakaian Lab', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemakaian-lab-create box box-primary">

  
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
