<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for collection "article".
 *
 * @property \MongoId|string $_id
 * @property mixed $user_id
 * @property mixed $title
 * @property mixed $file
 * @property mixed $share_to
 * @property mixed $status
 */
class Article extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['medieasy', 'article'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'user_id',
            'title',
            'file',
            'share_to',
            'status',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'file', 'share_to', 'status'], 'safe'],
            [['user_id'], 'string'],
            [['file'], 'file'],
            //[['email'], 'email', 'max' => 60],
            //[['name', 'username', 'password'], 'string', 'max' => 45]
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
            'title' => 'Title',
            'file' => 'File',
            'share_to' => 'Share To',
            'status' => 'Status',
        ];
    }

    public function getDisplayImage() {
        if (empty($model->image_file)) {
            // if you do not want a placeholder
            $image = null;

            // else if you want to display a placeholder
            $image = Html::img(self::IMAGE_PLACEHOLDER, [
                'alt'=>Yii::t('app', 'No avatar yet'),
                'title'=>Yii::t('app', 'Upload your avatar by selecting browse below'),
                'class'=>'file-preview-image'
                // add a CSS class to make your image styling consistent
            ]);
        }
    }

     /**
     * To get image url for gridview
     */
    public function getImageurl()
    {
        return \Yii::$app->request->BaseUrl.'/images/'.$this->file;
    }

}
