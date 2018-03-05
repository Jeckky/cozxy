<?php

namespace common\models\worlddb\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\worlddb\Country as CountryModel;

/**
 * Country represents the model behind the search form about `common\models\worlddb\Country`.
 */
class Country extends CountryModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryId'], 'integer'],
            [['status', 'name', 'alpha2Code', 'alpha3Code', 'demonym', 'nativeName', 'flag', 'cioc'], 'safe'],
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
        $query = CountryModel::find();

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
            'countryId' => $this->countryId,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alpha2Code', $this->alpha2Code])
            ->andFilterWhere(['like', 'alpha3Code', $this->alpha3Code])
            ->andFilterWhere(['like', 'demonym', $this->demonym])
            ->andFilterWhere(['like', 'nativeName', $this->nativeName])
            ->andFilterWhere(['like', 'flag', $this->flag])
            ->andFilterWhere(['like', 'cioc', $this->cioc]);

        return $dataProvider;
    }
}
