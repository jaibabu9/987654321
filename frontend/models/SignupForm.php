<?php
namespace frontend\models;

use frontend\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $user_role;
    public $created_at;
    public $updated_at;
    public $auth_key;


    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'username',
            'email',
            'password',
            'auth_key',
            'status',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['user_role', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->user_role = $this->user_role;
            $user->created_at = date ("Y-m-d H:i:s");
            $user->updated_at = date ("Y-m-d H:i:s");
            $user->setPassword($this->password);
            //$user->generateAuthKey();
            $user->auth_key = Yii::$app->getSecurity()->generateRandomString(20);
            //$user->auth_key = mb_convert_encoding($user->generateAuthKey(), 'ISO-8859-1', 'UTF-8');
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
