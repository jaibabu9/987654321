<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for collection "profile".
 *
 * @property \MongoId|string $_id
 * @property mixed $firstName
 * @property mixed $lastName
 * @property mixed $dob
 * @property mixed $age
 * @property mixed $gender
 * @property mixed $country
 * @property mixed $state
 * @property mixed $addressLine1
 * @property mixed $addressLine2
 * @property mixed $city
 * @property mixed $zipCode
 * @property mixed $telNumber
 * @property mixed $faxNumber
 * @property mixed $mobileNumber
 * @property mixed $profilePics
 * @property mixed $drRegNo
 * @property mixed $drSpecialist
 * @property mixed $drHospital
 * @property mixed $drDesignation
 * @property mixed $workLocation
 * @property mixed $qualification
 * @property mixed $university
 * @property mixed $totExp
 * @property mixed $profileSummary
 * @property mixed $paDisease
 * @property mixed $paSubDisease
 * @property mixed $repProdName
 * @property mixed $repCompName
 * @property mixed $repTot
 * @property mixed $userId
 */
class Profile extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['medieasy', 'profile'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'firstName',
            'lastName',
            'dob',
            'age',
            'gender',
            'country',
            'state',
            'addressLine1',
            'addressLine2',
            'city',
            'zipCode',
            'telNumber',
            'faxNumber',
            'mobileNumber',
            'profilePics',
            'drRegNo',
            'drSpecialist',
            'drHospital',
            'drDesignation',
            'workLocation',
            'qualification',
            'university',
            'totExp',
            'profileSummary',
            'paDisease',
            'paSubDisease',
            'repProdName',
            'repCompName',
            'repTot',
            'userId',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'dob', 'age', 'gender', 'country', 'state', 'addressLine1', 'addressLine2', 'city', 'zipCode', 'telNumber', 'faxNumber', 'mobileNumber', 'profilePics', 'drRegNo', 'drSpecialist', 'drHospital', 'drDesignation', 'workLocation', 'qualification', 'university', 'totExp', 'profileSummary', 'paDisease', 'paSubDisease', 'repProdName', 'repCompName', 'repTot', 'userId'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'dob' => 'Dob',
            'age' => 'Age',
            'gender' => 'Gender',
            'country' => 'Country',
            'state' => 'State',
            'addressLine1' => 'Address Line1',
            'addressLine2' => 'Address Line2',
            'city' => 'City',
            'zipCode' => 'Zip Code',
            'telNumber' => 'Tel Number',
            'faxNumber' => 'Fax Number',
            'mobileNumber' => 'Mobile Number',
            'profilePics' => 'Profile Pics',
            'drRegNo' => 'Dr Reg No',
            'drSpecialist' => 'Dr Specialist',
            'drHospital' => 'Dr Hospital',
            'drDesignation' => 'Dr Designation',
            'workLocation' => 'Work Location',
            'qualification' => 'Qualification',
            'university' => 'University',
            'totExp' => 'Tot Exp',
            'profileSummary' => 'Profile Summary',
            'paDisease' => 'Pa Disease',
            'paSubDisease' => 'Pa Sub Disease',
            'repProdName' => 'Rep Prod Name',
            'repCompName' => 'Rep Comp Name',
            'repTot' => 'Rep Tot',
            'userId' => 'User ID',
        ];
    }
}
