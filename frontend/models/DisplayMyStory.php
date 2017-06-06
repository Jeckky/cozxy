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

    public static function myStoryTop($productId, $productSupplierId, $status = FALSE, $type = FALSE) {
        $products = [];
        $productImagesThumbnailNull = Base64Decode::DataImageSvg120x120(FALSE, FALSE, FALSE); //'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjYwIiBoZWlnaHQ9IjI2MCIgdmlld0JveD0iMCAwIDY0IDY0IiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48IS0tDQpTb3VyY2UgVVJMOiBob2xkZXIuanMvMjYweDI2MA0KQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4NCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQ0KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28NCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWMwYTg2ZjY1YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YzBhODZmNjVhIj48cmVjdCB3aWR0aD0iMjYwIiBoZWlnaHQ9IjI2MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjYuMjI2NTYyNSIgeT0iMzYuNTMyODEyNSI+MjYweDI2MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==';

        if (isset(Yii::$app->user->id)) {
            $productPost = \common\models\costfit\ProductPost::find()->where('userId=' . Yii::$app->user->id . " and productId=" . $productId)
            ->groupBy(['productId'])->orderBy('productPostId desc')->one();
            if (count($productPost) > 0) {
                $productPostList = \common\models\costfit\Product::find()->where('productId =' . $productPost->productId)->one();
                $productImages = \common\models\costfit\ProductImage::find()->where('productId=' . $productPost->productId)->one();
                if (isset($productImages->imageThumbnail2) && !empty($productImages->imageThumbnail2)) {
                    if (file_exists(Yii::$app->basePath . "/web/" . $productImages->imageThumbnail2)) {
                        $productImagesThumbnail2 = '/' . $productImages->imageThumbnail2;
                    } else {
                        $productImagesThumbnail2 = $productImagesThumbnailNull;
                    }
                } else {
                    $productImagesThumbnail2 = $productImagesThumbnailNull;
                }
                $products[$productPost['productId']] = [
                    'image' => $productImagesThumbnail2,
                    'url' => Yii::$app->homeUrl . 'story/write-your-story/' . $productPostList->encodeParams(['productId' => $productPostList['productId'], 'productPostId' => $productPost['productPostId']]),
                    'urlView' => Yii::$app->homeUrl . 'story/' . $productPostList->encodeParams(['productPostId' => $productPost['productPostId'], 'productId' => $productPostList['productId'], 'productSupplierId' => $productSupplierId]),
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => $productPost['title'],
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($productPost['productPostId'])),
                    'text' => 'Write your story'
                ];
            } else {

                $products[0] = [
                    'image' => $productImagesThumbnailNull,
                    'url' => isset(Yii::$app->user->id) ? Yii::$app->homeUrl . 'story/write-your-story/' . \common\models\ModelMaster::encodeParams(['productSuppId' => $productSupplierId]) : Yii::$app->homeUrl . 'site/login',
                    'urlView' => '',
                    'brand' => NULL,
                    'title' => NULL,
                    'views' => NULL,
                    'text' => isset(Yii::$app->user->id) ? 'Write your story' : 'Members Only'
                ];
            }
            return $products;
        }
    }

    public static function productRecentStories($productId, $productSupplierId, $var1 = false) {
        $products = [];
//$allProductSuppId = ProductSuppliers::productSupplierGroupStory($productId);
//throw new \yii\base\Exception($allProductSuppId);
//$productPost = \common\models\costfit\ProductPost::find()->where('productSuppId=' . $productSuppId)->groupBy(['productSuppId'])->orderBy('productPostId desc')->all();
        $productPost = \common\models\costfit\ProductPost::find()->where("productId=" . $productId)->orderBy('productPostId desc')
        ->limit(5)//แสดงแค่ 5 รายการ
        ->all();
//throw new \yii\base\Exception(count($productPost));
        $i = 0;
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\Product::find()->where('productId =' . $value->productId)->all();
            foreach ($productPostList as $items) {
                $productImages = \common\models\costfit\ProductImage::find()->where('productId=' . $items->productId)->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $productSupplierId)->orderBy('productPriceId desc')->limit(1)->one();
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
                } else {
                    $productImagesThumbnail2 = Base64Decode::DataImageSvg64x64(FALSE, FALSE, FALSE);
                }
                $star = DisplayMyStory::calculatePostRating($value->productPostId);
                $values = explode(",", $star);
//throw new \yii\base\Exception($star);
                $products[$value->productPostId] = [
                    'image' => $productImagesThumbnail2,
                    //'url' => '/story?id=' . $items->productSuppId,
                    'url' => Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $productSupplierId]),
                    'url_seemore' => Yii::$app->homeUrl . 'story/see-more/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $productSupplierId]),
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => $items->title,
                    'head' => $value->title,
                    'price_s' => $price_s,
                    'price' => $price,
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($value->productPostId)),
                    'star' => $values[0],
                    'productPostId' => $value->productPostId,
                ];
            }
        }
// throw new \yii\base\Exception(print_r($products, true));
        return $products;
    }

    public static function productViewsRecentStories($productPostId) {
        $productPost = \common\models\costfit\ProductPost::find()->where('productPostId=' . $productPostId)
        ->groupBy(['productId'])->orderBy('productPostId desc')->one();
        $star = DisplayMyStory::calculatePostRating($productPost->productPostId);
        $values = explode(",", $star);
        if (isset($productPost)) {
            $products['ViewsRecentStories'] = [
                'userId' => $productPost['userId'],
                'title' => $productPost['title'],
                'shortDescription' => $productPost['shortDescription'],
                'description' => $productPost['description'],
                'price' => $productPost->price,
                'views' => number_format(\common\models\costfit\ProductPost::getCountViews($productPost->productPostId)),
                'star' => $values[0],
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

    public static function userStarRating($userId, $postId) {
        $productPostRating = \common\models\costfit\ProductPostRating::find()->where("userId=" . $userId . " and productPostId=" . $postId . " and status=1")->one();
        if (isset($productPostRating)) {
            $score = $productPostRating->score;
        } else {
            $score = 1;
        }
        return $score;
    }

    public static function calculatePostRating($productPostId) {//by sak
        $productPostRating = \common\models\costfit\ProductPostRating::find()->where("productPostId=" . $productPostId . " and status=1")->all();
        $star = 0;
        $user = 0;
        $score = 0;
        $value = '';
        $rate = 0;
        $decimal = 0;
        if (isset($productPostRating) && count($productPostRating) > 0) {
            foreach ($productPostRating as $rate):
                $star += $rate->score;
            endforeach;
            $user = count($productPostRating);
            $rate = number_format(($star / $user), 2);
            $score = floor($rate);
            $decimal = $star % $user;
            if ($decimal == 0) {
                $rate = $score;
            }
        }
        $value = $rate . "," . $score . "," . $decimal; //คะแนนเป็นทศนิยม  ,   จำนวนดาว(จำนวนเต็ม)  , ทศนิยม
        return $value;
    }

    public static function popularStories($productPostId) {
        /* $productPostRating = \common\models\costfit\ProductPostRating::find()
          /* ->where("productPostId=" . $productPostId)
          ->average('score'); */

//throw new \yii\base\Exception(print_r($productPostRating, true));
        $productPost = ProductPost::find()->where("productPostId=" . $productPostId)->one();
        $allProductId = ProductSuppliers::productSupplierGroupStory($productPost->productId);
        $productPosts = ProductPost::find()->where("productId in($allProductId)")->all();
        $postId = '';
        if (isset($productPosts) & count($productPosts) > 0) {
            foreach ($productPosts as $post):
                $postId .= $post->productPostId . ",";
            endforeach;
            $postId = substr($postId, 0, -1);
        }
        if ($postId != '') {
            $productPostRating = \common\models\costfit\ProductPostRating::find()->where("productPostId in($postId)")
            ->groupBy('productPostId')
            ->orderBy('avg(score) DESC')
            ->all();
        }
        if (!isset($productPostRating) || count($productPostRating) == 0) {
            $byCreate = ProductPost::find()->where("productId in($allProductId)")
            ->orderBy('createDateTime DESC')
            ->all();
            if (isset($byCreate) && count($byCreate) > 0) {
                $productPostRating = $byCreate;
            } else {
                $productPostRating = null;
            }
        }
//throw new \yii\base\Exception($productSuppId);
        /* $popular = ProductPost::find()
          ->join('LEFT JOIN', 'product_post_rating', '`product_post`.`productPostId`=`product_post_rating`.`productPostId`')
          ->where("productSuppId in($allProductSuppId)")
          ->orderBy('`product_post_rating`.`score`')
          ->limit(5)
          ->all(); */
//throw new \yii\base\Exception(count($popular));
//throw new \yii\base\Exception(count($productPostRating));
        return $productPostRating;
    }

    public static function popularStoriesNoneStar($productPostId) {
        /* $productPostRating = \common\models\costfit\ProductPostRating::find()
          /* ->where("productPostId=" . $productPostId)
          ->average('score'); */

//throw new \yii\base\Exception(print_r($productPostRating, true));
        $productPost = ProductPost::find()->where("productPostId=" . $productPostId)->one();
        $allProductId = ProductSuppliers::productSupplierGroupStory($productPost->productId);
        $productPosts = ProductPost::find()->where("productId in($allProductId)")->all();
        $postId = '';
        if (isset($productPosts) & count($productPosts) > 0) {
            foreach ($productPosts as $post):
                $postId .= $post->productPostId . ",";
            endforeach;
            $postId = substr($postId, 0, -1);
        }
        if ($postId != '') {
            $productPostRating = \common\models\costfit\ProductPostRating::find()->where("productPostId in($postId)")
            ->groupBy('productPostId')
            ->orderBy('avg(score) DESC')
            ->all();
        }
        if (!isset($productPostRating) || count($productPostRating) == 0) {
            $byCreate = ProductPost::find()->where("productId in($allProductId)")
            ->orderBy('createDateTime DESC')
            ->all();
            if (isset($byCreate) && count($byCreate) > 0) {
                $productPostRating = $byCreate;
            } else {
                $productPostRating = null;
            }
        }
//throw new \yii\base\Exception($productSuppId);
        /* $popular = ProductPost::find()
          ->join('LEFT JOIN', 'product_post_rating', '`product_post`.`productPostId`=`product_post_rating`.`productPostId`')
          ->where("productSuppId in($allProductSuppId)")
          ->orderBy('`product_post_rating`.`score`')
          ->limit(5)
          ->all(); */
//throw new \yii\base\Exception(count($popular));
//throw new \yii\base\Exception(count($productPostRating));
        return $productPostRating;
    }

    public static function postView($productPostId) {
        $view = \common\models\costfit\ProductPostView::find()->where("productPostId=" . $productPostId)->all();
        return count($view);
    }

    public static function comparePrice($productId, $currency) {
        if (isset($currency)) {
            $productPost = ProductPost::find()->where("productId=" . $productId . " and currency=" . $currency)->limit(20);
        } else {
            $productPost = ProductPost::find()->where("productId=" . $productId)->limit(20);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $productPost
        ]);
        return $dataProvider;
    }

    public static function productMyaacountStories($productId, $productSupplierId, $var1 = false) {
        $products = [];
        $productPost = \common\models\costfit\ProductPost::find()->where('userId =' . Yii::$app->user->id)
        ->all();
        $i = 0;
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\Product::find()->where('productId =' . $value->productId)->all();
            foreach ($productPostList as $items) {
                $productImages = \common\models\costfit\ProductImage::find()->where('productId=' . $items->productId)->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $productSupplierId)->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = number_format($productPrice->price, 2);
                $price = number_format($productPrice->price, 2);

                if (isset($productImages->imageThumbnail2) && !empty($productImages->imageThumbnail2)) {
                    if (file_exists(Yii::$app->basePath . "/web/" . $productImages->imageThumbnail2)) {
                        $productImagesThumbnail2 = '/' . $productImages->imageThumbnail2;
                    } else {
                        $productImagesThumbnail2 = Base64Decode::DataImageSvg64x64(FALSE, FALSE, FALSE);
                    }
                } else {
                    $productImagesThumbnail2 = Base64Decode::DataImageSvg64x64(FALSE, FALSE, FALSE);
                }
                $star = DisplayMyStory::calculatePostRating($value->productPostId);
                $values = explode(", ", $star);

                $products[$value->productPostId] = [
                    'image' => $productImagesThumbnail2,
                    //'url' => '/story?id=' . $items->productSuppId,
                    'url' => Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $productSupplierId]),
                    'url_seemore' => Yii::$app->homeUrl . 'story/see-more/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $productSupplierId]),
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => $items->title,
                    'head' => $value->title,
                    'price_s' => $price_s,
                    'price' => $price,
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($value->productPostId)),
                    'star' => $values[0],
                    'productPostId' => $value->productPostId,
                ];
            }
        }
        // throw new \yii\base\Exception(print_r($products, true));
        return $products;
    }

}
