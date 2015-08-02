<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Invite;
use frontend\models\User;
use frontend\models\InviteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * InviteController implements the CRUD actions for Invite model.
 */
class InviteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Invite models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InviteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invite model.
     * @param integer $_id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Invite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Invite();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Invite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Invite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Invite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Invite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invite::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionInvitations()
    {
     
        $datas=Invite::find()->where(['status'=>1,'user_id'=>new \MongoId(Yii::$app->user->identity->_id)])->asArray()->all();                
        $j=0;
        foreach ($datas as $key => $value)
        {
              
            $doc=User::find()->where(["_id"=>$datas[$j]['user_id']])->one(); 
            $patient=User::find()->where(["_id"=>$datas[$j]['patient_id']])->one();            
            $datas[$j]['docname']=$doc->username;
            $datas[$j]['patientname']=$patient->username;             
            $j=$j+1;
        }    

        

        return $this->render('invitations', ['datas' => $datas]);
    }

    public function actionDecide()
    {
        $inviteid = Yii::$app->request->getQueryParam('id', '');
        $status = Yii::$app->request->getQueryParam('status', '');        
        $invite = Invite::find()->where(["_id"=>$inviteid])->one();
        if($status=='1')
        {
            $invite->status=2;  
        }        
        if($status=='2')
        {
            $invite->status=3;  
        }
        $invite->save();
        return $this->redirect(['invitations']);

    }

}
