<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for collection "referral".
 *
 * @property \MongoId|string $_id
 * @property mixed $user_id
 * @property mixed $patient_id
 * @property mixed $refer_to
 * @property mixed $status
 */
class Referral extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['medieasy', 'referral'];
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
            'refer_to',
            'status',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'patient_id', 'refer_to', 'status'], 'safe']
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
            'refer_to' => 'Refer To',
            'status' => 'Status',
        ];
    }
}
