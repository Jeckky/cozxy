<?php

namespace common\models\costfit\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\costfit\User as UserModel;

/**
 * User represents the model behind the search form about `\common\models\costfit\User`.
 */
class User extends UserModel {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['userId', 'type', 'status'], 'integer'],
            [['username', 'hash_password', 'firstname', 'password', 'lastname', 'email', 'createDateTime', 'updateDateTime'], 'safe'],
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
        $query = UserModel::find();

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
            'userId' => $this->userId,
            'type' => $this->type,
            'status' => $this->status,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'hash_password', $this->hash_password])
                ->andFilterWhere(['like', 'firstname', $this->firstname])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'lastname', $this->lastname])
                ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

}
