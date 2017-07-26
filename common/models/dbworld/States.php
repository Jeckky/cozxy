<?php

namespace common\models\dbworld;

use Yii;
use \common\models\dbworld\master\StatesMaster;

/**
 * This is the model class for table "states".
 *
 * @property integer $stateId
 * @property string $stateName
 * @property string $localName
 * @property string $countryId
 * @property double $latitude
 * @property double $longitude
 */
class States extends \common\models\dbworld\master\StatesMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
}
