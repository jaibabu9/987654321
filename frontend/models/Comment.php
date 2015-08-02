<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for collection "comment".
 *
 * @property \MongoId|string $_id
 * @property mixed $user_id
 * @property mixed $post_id
 * @property mixed $comment
 * @property mixed $status
 * @property mixed $created_at
 */
class Comment extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['medieasy', 'comment'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'user_id',
            'post_id',
            'comment',
            'status',
            'created_at',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id', 'comment', 'status', 'created_at'], 'safe']
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
            'post_id' => 'Post ID',
            'comment' => 'Comment',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
