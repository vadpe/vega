<?php

use app\components\FirstWidget;
use app\components\SecondWidget;
use yii\bootstrap\Modal;
use yii\jui\DatePicker;
use yii\jui\SliderInput;

/* @var $this yii\web\View */
/* @var $hello string */
?>

<h1>main/index</h1>

<p>
    <?= $hello ?>
</p>

<?= FirstWidget::widget(['a' => 33, 'b' => 67]); ?>

<?php SecondWidget::begin(); ?>

    This text should be red.

<?php SecondWidget::end() ?>

<?php
Modal::begin(
    [
        'header' => '<h2> Hello world </h2>',
        'toggleButton' => ['label' => 'Click me']
    ]
);

echo 'This is MODAL windows content';

Modal::end();
?>

    <br>
    
<?= DatePicker::widget(
    [
//        'model' => $model,
        'attribute' => 'from_date',
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd'
    ]
);
?>

<?= SliderInput::widget(
    [
//        'model' => $model,
//        'attribute' => 'from_date',
//        'language' => 'ru',
//        'dateFormat' => 'yyyy-MM-dd'
    ]
);
?>
