<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\RegForm;
use app\models\LoginForm;

class MainController extends Controller
{
    public $layout = 'basic';
    public $defaultAction = 'index';
    
    public function actionIndex()
    {
        $hello = 'Hello, world!';
        
        return $this->render(
            'index',
            [
                'hello' => $hello
            ]
        );
    }
    
    public function actionReg()
    {
        $model = new RegForm();
        return $this->render('reg', ['model' => $model]);
    }
    
    public function actionLogin()
    {
        $model = new LoginForm();
        return $this->render('login', ['model' => $model]);
    }

    public function actionSearch()
    {
        $search = Yii::$app->request->/*post*/get('search');
        
        return $this->render(
            'search',
            [
                'search' => $search
            ]
        );
    }
}
