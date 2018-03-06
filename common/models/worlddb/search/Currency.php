<?php

namespace common\models\worlddb\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\worlddb\Currency as CurrencyModel;

/**
 * Currency represents the model behind the search form about `common\models\worlddb\Currency`.
 */
class Currency extends CurrencyModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currencyId', 'countryId'], 'integer'],
            [['code', 'name', 'symbol', 'nativeName'], 'safe'],
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
        $query = CurrencyModel::find();

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
            'currencyId' => $this->currencyId,
            'countryId' => $this->countryId,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'symbol', $this->symbol])
            ->andFilterWhere(['like', 'nativeName', $this->nativeName]);

        return $dataProvider;
    }
}
