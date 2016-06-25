<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vkmember */

$this->title = 'Update Vkmember: ' . $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Vkmembers', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vkmember-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
