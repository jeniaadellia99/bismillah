<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengembalian */

$this->title = 'Pengembalian';
$this->params['breadcrumbs'][] = ['label' => 'Pengembalian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengembalian-create box">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
