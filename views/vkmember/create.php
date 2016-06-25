<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vkmember */

$this->title = 'Create Vkmember';
//$this->params['breadcrumbs'][] = ['label' => 'Vkmembers', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vkmember-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
