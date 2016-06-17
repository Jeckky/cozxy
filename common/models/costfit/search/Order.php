<?php

namespace common\models\costfit\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\costfit\Order as OrderModel;

/**
 * Order represents the model behind the search form about `\common\models\costfit\Order`.
 */
class Order extends OrderModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'userId', 'billingCountryId', 'billingProvinceId', 'billingAmphurId', 'shippingCountryId', 'shippingProvinceId', 'shippingAmphurId', 'paymentType', 'status'], 'integer'],
            [['token', 'orderNo', 'invoiceNo', 'sendDate', 'billingCompany', 'billingTax', 'billingAddress', 'billingZipcode', 'billingTel', 'shippingCompany', 'shippingTax', 'shippingAddress', 'shippingZipcode', 'shippingTel', 'createDateTime', 'updateDateTime'], 'safe'],
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
        $query = OrderModel::find();

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
            'orderId' => $this->orderId,
            'userId' => $this->userId,
            'summary' => $this->summary,
            'sendDate' => $this->sendDate,
            'billingCountryId' => $this->billingCountryId,
            'billingProvinceId' => $this->billingProvinceId,
            'billingAmphurId' => $this->billingAmphurId,
            'shippingCountryId' => $this->shippingCountryId,
            'shippingProvinceId' => $this->shippingProvinceId,
            'shippingAmphurId' => $this->shippingAmphurId,
            'paymentType' => $this->paymentType,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
        ]);

        $query->andFilterWhere(['like', 'token', $this->token])
            ->andFilterWhere(['like', 'orderNo', $this->orderNo])
            ->andFilterWhere(['like', 'invoiceNo', $this->invoiceNo])
            ->andFilterWhere(['like', 'billingCompany', $this->billingCompany])
            ->andFilterWhere(['like', 'billingTax', $this->billingTax])
            ->andFilterWhere(['like', 'billingAddress', $this->billingAddress])
            ->andFilterWhere(['like', 'billingZipcode', $this->billingZipcode])
            ->andFilterWhere(['like', 'billingTel', $this->billingTel])
            ->andFilterWhere(['like', 'shippingCompany', $this->shippingCompany])
            ->andFilterWhere(['like', 'shippingTax', $this->shippingTax])
            ->andFilterWhere(['like', 'shippingAddress', $this->shippingAddress])
            ->andFilterWhere(['like', 'shippingZipcode', $this->shippingZipcode])
            ->andFilterWhere(['like', 'shippingTel', $this->shippingTel]);

        return $dataProvider;
    }
}
