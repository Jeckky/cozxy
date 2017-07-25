<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Description of CurrencyRealTimeController
 *
 * @author it
 */
class CurrencyRealTimeController extends MasterController {

    //put your code here
    public function actionIndex() {

        // set API Endpoint and access key (and any options of your choice)
        $endpoint = 'live';
        $access_key = '15781139523abe280c2b49ffee4d643d'; // by pew -> '9a7b73d4d6270d6b5dc46fb65ea2f294';
        // Initialize CURL:
        $ch = curl_init('http://apilayer.net/api/' . $endpoint . '?access_key=' . $access_key . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json, true);

        // Access the exchange rate values, e.g. GBP:
        //echo $exchangeRates['quotes']['USDGBP'];
        $exchangeRates = $exchangeRates['quotes'];
        //echo '<pre>';
        //print_r($exchangeRates);
        foreach ($exchangeRates as $x => $x_value) {
            echo "Key=" . $x . ", Value=" . $x_value;
            echo "<br>";
        }
        return $this->render('index');
    }

}
