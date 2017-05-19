<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FakeFactory extends Model
{
    public static function productForSale($n)
    {
        $products = [];
        for ($i = 1; $i <= $n; $i++) {
            $price_s = rand(30000, 40000);
            $price = rand(45000, 80000);
            $products[$i] =
                [
                    'image' => 'imgs/product0' . ($i) . '.jpg',
                    'url' => 'product?id=' . $i,
                    'brand' => 'PRADA',
                    'title' => 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG',
                    'price_s' => $price_s,
                    'price' => $price,
                ];
        }
        return $products;
    }

    public static function productStory($n)
    {
        $products = [];
        for ($i = 1; $i <= $n; $i++) {
            $price_s = rand(30000, 40000);
            $price = rand(45000, 80000);
            $products[$i] =
                [
                    'image' => 'imgs/product0' . ($i+3) . '.jpg',
                    'url' => 'product?id=' . $i,
                    'brand' => 'PRADA',
                    'title' => 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG',
                    'price_s' => $price_s,
                    'price' => $price,
                    'views' => rand(555,888),
                    'star' => rand(0.01, 5.00),
                ];
        }
        return $products;
    }
}
