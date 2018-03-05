<?php

namespace common\models\worlddb\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\worlddb\Zipcode as ZipcodeModel;

/**
 * Zipcode represents the model behind the search form about `common\models\worlddb\Zipcode`.
 */
class Zipcode extends ZipcodeModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zipcodeId', 'districtId', 'cityId', 'stateId', 'countryId'], 'integer'],
            [['zipcode'], 'safe'],
            [['searchText'], 'safe']
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
        $query = ZipcodeModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'zipcodeId' => $this->zipcodeId,
            'districtId' => $this->districtId,
            'cityId' => $this->cityId,
            'stateId' => $this->stateId,
            'countryId' => $this->countryId,
        ]);

        $query->andFilterWhere(['like', 'zipcode', $this->zipcode]);

        return $dataProvider;
    }
}
