<?php

namespace common\models\worlddb\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\worlddb\Language as LanguageModel;

/**
 * Language represents the model behind the search form about `common\models\worlddb\Language`.
 */
class Language extends LanguageModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['languageId', 'createDateTime', 'updateDateTime', 'countryId'], 'integer'],
            [['iso639_1', 'iso639_2', 'name', 'nativeName'], 'safe'],
            [['searchText'], 'safe']
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
        $query = LanguageModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'languageId' => $this->languageId,
            'createDateTime' => $this->createDateTime,
            'updateDateTime' => $this->updateDateTime,
            'countryId' => $this->countryId,
        ]);

        $query->andFilterWhere(['like', 'iso639_1', $this->iso639_1])
            ->andFilterWhere(['like', 'iso639_2', $this->iso639_2])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nativeName', $this->nativeName]);

        return $dataProvider;
    }
}
