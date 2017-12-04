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
        $url = 'http://localhost/cozxy/frontend/web/elastic-search-data';
        $data = "search=APRIL&status=1&test=1";
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
