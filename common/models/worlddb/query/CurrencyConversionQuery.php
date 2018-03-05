<?php

namespace common\models\worlddb\query;

use common\models\MasterModel;

/**
 * This is the ActiveQuery class for [[\common\models\worlddb\CurrencyConversion]].
 *
 * @see \common\models\worlddb\CurrencyConversion
 */
class CurrencyConversionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\worlddb\CurrencyConversion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\worlddb\CurrencyConversion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function whereByConversion($c)
    {
        $this->where = ['status'=>MasterModel::STATUS_ACTIVE, 'conversion'=>strtoupper('USD'.$c)];
        $this->addParams([]);
        return $this;
    }
}
