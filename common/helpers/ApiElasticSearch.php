<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

/**
 * Description of ApiElasticSearch
 *
 * @author cozxy
 */
class ApiElasticSearch {

    public static function searchProduct($search, $status) {

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
        $url = 'http://192.168.8.11/cozxy/frontend/web/elastic/' . $json;
        echo $url;
        $data = "search=" . $search . "&status=" . $status . "&test=1";
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
