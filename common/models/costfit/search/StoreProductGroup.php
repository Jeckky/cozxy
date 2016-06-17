<?php

namespace common\models\costfit\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\costfit\StoreProductGroup as StoreProductGroupModel;

/**
 * StoreProductGroup represents the model behind the search form about `\common\models\costfit\StoreProductGroup`.
 */
class StoreProductGroup extends StoreProductGroupModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['storeProductGroupId', 'supplierId', 'receiveBy', 'status'], 'integer'],
            [['poNo', 'title', 'description', 'receiveDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['summary'], 'number'],
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
        $query = StoreProductGroupModel::find();

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
            'storeProductGroupId' => $this->storeProductGroupId,
            'supplierId' => $this->supplierId,
            'summary' => $this->summary,
            'receiveDate' => $this->receiveDate,
            'receiveBy' => $this->receiveBy,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
        ]);

        $query->andFilterWhere(['like', 'poNo', $this->poNo])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
