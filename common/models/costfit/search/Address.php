<?php

namespace common\models\costfit\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\costfit\Address as AddressModel;

/**
 * Address represents the model behind the search form about `\common\models\costfit\Address`.
 */
class Address extends AddressModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['addressId', 'userId', 'countryId', 'provinceId', 'amphurId', 'type', 'status'], 'integer'],
            [['company', 'tax', 'address', 'zipcode', 'tel', 'createDateTime', 'updateDateTime'], 'safe'],
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
        $query = AddressModel::find();

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
            'addressId' => $this->addressId,
            'userId' => $this->userId,
            'countryId' => $this->countryId,
            'provinceId' => $this->provinceId,
            'amphurId' => $this->amphurId,
            'type' => $this->type,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
        ]);

        $query->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'tax', $this->tax])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'tel', $this->tel]);

        return $dataProvider;
    }
}
