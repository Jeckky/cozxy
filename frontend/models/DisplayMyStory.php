<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\costfit\Address;
use common\models\costfit\User;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductPost;
use common\helpers\Base64Decode;

/**
 * ContactForm is the model behind the contact form.
 */
class DisplayMyStory extends Model {

    public static function myStoryTop($hash, $status = FALSE, $type = FALSE) {

        $products = [];
        $productImagesThumbnailNull = Base64Decode::DataImageSvg120x120(FALSE, FALSE, FALSE); //'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjYwIiBoZWlnaHQ9IjI2MCIgdmlld0JveD0iMCAwIDY0IDY0IiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48IS0tDQpTb3VyY2UgVVJMOiBob2xkZXIuanMvMjYweDI2MA0KQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4NCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQ0KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28NCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWMwYTg2ZjY1YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YzBhODZmNjVhIj48cmVjdCB3aWR0aD0iMjYwIiBoZWlnaHQ9IjI2MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjYuMjI2NTYyNSIgeT0iMzYuNTMyODEyNSI+MjYweDI2MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==';
        if (isset(Yii::$app->user->id)) {
            $productPost = \common\models\costfit\ProductPost::find()->where('userId=' . Yii::$app->user->id)
            ->groupBy(['productSuppId'])->orderBy('productPostId desc')->one();
            if (count($productPost) > 0) {
                $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $productPost['productSuppId'])->one();
                $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productPost['productSuppId'])->orderBy('ordering asc')->one();

                if (isset($productImages->imageThumbnail2) && !empty($productImages->imageThumbnail2)) {
                    if (file_exists(Yii::$app->basePath . "/web/" . $productImages->imageThumbnail2)) {
                        $productImagesThumbnail2 = '/' . $productImages->imageThumbnail2;
                    } else {
                        $productImagesThumbnail2 = $productImagesThumbnailNull;
                    }
                }


                $products[$productPost['productSuppId']] = [
                    'image' => $productImagesThumbnail2,
                    'url' => Yii::$app->homeUrl . 'story/write-your-story/' . $productPostList->encodeParams(['productSuppId' => $productPostList['productSuppId'], 'productPostId' => $productPost['productPostId']]),
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => $productPost['title'],
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($productPost['productPostId'])),
                    'text' => 'Write your story'
                ];
            } else {

                $products[0] = [
                    'image' => $productImagesThumbnailNull,
                    'url' => isset(Yii::$app->user->id) ? Yii::$app->homeUrl . 'story/write-your-story/' . \common\models\ModelMaster::encodeParams(['productSuppId' => $hash]) : Yii::$app->homeUrl . 'site/login',
                    'brand' => NULL,
                    'title' => NULL,
                    'views' => NULL,
                    'text' => isset(Yii::$app->user->id) ? 'Write your story' : 'Members Only'
                ];
            }
        } else {
            $products[0] = [
                'image' => $productImagesThumbnailNull,
                'url' => isset(Yii::$app->user->id) ? Yii::$app->homeUrl . 'story/write-your-story/' . \common\models\ModelMaster::encodeParams(['productSuppId' => $hash]) : Yii::$app->homeUrl . 'site/login',
                'brand' => NULL,
                'title' => NULL,
                'views' => NULL,
                'text' => isset(Yii::$app->user->id) ? 'Write your story' : 'Members Only'
            ];
        }


        return $products;
    }

    public static function productRecentStories($productSuppId) {
        $products = [];
        $productPost = \common\models\costfit\ProductPost::find()->where('productSuppId=' . $productSuppId)->groupBy(['productSuppId'])->orderBy('productPostId desc')->all();
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
            foreach ($productPostList as $items) {
                $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $items->productSuppId)->orderBy('ordering asc')->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $items->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = number_format($productPrice->price, 2);
                $price = number_format($productPrice->price, 2);
                /* $rating_score = \common\helpers\Reviews::RatingInProduct($value->productSuppId, $value->productPostId);
                  $rating_member = \common\helpers\Reviews::RatingInMember($value->productSuppId, $value->productPostId);
                  if ($rating_score == 0 && $rating_member == 0) {
                  $results_rating = 0;
                  } else {
                  $results_rating = $rating_score / $rating_member;
                  } */
                if (isset($productImages->imageThumbnail2) && !empty($productImages->imageThumbnail2)) {
                    if (file_exists(Yii::$app->basePath . "/web/" . $productImages->imageThumbnail2)) {
                        $productImagesThumbnail2 = '/' . $productImages->imageThumbnail2;
                    } else {
                        $productImagesThumbnail2 = Base64Decode::DataImageSvg64x64(FALSE, FALSE, FALSE);
                        //'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWMwYTg2ZjY1YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YzBhODZmNjVhIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy4yMjY1NjI1IiB5PSIzNi41MzI4MTI1Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==';
                    }
                }

                $products[$value->productSuppId] = [
                    'image' => $productImagesThumbnail2,
                    //'url' => '/story?id=' . $items->productSuppId,
                    'url' => Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $items->productSuppId]),
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => $items->title,
                    'head' => $value->title,
                    'price_s' => $price_s,
                    'price' => $price,
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($value->productPostId)),
                    'star' => rand(DisplayMyStory::getResultsRating($value->productSuppId, $value->productPostId), 5.00),
                ];
            }
        }

        return $products;
    }

    public static function productViewsRecentStories($productPostId) {
        $productPost = \common\models\costfit\ProductPost::find()->where('userId=' . Yii::$app->user->id . ' and productPostId=' . $productPostId)
        ->groupBy(['productSuppId'])->orderBy('productPostId desc')->one();
        if (isset($productPost)) {
            $products['ViewsRecentStories'] = [
                'userId' => $productPost['userId'],
                'title' => $productPost['title'],
                'shortDescription' => $productPost['shortDescription'],
                'description' => $productPost['description'],
                'price' => $price,
                'views' => number_format(\common\models\costfit\ProductPost::getCountViews($value->productPostId)),
                'star' => rand($DisplayMyStory::getResultsRating($productPost['productSuppId'], $productPost['productPostId']), 5.00),
            ];
        } else {
            $products['ViewsRecentStories'] = [
                'image' => FALSE,
                'url' => FALSE,
                'userId' => FALSE,
                'title' => FALSE,
                'shortDescription' => FALSE,
                'description' => FALSE,
                'price' => FALSE,
                'views' => FALSE,
                'star' => FALSE,
            ];
        }
    }

    public static function getResultsRating($productSuppId, $productPostId) {
        $rating_score = \common\helpers\Reviews::RatingInProduct($productSuppId, $productPostId);
        $rating_member = \common\helpers\Reviews::RatingInMember($productSuppId, $productPostId);
        if ($rating_score == 0 && $rating_member == 0) {
            $results_rating = 0;
        } else {
            $results_rating = $rating_score / $rating_member;
        }
        return $results_rating;
    }

}
