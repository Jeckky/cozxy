<?php

namespace backend\modules\content\controllers;

class LocalController extends ContentMasterController {

    public function actionIndex() {
        $cities = \common\models\dbworld\Cities::findAll('');
        $countries = \common\models\dbworld\Countries::findAll('');
        $district = \common\models\dbworld\District::findAll('');
        $geography = \common\models\dbworld\Geography::findAll('');
        $states = \common\models\dbworld\States::findAll('');
        $zipcodes = \common\models\dbworld\Zipcodes::findAll('');
        return $this->render('index', compact('cities', 'countries', 'district', 'geography', 'states', 'zipcodes ='));
    }

}
