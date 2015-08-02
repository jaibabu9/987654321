<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\UserSearch;
use frontend\models\SearchdocForm;
use frontend\models\Profile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Session;
use frontend\models\Invite;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSearchdoc()
    {   
        $model = new SearchdocForm();        
        $user_ids = array();
        $prof = new Profile();
        if(Yii::$app->request->post())
        {

            $location=$_POST['SearchdocForm']['location'];            
            $drSpecialist= $_POST['SearchdocForm']['drSpecialist'];
            $model->location=$location;
            $model->drSpecialist=$drSpecialist;
            
            if($location!="" && $drSpecialist!="")
            {

                $matched_id=ArrayHelper::map(Profile::find()->where(['drSpecialist' => new \MongoId($drSpecialist),'city'=>(string)$location])->all(), function ($prof) {
                return $prof->userId->{'$id'};
                }, 'city');

                foreach ($matched_id as $key => $value) {
                array_push($user_ids,$key);
                }

            }
            elseif($location!="")
            {
                $matched_id=ArrayHelper::map(Profile::find()->where(['city'=>(string)$location])->all(), function ($prof) {
                return $prof->userId->{'$id'};
                }, 'city');

                foreach ($matched_id as $key => $value) {
                array_push($user_ids,$key);
                }
            }
            elseif($drSpecialist!="")
            {
               
                $matched_id=ArrayHelper::map(Profile::find()->where(['drSpecialist' => new \MongoId($drSpecialist)])->all(), function ($prof) {
                return $prof->userId->{'$id'};
                }, 'city');

                foreach ($matched_id as $key => $value) {
                array_push($user_ids,$key);
                }

            }
            else
            {

            }


            $doctors = User::find()->where(['_id' => $user_ids,"user_role"=>'1'])->with('profile')->all();

        }
        else
        {
             $currentUserId=Yii::$app->user->identity->_id;
             $session = Yii::$app->session;
             $location=Yii::$app->session['profile'][0]['city'];
             $model->location=$location;
             $matched_id=ArrayHelper::map(Profile::find()->where(['city'=>(string)$location])->all(), function ($prof) {
                return $prof->userId->{'$id'};
                }, 'city');

                foreach ($matched_id as $key => $value) {
                array_push($user_ids,$key);
                }

             $doctors = User::find()->where(['_id' => $user_ids,"user_role"=>'1'])->with('profile')->all();
        }
            
        return $this->render('searchdoc',[
            'model' => $model,'doctors'=>$doctors,
        ]);
    }

    public function actionInvite()
    {

        if(Yii::$app->request->post())
        {            
            $model = new Invite();
            if($model->invite())
            {
                Yii::$app->session->setFlash('success', 'Invitation sent successfully');
                $this->redirect('searchdoc');
            }
        }
         
    }
}
