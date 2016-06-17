<?php

namespace common\models\costfit\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\costfit\StoreLocation as StoreLocationModel;

/**
 * StoreLocation represents the model behind the search form about `\common\models\costfit\StoreLocation`.
 */
class StoreLocation extends StoreLocationModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['storeLocationId', 'storeId', 'provinceId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
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
        $query = StoreLocationModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'storeLocationId' => $this->storeLocationId,
            'storeId' => $this->storeId,
            'provinceId' => $this->provinceId,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
        ]);

        return $dataProvider;
    }
}
