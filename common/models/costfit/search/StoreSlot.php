<?php

namespace common\models\costfit\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\costfit\StoreSlot as StoreSlotModel;

/**
 * StoreSlot represents the model behind the search form about `\common\models\costfit\StoreSlot`.
 */
class StoreSlot extends StoreSlotModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['storeSlotId', 'storeId', 'status'], 'integer'],
            [['code', 'title', 'description', 'createDateTime', 'updateDateTime'], 'safe'],
            [['width', 'height', 'depth', 'weight', 'maxWeight'], 'number'],
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
        $query = StoreSlotModel::find();

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
            'storeSlotId' => $this->storeSlotId,
            'storeId' => $this->storeId,
            'width' => $this->width,
            'height' => $this->height,
            'depth' => $this->depth,
            'weight' => $this->weight,
            'maxWeight' => $this->maxWeight,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
