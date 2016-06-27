<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vkgroup */

$this->title = 'Добавить группу';
//$this->params['breadcrumbs'][] = ['label' => 'Vkgroups', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vkgroup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
