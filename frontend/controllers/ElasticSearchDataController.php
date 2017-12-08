<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use common\models\costfit\CategoryToProduct;
use common\models\costfit\ProductSuppliers;
use Yii;
use yii\base\Controller;

/**
 * Description of elasticSearchData
 *
 * @author cozxy
 */
class ElasticSearchDataController extends Controller {

    public function actionIndex() {
        $someJSON = '[{"user":"Jonathan Suh","brand":"RAY-BAN","Category": "Sunglasses" ,"title":"RAY-BAN RB3447","price":"4900" ,"market price":"7000","images":"/images/ProductImageSuppliers/thumbnail1/Nm2wauawayg1VuGH8k0gO7oVGMfOjSm9.jpg"},'
                . '{"user":"Allison McKinnery","brand":"RAY-BAN","Category": "Sunglasses" ,"title":"RAY-BAN RB2140 (RED)","price":"5005","market price":"7150","images":"/images/ProductImageSuppliers/thumbnail1/hUyCZRKRMEv_4ew-f8G9sDu4PnOz-NdZ.jpg"}]';
        return $someJSON;
    }

}
