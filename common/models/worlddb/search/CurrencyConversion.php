<?php

namespace common\models\worlddb\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\worlddb\CurrencyConversion as CurrencyConversionModel;

/**
 * CurrencyConversion represents the model behind the search form about `common\models\worlddb\CurrencyConversion`.
 */
class CurrencyConversion extends CurrencyConversionModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currencyConversionId', 'convertFrom', 'convertTo', 'createDateTime'], 'integer'],
            [['status', 'conversion'], 'safe'],
            [['factor'], 'number'],
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
        $query = CurrencyConversionModel::find();

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
            'currencyConversionId' => $this->currencyConversionId,
            'convertFrom' => $this->convertFrom,
            'convertTo' => $this->convertTo,
            'factor' => $this->factor,
            'createDateTime' => $this->createDateTime,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'conversion', $this->conversion]);

        return $dataProvider;
    }
}
