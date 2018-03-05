<?php

namespace common\models\worlddb\query;

/**
 * This is the ActiveQuery class for [[\common\models\worlddb\District]].
 *
 * @see \common\models\worlddb\District
 */
class DistrictQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\worlddb\District[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\worlddb\District|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
