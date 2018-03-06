<?php

namespace common\models\worlddb\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\worlddb\State as StateModel;

/**
 * State represents the model behind the search form about `common\models\worlddb\State`.
 */
class State extends StateModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stateId', 'countryId'], 'integer'],
            [['name', 'nativeName'], 'safe'],
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
        $query = StateModel::find();

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
            'stateId' => $this->stateId,
            'countryId' => $this->countryId,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nativeName', $this->nativeName]);

        return $dataProvider;
    }
}
