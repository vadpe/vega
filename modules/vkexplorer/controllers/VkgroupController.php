<?php

namespace app\modules\vkexplorer\controllers;

//use yii\web\Controller;
use Yii;
use app\modules\vkexplorer\models\Vkgroup;
use app\modules\vkexplorer\models\VkgroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Default controller for the `vkgroup` module
 */
class VkgroupController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            
        ];
    }

    /**
     * Lists all Vkgroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VkgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vkgroup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vkgroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vkgroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vkgroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vkgroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vkgroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vkgroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vkgroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionUpdateUsers($id) {
        
        $model = Vkgroup::findOne(['id' => $id]);
        //$model->getMembers(false);
        $model->getMembers1();
        
        return $this->redirect(['index']);
    }    
    
    public function actionDeleteAll() {
      
        Vkgroup::deleteAll();
        
        return $this->redirect(['index']);
    }
    
    //public $row = 0;
    public function actionExplodeOne($id, $row) {

        //static $row = 0;
        
        set_time_limit(1000);

        $rowNum = Vkgroup::find()->count();
        if (!$rowNum) {
            return $this->redirect(['index']);
        }
        
        $vkGroup = Vkgroup::findBySql('SELECT id FROM vkgroup ORDER BY id LIMIT ' . $row . ', 1')->one();
        
        $model = $this->findModel($vkGroup->id);
        
        //if ($row === 0) {
        //    $model->started = 1;
        //}
        $model->getMembers((int)$row === 0);
        
        $row++;
        
        if ($row >= $rowNum) {
            $row = 0;
            return $this->redirect(['index']);
        }
        else {
            $vkGroup = Vkgroup::findBySql('SELECT id FROM vkgroup ORDER BY id LIMIT ' . $row . ', 1')->one();
            return $this->redirect(['explode-one', 'id' => $vkGroup->id, 'row' => $row]);
        }
    }

    public function actionExplodeAll() {
      /*
        $models = Vkgroup::find()->all();
        foreach ($models as $model) {
            $model->getMembers();
        }
        
        return $this->redirect(['/vkexplorer/vkmember/index']);
       */
        
        /*$rowNum = Vkgroup::find()->count();
        if ($rowNum) {
            return $this->redirect(['explode-one', 'id' => 0]);
        }
        else {
            return $this->redirect(['index']);
        }*/
    }
}
