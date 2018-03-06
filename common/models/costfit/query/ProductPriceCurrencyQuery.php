<?php

namespace common\models\costfit\query;

/**
 * This is the ActiveQuery class for [[\common\models\cozxy\ProductPriceCurrency]].
 *
 * @see \common\models\costfit\ProductPriceCurrency
 */
class ProductPriceCurrencyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\costfit\ProductPriceCurrency[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\costfit\ProductPriceCurrency|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
