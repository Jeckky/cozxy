<?php

namespace mobile\modules\v1\controllers;

use common\models\dbworld\Cities;
use common\models\dbworld\Countries;
use common\models\costfit\ProductShelf;
use common\models\dbworld\District;
use common\models\dbworld\States;
use common\models\costfit\User;
use Yii;
use yii\db\Exception;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\Controller;
use \yii\helpers\Json;
use mobile\modules\v1\models\Wishlist;

/**
 * Default controller for the `mobile` module
 */
class WorldDbController extends Controller
{
    public function actionCountry()
    {
        $countryModels = Countries::find()->all();
        $res = [];

        $i = 0;
        foreach($countryModels as $countryModel) {
            $items[$i] = [
                'countryId'=>$countryModel->countryId,
                'countryName'=>$countryModel->countryName,
                'localName'=>$countryModel->localName,
            ];
        }

        $res['items'] = $items;
        $res['total'] = sizeof($countryModels);

        echo Json::encode($res);
    }

    public function actionProvince($countryId)
    {
        $provinceModels = States::find()->where(['countryId'=>$countryId])->orderBy('stateName')->all();
        $res = [];

        $i = 0;
        foreach($provinceModels as $provinceModel) {
            $items[$i] = [
                'provinceId'=>$provinceModel->stateId,
                'provinceName'=>trim($provinceModel->stateName),
                'localName'=>$provinceModel->localName
            ];
            $i++;
        }

        $res['items'] = $items;
        $res['total'] = sizeof($provinceModels);

        echo Json::encode($res);
    }

    public function actionAmphur($provinceId)
    {
        $amphurModels = Cities::find()->where(['stateId'=>$provinceId])->orderBy('cityName')->all();
        $res = [];

        $i = 0;
        foreach($amphurModels as $amphurModel) {
            $items[$i] = [
                'cityId'=>$amphurModel->cityId,
                'cityName'=>trim($amphurModel->cityName),
                'localName'=>$amphurModel->localName
            ];
            $i++;
        }

        $res['items'] = $items;
        $res['total'] = sizeof($amphurModels);

        echo Json::encode($res);
    }

    public function actionDistrict($amphurId)
    {
        $districtModels = District::find()->where(['cityId'=>$amphurId])->orderBy('districtName')->all();
        $res = [];

        $i = 0;
        foreach($districtModels as $districtModel) {
            $items[$i] = [
                'cityId'=>$districtModel->districtId,
                'cityName'=>trim($districtModel->districtName),
                'localName'=>$districtModel->localName
            ];
            $i++;
        }

        $res['items'] = $items;
        $res['total'] = sizeof($districtModels);

        echo Json::encode($res);
    }
}
