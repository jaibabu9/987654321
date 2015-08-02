<?php

namespace frontend\models;

use Yii;
use yii\web\IdentityInterface;
use yii\base\Security;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for collection "user".
 *
 * @property \MongoId|string $_id
 * @property mixed $username
 * @property mixed $email
 * @property mixed $password
 * @property mixed $user_role
 * @property mixed $status
 * @property mixed $created_at
 * @property mixed $update_at
 */
class User extends \yii\mongodb\ActiveRecord implements IdentityInterface
{

    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['medieasy', 'user'];
    }

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
            'password_reset_token',
            'auth_key',
            'user_role',
            'status',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_reset_token', 'auth_key', 'user_role', 'status', 'created_at', 'updated_at'], 'safe'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'auth_key' => 'Auth Key',
            'user_role' => 'User Role',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Update At',
        ];
    }

        /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
/* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['access_token' => $token]);
    }

/* removed
    public static function findIdentityByAccessToken($token)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
*/
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
        //return Security::validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getprofile()
    {
        return $this->hasOne(Profile::className(),['userId'=>'_id']);
    }

    public function getInvite(){
        return $this->hasMany(Invite::className(),['user_id' => '_id']);//,'patient_id' => '_id']);
    }

       public function getPatient(){
        return $this->hasMany(Invite::className(),['patient_id' => '_id']);
    }
}
