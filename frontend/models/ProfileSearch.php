<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Profile;

/**
 * ProfileSearch represents the model behind the search form about `frontend\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'firstName', 'lastName', 'dob', 'age', 'gender', 'country', 'state', 'addressLine1', 'addressLine2', 'city', 'zipCode', 'telNumber', 'faxNumber', 'mobileNumber', 'profilePics', 'drRegNo', 'drSpecialist', 'drHospital', 'drDesignation', 'workLocation', 'qualification', 'university', 'totExp', 'profileSummary', 'paDisease', 'paSubDisease', 'repProdName', 'repCompName', 'repTot', 'userId'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Profile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'dob', $this->dob])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'addressLine1', $this->addressLine1])
            ->andFilterWhere(['like', 'addressLine2', $this->addressLine2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zipCode', $this->zipCode])
            ->andFilterWhere(['like', 'telNumber', $this->telNumber])
            ->andFilterWhere(['like', 'faxNumber', $this->faxNumber])
            ->andFilterWhere(['like', 'mobileNumber', $this->mobileNumber])
            ->andFilterWhere(['like', 'profilePics', $this->profilePics])
            ->andFilterWhere(['like', 'drRegNo', $this->drRegNo])
            ->andFilterWhere(['like', 'drSpecialist', $this->drSpecialist])
            ->andFilterWhere(['like', 'drHospital', $this->drHospital])
            ->andFilterWhere(['like', 'drDesignation', $this->drDesignation])
            ->andFilterWhere(['like', 'workLocation', $this->workLocation])
            ->andFilterWhere(['like', 'qualification', $this->qualification])
            ->andFilterWhere(['like', 'university', $this->university])
            ->andFilterWhere(['like', 'totExp', $this->totExp])
            ->andFilterWhere(['like', 'profileSummary', $this->profileSummary])
            ->andFilterWhere(['like', 'paDisease', $this->paDisease])
            ->andFilterWhere(['like', 'paSubDisease', $this->paSubDisease])
            ->andFilterWhere(['like', 'repProdName', $this->repProdName])
            ->andFilterWhere(['like', 'repCompName', $this->repCompName])
            ->andFilterWhere(['like', 'repTot', $this->repTot])
            ->andFilterWhere(['like', 'userId', $this->userId]);

        return $dataProvider;
    }
}
