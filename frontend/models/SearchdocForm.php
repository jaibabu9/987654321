<?php
namespace frontend\models;

use frontend\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SearchdocForm extends Model
{
    public $location;
    public $drSpecialist;

    public function rules()
    {
            return[];
        //return [['drSpecialist', 'required'],];
    }

    public function attributeLabels()
    {
        return array(
                        'location' => 'Location',
                        'drSpecialist' => 'Search doctors for',                        
                );
    }

}
