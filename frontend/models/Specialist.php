<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for collection "specialist".
 *
 * @property \MongoId|string $_id
 * @property mixed $name
 */
class Specialist extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['medieasy', 'specialist'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'name',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'name' => 'Name',
        ];
    }
}
