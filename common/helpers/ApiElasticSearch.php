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
        $has_supplier = $Eparameter['has_supplier'];
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

        $url = 'http://45.76.157.59:3000/search?text=' . $search . '&brand_id=' . $brand_id . '&category_id=' . $category_id . '&price_lte=' . $mins . '&price_gte=' . $maxs . '&page=' . $pages . '&size=' . $size . '&has_supplier=' . $has_supplier;
        echo $url . '<br>';
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
            //print_r($someResponse);
            //exit();
            return $someResponse;
        }
    }

    public static function paginate($item_per_page, $current_page, $total_records, $total_pages, $search, $brandName, $mins, $maxs, $category) {

        //?search=&brandName=3,51,42&mins=100&maxs=100&categoryId=&pages=18

        $pagination = '';
        if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
            $pagination .= '<ul class="pagination">';
            $right_links = $current_page + 3;
            $previous = $current_page - 3; //previous link
            $next = $current_page + 1; //next link
            $first_link = true; //boolean var to decide our first link

            if ($current_page > 1) {
                $previous_link = ($previous == 0) ? 1 : $previous;
                $pagination .= '<li class="first"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
                $pagination .= '<li><a href="#" data-records="' . $total_records . '"  data-pages="' . $total_pages . '"  data-page="' . $previous_link . '" data-search="' . $search . '" data-brandName="' . $brandName . '" data-mins="' . $mins . '" data-maxs="' . $maxs . '" data-category="' . $category . '" title="Previous">&lt;</a></li>'; //previous link
                for ($i = ($current_page - 2); $i < $current_page; $i++) { //Create left-hand side links
                    if ($i > 0) {
                        $pagination .= '<li><a href="#" data-records="' . $total_records . '"  data-pages="' . $total_pages . '"  data-page="' . $i . '"  data-search="' . $search . '" data-brandName="' . $brandName . '" data-mins="' . $mins . '" data-maxs="' . $maxs . '" data-category="' . $category . '"  title="Page' . $i . '">' . $i . '</a></li>';
                    }
                }
                $first_link = false; //set first link to false
            }

            if ($first_link) { //if current active page is first link
                $pagination .= '<li class="first active"><a href="#" data-page="1" title="First">' . $current_page . '</a></li>';
            } elseif ($current_page == $total_pages) { //if it's the last active link
                $pagination .= '<li class="last active"><a href="#" data-page=""  title="last">' . $current_page . '</a></li>';
            } else { //regular current link
                $pagination .= '<li class="active"><a href="#" data-page="" title="active">' . $current_page . '</a></li>';
            }

            for ($i = $current_page + 1; $i < $right_links; $i++) { //create right-hand side links
                if ($i <= $total_pages) {
                    $pagination .= '<li><a href="#" data-records="' . $total_records . '"  data-pages="' . $total_pages . '"  data-page="' . $i . '"  data-search="' . $search . '" data-brandName="' . $brandName . '" data-mins="' . $mins . '" data-maxs="' . $maxs . '" data-category="' . $category . '"  title="Page ' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($current_page < $total_pages) {
                $next_link = ($i > $total_pages) ? $total_pages : $i;
                $pagination .= '<li><a href="#" data-records="' . $total_records . '"  data-pages="' . $total_pages . '"  data-page="' . $next_link . '"  data-search="' . $search . '" data-brandName="' . $brandName . '" data-mins="' . $mins . '" data-maxs="' . $maxs . '" data-category="' . $category . '"  title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" data-records="' . $total_records . '"  data-pages="' . $total_pages . '"  data-page="' . $total_pages . '"  data-search="' . $search . '" data-brandName="' . $brandName . '" data-mins="' . $mins . '" data-maxs="' . $maxs . '" data-category="' . $category . '"  title="Last">&raquo;</a></li>'; //last link
            }

            $pagination .= '</ul>';
        }
        return $pagination; //return pagination links
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
