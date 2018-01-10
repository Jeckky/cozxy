<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

use Yii;

/**
 * Description of ApiElasticSearch
 *
 * @author cozxy
 */
class ApiElasticSearch {

    //public static function searchProduct($search, $status, $brand_id, $category_id, $mins, $maxs, $size, $pages) {
    public static function searchProduct($Eparameter) {
        $search = $Eparameter['search'];
        $status = $Eparameter['status'];
        $brand_id = $Eparameter['brandId'];
        $category_id = $Eparameter['categoryId'];
        $mins = $Eparameter['mins'];
        $maxs = $Eparameter['maxs'];
        $size = $Eparameter['size'];
        $pages = $Eparameter['pages'];
        //echo $search;
        $search = str_replace(" ", "%20", $search);

        if ($mins == 100 && $maxs == 100) {
            $mins = '';
            $maxs = '';
        }

        //echo $search;
        if ($category_id == 0) {
            $category_id = '';
        }

        $url = 'http://45.76.157.59:3000/search?text=' . $search . '&brand_id=' . $brand_id . '&category_id=' . $category_id . '&price_lte=' . $mins . '&price_gte=' . $maxs . '&page=' . $pages . '&size=' . $size;
        echo $url;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "3000",
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $someResponse = json_decode($response, true);
            //echo '<pre>';
            //print_r($someArray);
            //exit();
            return $someResponse;
        }
    }

    public static function searchProductBk($search, $status, $brand_id, $category_id) {

        /* Function AddtoCart : paramenter
         * addItemToCartUnitys(productSuppId, quantity, maxQnty, fastId, productId, supplierId, receiveType)
         * javascript:addItemToCartUnitys('1228',1,'49','FALSE','1631','19','1')
         * $url = 'http://192.168.8.11/cozxy/frontend/web/elastic/product-for-sale.json';
         * $url = 'http://192.168.8.11/cozxy/frontend/web/elastic/product-not-sale.json';
         */

        if ($status == 'for-sale') {
            $json = 'product-for-sale.json';
        } elseif ($status == 'not-sale') {
            $json = 'product-not-sale.json';
        }
        //url 'http://45.76.157.59:3000/search?text=dry%20skin&brand_id=67,68&category_id=16'
        //$url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "elastic/" . $json;
        $url = "http://45.76.157.59:3000/search?text=" . $search . "&brand_id=" . $brand_id . "&category_id=" . $category_id . "";

        //echo 'url : ' . $url . '<br><br>';
        $data = "search=" . $search . "&status=" . $status . "&test=1&brand_id=" . $brand_id . '&category_id=' . $category_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $content = curl_exec($ch);
        curl_close($ch);

        // Convert JSON string to Array
        $someArray = json_decode($content, true);

        return $someArray;
        //print_r($someArray);        // Dump all data of the Array
        //echo $someArray[0]["name"]; // Access Array data
        // Convert JSON string to Object
        //$someObject = json_decode($someJSON);
        //print_r($someObject);      // Dump all data of the Object
        //echo $someObject[0]->name; // Access Object data
    }

}
