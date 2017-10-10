<?php

namespace backend\modules\productmanager\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\productmanager\models\Product as ProductModel;

/**
 * Product represents the model behind the search form about `backend\modules\productmanager\models\Product`.
 */
class Product extends ProductModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'userId', 'parentId', 'brandId', 'categoryId', 'unit', 'smallUnit', 'status', 'productSuppId', 'approveCreateBy', 'productGroupTemplateId', 'step'], 'integer'],
            [['isbn', 'code', 'suppCode', 'merchantCode', 'title', 'optionName', 'shortDescription', 'description', 'specification', 'tags', 'createDateTime', 'updateDateTime', 'approve', 'approvecreateDateTime', 'receiveType', 'parentId'], 'safe'],
            [['width', 'height', 'depth', 'weight', 'price'], 'number'],
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
        $query = ProductModel::find();

        if(!isset($params['id']))
            $query->andWhere('parentId is null');

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
            'parentId' => $this->parentId,
            'brandId' => $this->brandId,
            'categoryId' => $this->categoryId,
            'width' => $this->width,
            'height' => $this->height,
            'depth' => $this->depth,
            'weight' => $this->weight,
            'price' => $this->price,
            'unit' => $this->unit,
            'smallUnit' => $this->smallUnit,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
            'productSuppId' => $this->productSuppId,
            'approveCreateBy' => $this->approveCreateBy,
            'approvecreateDateTime' => $this->approvecreateDateTime,
            'productGroupTemplateId' => $this->productGroupTemplateId,
            'step' => $this->step,
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
            ->andFilterWhere(['like', 'approve', $this->approve])
            ->andFilterWhere(['like', 'receiveType', $this->receiveType]);

        return $dataProvider;
    }
}
