<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box box-primary">
       <div class="box-body table-responsive">

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
            'username',
             [  
                    'attribute' => 'id_user_role',
                    'value' => function($data)
                    {
                        return $data->getUserRole();
                    }
                ],
            // 'password',
            // 'id_mhs',
            // 'id_user_role',
            //'token',

            ['class' => 'yii\grid\ActionColumn',
              'template' => '{view} {update} {delete} {resetpassword} {changepassword}',
            'buttons' => [
                        'resetpassword' => function($url, $model, $key) {
                            return Html::a('<i class="fa fa-refresh"></i>', ['reset-password', 'id' => $model->id], ['data' => ['confirm' => 'do you want to user this for reset password?'],]);
                        },
                         'changepassword' => function($url, $model, $key) {
                            return Html::a('<i class="fa fa-key"></i>', ['change-password', 'id' => $model->id]);
                        },
                    ]
        ],
        ],
    ]); ?>


</div>
</div>
