<?php
/*
<div class="vknew-default-index">
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
    
    <p>
        <?= Html::a('Очистить таблицу', ['delete-all'], ['class' => 'btn btn-danger']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'			=> 'vk_id',
                'content'			=> 
                function($model) {
                    $url = 'https://vk.com/id' . $model->vk_id;
                    return Html::a($url, $url);
                },
            ],
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
