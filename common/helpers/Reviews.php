<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\costfit\ProductPost;
use common\models\costfit\ProductPostRating;

/**
 * Description of Reviews
 *
 * @author it
 */
class Reviews {

//put your code here
    public static function RatingInProduct($productId, $productPostId) {
        $rating_score = 0;
        $productPos = ProductPost::find()->where("productId=" . $productId . ' and productPostId =' . $productPostId)->all();
        if (isset($productPos) && count($productPos) > 0) {
            $id = '';
            foreach ($productPos as $pos):
                $id .= $pos->productPostId . ',';
//  $rate = common\models\costfit\ProductPostRating::find()->where()->all();
            endforeach;
//throw new \yii\base\Exception($id);
            $id = substr($id, 0, -1);
        }else {
            $id = '';
        }
        if ($id != '') {
            $rating = \common\models\costfit\ProductPostRating::find()->where('productPostId in(' . $id . ') and status=1')
                    ->all();
            $rating_score = 0;
            foreach ($rating as $rate):
                $rating_score += $rate->score;
            endforeach;
        }else {
            $rating_score = NULL;
        }

        return $rating_score;
    }

    public static function RatingInMember($productId, $productPostId) {
        $rating_score = 0;
        $productPos = ProductPost::find()->where("productId=" . $productId . ' and productPostId =' . $productPostId)->all();
        if (isset($productPos) && count($productPos) > 0) {
            $id = '';
            foreach ($productPos as $pos):
                $id .= $pos->productPostId . ',';
//  $rate = common\models\costfit\ProductPostRating::find()->where()->all();
            endforeach;
//throw new \yii\base\Exception($id);
            $id = substr($id, 0, -1);
        }else {
            $id = '';
        }

        if ($id != '') {
            $rating = \common\models\costfit\ProductPostRating::find()->where('productPostId in(' . $id . ') and status=1')
                    ->count('userId');
        } else {
            $rating = NULL;
        }
        return $rating;
    }

}
