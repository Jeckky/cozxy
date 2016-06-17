<?php

namespace common\models\costfit\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\costfit\StoreProductOrderItem as StoreProductOrderItemModel;

/**
 * StoreProductOrderItem represents the model behind the search form about `\common\models\costfit\StoreProductOrderItem`.
 */
class StoreProductOrderItem extends StoreProductOrderItemModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['storeProductOrderItemId', 'orderId', 'productId', 'storeProductId', 'status'], 'integer'],
            [['quantity', 'createDateTime', 'updateDateTime'], 'safe'],
            [['price', 'total'], 'number'],
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
        $query = StoreProductOrderItemModel::find();

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
            'storeProductOrderItemId' => $this->storeProductOrderItemId,
            'orderId' => $this->orderId,
            'productId' => $this->productId,
            'storeProductId' => $this->storeProductId,
            'price' => $this->price,
            'total' => $this->total,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
        ]);

        $query->andFilterWhere(['like', 'quantity', $this->quantity]);

        return $dataProvider;
    }
}
