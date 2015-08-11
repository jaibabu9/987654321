<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for collection "invite".
 *
 * @property \MongoId|string $_id
 * @property mixed $user_id
 * @property mixed $patient_id
 * @property mixed $description
 * @property mixed $status
 * @property mixed $msg_status
 * @property mixed $created_at
 */
class Invite extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $patientname;
    public $doctorname;
    public static function collectionName()
    {
        return ['medieasy', 'invite'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'user_id',
            'patient_id',
            'description',
            'status',
            'refered_by',
            'doc_comments',
            'msg_status',
            'created_at',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'patient_id', 'description', 'status', 'msg_status', 'created_at','refered_by','doc_comments'], 'safe'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'user_id' => 'User ID',
            'patient_id' => 'Patient ID',
            'description' => 'Description',
            'status' => 'Status',
            'msg_status' => 'Msg Status',
            'created_at' => 'Created At',
            'refered_by'=>'Refered by',
            'doc_comments'=>'Comments',
        ];
    }


    public function invite()
    {

            $post = Yii::$app->request->post();
            $user = new Invite();
            $user->user_id = new \MongoId($post["recipient-id"]);
            $user->patient_id = new \MongoId(Yii::$app->user->identity->_id);
            $user->description = $post['message-text'];
            $user->created_at = date ("Y-m-d H:i:s");
            $user->status=1;
            $user->msg_status=1;            
            if ($user->save()) {
                return $user;
            }
        

       
    }

}
