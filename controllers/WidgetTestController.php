<?php

namespace app\controllers;

use Yii;

class WidgetTestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //return Yii::$app->response->sendFile('files/hello.txt')->send();
        
        /*$search_some = 'Examples';        
        return $this->redirect([
            'main/search',
            'search' => $search_some
        ]);*/
        
        return $this->render('index');
    }

}
