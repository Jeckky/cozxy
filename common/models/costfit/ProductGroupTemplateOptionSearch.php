<?php

namespace common\models\costfit;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\costfit\ProductGroupTemplateOption;

/**
 * ProductGroupTemplateOptionSearch represents the model behind the search form about `common\models\costfit\ProductGroupTemplateOption`.
 */
class ProductGroupTemplateOptionSearch extends ProductGroupTemplateOption
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productGroupTemplateOptionId', 'productGroupTemplateId', 'status'], 'integer'],
            [['title', 'description', 'createDateTime', 'updateDateTime'], 'safe'],
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
        $query = ProductGroupTemplateOption::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'productGroupTemplateOptionId' => $this->productGroupTemplateOptionId,
            'productGroupTemplateId' => $this->productGroupTemplateId,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
