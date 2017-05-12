<?php

namespace common\models\costfit\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\costfit\Product as ProductModel;

/**
 * Product represents the model behind the search form about `\common\models\costfit\Product`.
 */
class Product extends ProductModel {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['productId', 'userId', 'productGroupId', 'brandId', 'categoryId', 'status'], 'integer'],
                [['code', 'title', 'description', 'createDateTime', 'updateDateTime'], 'safe'],
                [['width', 'height', 'depth', 'weight'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = ProductModel::find();

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
            'productId' => $this->productId,
            'userId' => $this->userId,
            'productGroupId' => $this->productGroupId,
            'brandId'=>$this->brandId,
            'categoryId' => $this->categoryId,
            'width' => $this->width,
            'height' => $this->height,
            'depth' => $this->depth,
            'weight' => $this->weight,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
                ->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

    public static function bestSellers() {
        return \common\models\costfit\search\Product::find()->where("RAND()")->limit(6)->all();
        //return \common\models\costfit\ProductSuppliers::find()->where("RAND()")->limit(6)->all();
    }

    public static function itemOnSales() {
        return \common\models\costfit\search\Product::find()->where("RAND()")->limit(6)->all();
    }

    public static function hotProducts() {
        return \common\models\costfit\search\Product::find()->where("RAND()")->all();
    }

}
