<?php

namespace common\models\worlddb\query;

/**
 * This is the ActiveQuery class for [[\common\models\worlddb\UserInfo]].
 *
 * @see \common\models\worlddb\UserInfo
 */
class UserInfoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\worlddb\UserInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\worlddb\UserInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
