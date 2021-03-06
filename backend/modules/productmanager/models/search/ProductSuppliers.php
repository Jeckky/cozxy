<?php

namespace backend\modules\productmanager\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\productmanager\models\ProductSuppliers as ProductSuppliersModel;

/**
 * ProductSuppliers represents the model behind the search form about `backend\modules\productmanager\models\ProductSuppliers`.
 */
class ProductSuppliers extends ProductSuppliersModel {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['productSuppId', 'userId', 'brandId', 'categoryId', 'unit', 'smallUnit', 'status', 'quantity', 'result', 'productId', 'approveCreateBy', 'warrantyType', 'warrantyPeriod'], 'integer'],
            [['isbn', 'code', 'suppCode', 'merchantCode', 'title', 'optionName', 'shortDescription', 'description', 'specification', 'tags', 'createDateTime', 'updateDateTime', 'approve', 'approvecreateDateTime', 'receiveType', 'url'], 'safe'],
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
        $query = ProductSuppliersModel::find();

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
            'productSuppId' => $this->productSuppId,
            'userId' => $this->userId,
            'brandId' => $this->brandId,
            'categoryId' => $this->categoryId,
            'width' => $this->width,
            'height' => $this->height,
            'depth' => $this->depth,
            'weight' => $this->weight,
            'unit' => $this->unit,
            'smallUnit' => $this->smallUnit,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
            'quantity' => $this->quantity,
            'result' => $this->result,
            'productId' => $this->productId,
            'approveCreateBy' => $this->approveCreateBy,
            'approvecreateDateTime' => $this->approvecreateDateTime,
            'warrantyType' => $this->warrantyType,
            'warrantyPeriod' => $this->warrantyPeriod,
        ]);

        $query->andFilterWhere(['like', 'isbn', $this->isbn])
                ->andFilterWhere(['like', 'code', $this->code])
                ->andFilterWhere(['like', 'suppCode', $this->suppCode])
                ->andFilterWhere(['like', 'merchantCode', $this->merchantCode])
                ->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'optionName', $this->optionName])
                ->andFilterWhere(['like', 'shortDescription', $this->shortDescription])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'specification', $this->specification])
                ->andFilterWhere(['like', 'tags', $this->tags])
//            ->andFilterWhere(['like', 'approve', $this->approve])
                ->andFilterWhere(['like', 'approve', 'approve'])
                ->andFilterWhere(['like', 'receiveType', $this->receiveType])
                ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }

    public static function searchByParentId($parentId, $textUserPartner, $textUserCountents) {


        //echo Yii::$app->user->identity->userId;
        if (Yii::$app->user->identity->userId == 19) {
            //$userId = $textUserPartner + $textUserCountents;
            $userId = $textUserCountents;
            //print_r($userId);
            $whereArray["product_suppliers.userId"] = $userId;
            $query = ProductSuppliers::find()
                    ->leftJoin('product p', 'product_suppliers.productId=p.productId')
                    ->where(['p.parentId' => $parentId, 'product_suppliers.status' => 1, 'product_suppliers.approve' => 'approve'])
                    ->andWhere($whereArray)
                    ->andWhere('product_suppliers.userId=' . Yii::$app->user->identity->userId);
        } else {
            $query = ProductSuppliers::find()
                    ->leftJoin('product p', 'product_suppliers.productId=p.productId')
                    ->where(['p.parentId' => $parentId, 'product_suppliers.status' => 1, 'product_suppliers.approve' => 'approve'])
                    ->andWhere('product_suppliers.userId=' . Yii::$app->user->identity->userId);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

}
