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

    public static function searchProduct($json) {
        // Convert JSON string to Array
        $someArray = json_decode($json, true);
        return $someArray;
        //print_r($someArray);        // Dump all data of the Array
        //echo $someArray[0]["name"]; // Access Array data
        // Convert JSON string to Object
        //$someObject = json_decode($someJSON);
        //print_r($someObject);      // Dump all data of the Object
        //echo $someObject[0]->name; // Access Object data
    }

}
