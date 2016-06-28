<?php
/*
<div class="vkgroup-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
*/
?>

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
            [
                'attribute'			=> '',
                'content'			=> 
                function($model) {
                    return Html::a('Обновить список пользователей группы', ['update-users', 'id' => $model->id], [
                        'class' => 'btn btn-success',
                        'data' => [
                            /*'confirm' => 'Все группы и пользователи будут удалены!',*/
                            'method' => 'post',
                        ],
                    ]);
                },
            ],            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>
        <?= Html::a('Обновить БД пользователей для всех групп', ['explode-one', 'id' => 0, 'row' => 0], ['class' => 'btn btn-primary']) ?>
        
    </p>
    </p>
    
    <p>
        <?= Html::a('Очистить таблицу', ['delete-all'/*, 'id' => $model->id*/], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Все группы и пользователи будут удалены!',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
</div>
