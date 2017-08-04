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
        //$ch = curl_init('http://apilayer.net/api/' . $endpoint . '?access_key=' . $access_key . '');
        $ch = curl_init('http://apilayer.net/api/convert/?access_key=' . $access_key . '&from=USD&to=THB&amount=10');
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

    public function actionConvert() {
        $map_url = "https://www.currency-iso.org/dam/downloads/lists/list_one.xml";
        $response_xml_data = file_get_contents($map_url);
        if ($response_xml_data) {
            echo "read";
        }

        $data = simplexml_load_string($response_xml_data);

        echo "<pre>";
        //print_r($data);
        foreach ($data->CcyTbl as $value) {
            foreach ($value->CcyNtry as $key => $value1) {
                //foreach ($value->CcyNtry as $value1) {
                //echo $value1[$key] . '<br>';
                //print_r($value1);
                /*
                 * [CtryNm] => AFGHANISTAN
                  [CcyNm] => Afghani
                  [Ccy] => AFN
                  [CcyNbr] => 971
                  [CcyMnrUnts] => 2
                 */
                //  echo 'CtryNm :' . $value1->CtryNm . '<br>';
                // echo 'CcyNm :' . $value1->CcyNm . '<br>';
                //echo 'Ccy :' . $value1->Ccy . '<br>';
                // echo 'CcyNbr :' . $value1->CcyNbr . '<br>';
                //echo 'CcyMnrUnts :' . $value1->CcyMnrUnts . '<br>';
                $info = new \common\models\costfit\CurrencyInfo();

                $info->ctry_name = $value1->CtryNm;
                $info->ccy_name = $value1->CcyNm;
                $info->ccy = $value1->Ccy;
                $info->ccy_nbr = $value1->CcyNbr;
                $info->ccy_mnr_unts = $value1->CcyMnrUnts;
                $info->save(FALSE);
            }
        }
        exit;
    }

    function XML2JSON($xml) {

        function normalizeSimpleXML($obj, &$result) {
            $data = $obj;
            if (is_object($data)) {
                $data = get_object_vars($data);
            }
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $res = null;
                    normalizeSimpleXML($value, $res);
                    if (($key == '@attributes') && ($key)) {
                        $result = $res;
                    } else {
                        $result[$key] = $res;
                    }
                }
            } else {
                $result = $data;
            }
        }

        normalizeSimpleXML(simplexml_load_string($xml), $result);
        return json_encode($result);
    }

    public function actionConvertTxt() {
        $sql1 = \common\models\costfit\Countryinfox::find()->all();
        //$sql2 = \common\models\costfit\CurrencyInfo1::find()->where('title1=' . $value->ccy)->one();
        foreach ($sql1 as $key => $value) {
            \common\models\costfit\CurrencyInfo::updateAll(['currency_code' => $value->currency_code, 'currency_name' => $value->currency_name, 'currrency_symbol' => $value->currrency_symbol], ['ccy' => $value->currency_code]);
        }
    }

}
