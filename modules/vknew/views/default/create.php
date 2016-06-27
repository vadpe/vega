<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vknew */

$this->title = 'Create Vknew';
//$this->params['breadcrumbs'][] = ['label' => 'Vknews', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vknew-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
