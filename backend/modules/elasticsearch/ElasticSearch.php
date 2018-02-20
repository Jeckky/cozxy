<?php

namespace backend\modules\elasticsearch;

/**
 * elastic-search module definition class
 */
class ElasticSearch extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\elasticsearch\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
