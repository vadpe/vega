<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>

    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" >
        
        <head>
            <meta charset="<?= Yii::$app->charset ?>" >
            <?php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']); ?>
            <title>
                <?= Yii::$app->name ?>
            </title>
            <?php $this->head(); ?>
        </head>
        
        <body>
            <?php $this->beginBody(); ?>

            <div class="wrap">
                <?php
                NavBar::begin(
                    [
                        'options' => [
                            'class' => 'navbar',
                            'id'    => 'main-menu',
                            
                        ],
                        'renderInnerContainer' => true,
                        'innerContainerOptions' => [
                            'class' => 'container'
                        ],
                        'brandLabel' => '<img src="' . Yii::$app->request->BaseUrl . '/img/brand.gif" />',
                        'brandUrl' => ['main/index'],
                        'brandOptions' => [
                            'class' => 'navbar-brand'
                        ],
                    ]
                );
                
                ActiveForm::begin(
                    [
                        'action' => ['main/search'],
                        'method' => 'post',
                        'options' =>
                        [
                            'class' => 'navbar-form navbar-right'
                        ]
                    ]
                );
                
                echo '<div class="input-group input-group-sm">';
                
                echo Html::input(
                        'type: text',
                        'search',
                        '',
                        [
                            'placeholder' => 'Search...',
                            'class' => 'form-control'
                        ]
                    );
                
                echo '<span class="input-group-btn">';
                
                echo Html::submitButton(
                        '<span class="glyphicon glyphicon-search"></span>',
                        [
                            'class' => 'btn btn-success'
                        ]
                    );
                
                echo '</span>';
                echo '</div>';

                ActiveForm::end();
                
                echo Nav::widget([
                    'options' => [
                        'class' => 'navbar-nav navbar-right',
                    ],
                    'items' => [
                        [
                            'label' => 'Main <span class="glyphicon glyphicon-home"></span>',
                            'url' => ['main/index']
                        ],
                        [
                            'label' => 'From box <span class="glyphicon glyphicon-inbox"></span>',
                            'items' => 
                            [
                                '<li class="dropdown-header">Add-ons</li>',
                                '<li class="diveder"></li>',
                                [
                                    'label' => 'Go to view',
                                    'url' => ['widget-test/index']
                                ]
                            ]
                        ],
                        [
                            'label' => 'About <span class="glyphicon glyphicon-question-sign"></span>',
                            'url' => ['#'],
                            'linkOptions' => [
                                'data-toggle' => 'modal',
                                'data-target' => '#modal',
                                'style' => 'cursor: pointer, outline: none'
                            ]
                        ]
                    ],
                    'encodeLabels' => false
                ]);
                
                Modal::begin([
                    'header' => '<h2>Vega</h2>',
                    'id' => 'modal'
                ]);
                
                echo 'Advanced project';
                
                Modal::end();
                
                NavBar::end();
                ?>
                
                <div class="container">
                    <?= $content ?>
                </div>
                
            </div>
            
            <footer class="footer">
                <div class="container">
                    <span class="badge">
                        <span class="glyphicon glyphicon-copyright-mark"></span>
                        Vega <?= date('Y'); ?>
                    </span>
                </div>
            </footer>
                        
            <?php $this->endBody(); ?>
        </body>
        
    </html>

<?php $this->endPage() ?>
