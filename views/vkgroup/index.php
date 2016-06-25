<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VkgroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Таблица групп ВК';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vkgroup-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить группу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'url:url',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>
        <?= Html::a('Обновить БД пользователей для всех групп', ['explode'], ['class' => 'btn btn-primary']) ?>
    </p>       
    
</div>
