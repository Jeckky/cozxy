<?php

namespace common\models\worlddb\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\worlddb\CountryTranslation as CountryTranslationModel;

/**
 * CountryTranslation represents the model behind the search form about `common\models\worlddb\CountryTranslation`.
 */
class CountryTranslation extends CountryTranslationModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryTranslationId', 'countryId'], 'integer'],
            [['status', 'code', 'name'], 'safe'],
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
        $query = CountryTranslationModel::find();

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
            'countryTranslationId' => $this->countryTranslationId,
            'countryId' => $this->countryId,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
