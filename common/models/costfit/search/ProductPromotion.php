<?php

namespace common\models\costfit\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\costfit\ProductPromotion as ProductPromotionModel;

/**
 * ProductPromotion represents the model behind the search form about `\common\models\costfit\ProductPromotion`.
 */
class ProductPromotion extends ProductPromotionModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productPromotionId', 'productId', 'discountType', 'status'], 'integer'],
            [['statusDate', 'endDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['discount'], 'number'],
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
        $query = ProductPromotionModel::find();

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
            'productPromotionId' => $this->productPromotionId,
            'productId' => $this->productId,
            'statusDate' => $this->statusDate,
            'endDate' => $this->endDate,
            'discount' => $this->discount,
            'discountType' => $this->discountType,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
        ]);

        return $dataProvider;
    }
}
