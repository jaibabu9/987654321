<?php
namespace frontend\controllers;

use Yii;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Profile;
use frontend\models\User;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup', 'verifyemail'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'login' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $currentUserId=(string)Yii::$app->user->identity->_id;            
            $currProfile=Profile::find()->where(['userId' => new \MongoId($currentUserId)])->asArray()->all();
            $session = Yii::$app->session;
            $session['profile']=$currProfile;

            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        //var_dump(mt_rand(100, 999)); exit;
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                //send mail
                Yii::$app->mail->compose()
                            //->setContentType("text/html")
                            ->setTo($user->email)
                            ->setFrom('ursdineshr@gmail.com')
                            ->setSubject('Verify your Email -Medieasy')
                            ->setHtmlBody('Welcome <b>'.$user->username.'</b></br>
                            <p>Please click the below link to verify your email.</p></br>
                            <a href="http://localhost/medieasy/site/verifyemail?key='.$user->auth_key.'">
                            '.Yii::$app->urlManager->createUrl('site/verifyemail?key=').$user->auth_key.'
                            </a> </br><p> Thank You,</p></br><p><b>Medieasy</b></p>'
                            )
                            ->send();
                Yii::$app->session->setFlash('success', 'You are successfully created account on Medieasy. Mail has been Sent. You must verify Your email before login.');

                return $this->redirect('login');

                // if (Yii::$app->getUser()->login($user)) {
                //     return $this->goHome();
                // }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    //Mail Verification
    public function actionVerifyemail()
    {

        $key = $_GET['key'];
        $keyexists = User::find()
                        ->where('auth_key = :auth_key', [':auth_key' => $key])
                        ->one();

        if(!empty($keyexists) && $keyexists->status == 1){
            //Yii::$app->db->createCommand("UPDATE user SET status = 1 WHERE auth_key = $key")->execute();
            Yii::$app->db->createCommand()->update('user', ['status' => 2], 'auth_key = :key')->bindValue(':key', $key)->execute();
            Yii::$app->session->setFlash('success', 'Your Email has been verified. Thank you.');
            return $this->redirect('login');
        }else if(!empty($keyexists) && $keyexists->status == 2){
            Yii::$app->session->setFlash('success', 'Your have already verified your email. Please Login.. Thank you.');
            return $this->redirect('login');
        } else {
            Yii::$app->session->setFlash('error', 'Invalid verification code. If you are unable to activate your account. Please contact us.');
            return $this->redirect('contact');
            //throw new ForbiddenHttpException(Yii::t('yii','You are not authorized to perform this action.'));
        }
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionChecklogin()
  {
 
      $params=$_POST;
      $customer = json_decode(file_get_contents("php://input"),true);
        // print_r($customer); die;

        $username=User::find()->where(['username' => $customer['username']])->one();
        if(!$username){

      $this->setHeader(200);
      echo json_encode(array('status'=>1, 'data' => 'Username does not exist'),JSON_PRETTY_PRINT);
        }
        $pass = User::find()->where(['username'=> $customer['username'], 'password' => md5($customer['password'])])->one();
        if(!$pass){
            
      $this->setHeader(200);
      echo json_encode(array('status'=>1, 'data' => 'password does not match'),JSON_PRETTY_PRINT);
        }else
        {
            Yii::$app->user->login(User::findByUsername($customer['username']), 3600 * 24 * 30 );
            $this->setHeader(200);
            echo json_encode(array('user_role'=>$username['user_role']),JSON_PRETTY_PRINT);
        }


 
        //return $this->redirect(['contact']);

 
  }


      private function setHeader($status)
      {
 
      $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
      $content_type="application/json; charset=utf-8";
 
      header($status_header);
      header('Content-type: ' . $content_type);
      header('X-Powered-By: ' . "Nintriva <nintriva.com>");
      }
    private function _getStatusCodeMessage($status)
    {
    // these could be stored in a .ini file and loaded
    // via parse_ini_file()... however, this will suffice
    // for an example
    $codes = Array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
    );
    return (isset($codes[$status])) ? $codes[$status] : '';
    }

}
