<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Referral;

/**
 * ReferralSearch represents the model behind the search form about `frontend\models\Referral`.
 */
class ReferralSearch extends Referral
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'user_id', 'patient_id', 'refer_to', 'status'], 'safe'],
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
        $query = Referral::find();

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
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'patient_id', $this->patient_id])
            ->andFilterWhere(['like', 'refer_to', $this->refer_to])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
