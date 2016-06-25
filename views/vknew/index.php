<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VknewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сводная таблица новых участников групп ВК (c момента последнего запуска)';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vknew-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /*echo Html::a('Create Vknew', ['create'], ['class' => 'btn btn-success'])*/ ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'vk_id',
            'create_date',
            'vkgroup_url:url',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => 
                [
                    'view' => 
                    function ($url, $model, $key) {
                        return '';
                    },
                    'update' => 
                    function ($url, $model, $key) {
                        return '';
                    },
                ],                
            ],
        ],
    ]); ?>
</div>
