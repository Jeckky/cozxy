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
            $productPost = \common\models\costfit\ProductPost::find()->where('userId=' . Yii::$app->user->id . " and productId=" . $productId . ' and product_post.status =1')
                            ->groupBy(['productId'])->orderBy('productPostId desc')->one();

            if (count($productPost) > 0) {
                $productPostList = \common\models\costfit\Product::find()->where('productId =' . $productPost->productId)->one();
                //$productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSupplierId)->one();
                /*
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
                 */
                $productImagesThumbnail2 = \common\helpers\DataImageSystems::DataImageMaster($productId, FALSE, 'Svg120x120');

                $products['myStoryTop'] = [
                    'productPostId' => $productPost['productPostId'],
                    'image' => $productImagesThumbnail2,
                    'url' => Yii::$app->homeUrl . 'story/write-your-story/' . $productPostList->encodeParams(['productId' => $productPostList['productId'], 'productPostId' => $productPost['productPostId']]),
                    'urlView' => Yii::$app->homeUrl . 'story/' . $productPostList->encodeParams(['productPostId' => $productPost['productPostId'], 'productId' => $productPostList['productId'], 'productSupplierId' => $productSupplierId]),
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => $productPost['title'],
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($productPost['productPostId'])),
                    'text' => 'WRITE YOUR STORY'
                ];
            } else {
                $products['myStoryTop'] = [
                    'productPostId' => NULL,
                    'image' => $productImagesThumbnailNull,
                    'url' => isset(Yii::$app->user->id) ? Yii::$app->homeUrl . 'story/write-your-story/' . \common\models\ModelMaster::encodeParams(['productId' => $productId]) : Yii::$app->homeUrl . 'site/login',
                    'urlView' => '',
                    'brand' => NULL,
                    'title' => NULL,
                    'views' => NULL,
                    'text' => isset(Yii::$app->user->id) ? 'WRITE YOUR STORY' : 'Log in to write'
                ];
            }
        } else {
            //throw new \yii\base\Exception('11111');
            $products['myStoryTop'] = [
                'productPostId' => NULL,
                'image' => $productImagesThumbnailNull,
                'url' => isset(Yii::$app->user->id) ? Yii::$app->homeUrl . 'story/write-your-story/' . \common\models\ModelMaster::encodeParams(['productId' => $productId]) : Yii::$app->homeUrl . 'site/login',
                'urlView' => '',
                'brand' => NULL,
                'title' => NULL,
                'views' => NULL,
                'text' => isset(Yii::$app->user->id) ? 'WRITE YOUR STORY' : 'Log in to write'
            ];
        }
        return $products;
    }

    public static function productRecentStories($productId, $productSupplierId, $var1 = false) {

        $products = [];
        if (isset($var1) && !empty($var1)) {

            $productPost = \common\models\costfit\ProductPost::find()->where("productId=" . $productId . ' and productPostId !=' . $var1 . ' and product_post.status =1')->orderBy('productPostId desc') //แสดงแค่ 5 รายการ
                    ->all();
        } else {
            $productPost = \common\models\costfit\ProductPost::find()->where("productId=" . $productId . ' and product_post.status =1')->orderBy('productPostId desc') //แสดงแค่ 5 รายการ
                    ->all();
        }

        $i = 0;
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\Product::find()->where('productId =' . $value->productId)->all();
            foreach ($productPostList as $items) {
                //$productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSupplierId)->one();
                //$productImages = \common\models\costfit\ProductImage::find()->where('productId=' . $value->productId)->one();
                $productImagesThumbnail2 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $productSupplierId, 'Svg64x64');
                if (isset($productSupplierId)) {
                    $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $productSupplierId)->orderBy('productPriceId desc')->limit(1)->one();
                    $price_s = number_format($productPrice->price);
                    $price = number_format($productPrice->price);
                } else {
                    $price_s = '';
                    $price = '';
                }


                /* $rating_score = \common\helpers\Reviews::RatingInProduct($value->productSuppId, $value->productPostId);
                  $rating_member = \common\helpers\Reviews::RatingInMember($value->productSuppId, $value->productPostId);
                  if ($rating_score == 0 && $rating_member == 0) {
                  $results_rating = 0;
                  } else {
                  $results_rating = $rating_score / $rating_member;
                  } */

                /* (if (isset($productImages->imageThumbnail2) && !empty($productImages->imageThumbnail2)) {
                  if (file_exists(Yii::$app->basePath . "/web/" . $productImages->imageThumbnail2)) {
                  $productImagesThumbnail2 = '/' . $productImages->imageThumbnail2;
                  } else {
                  $productImagesThumbnail2 = Base64Decode::DataImageSvg64x64(FALSE, FALSE, FALSE);
                  }
                  } else {
                  $productImagesThumbnail2 = Base64Decode::DataImageSvg64x64(FALSE, FALSE, FALSE);
                  } */

                $star = DisplayMyStory::calculatePostRating($value->productPostId);
                $values = explode(",", $star);

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
                        ->groupBy(['productId'])
                        ->orderBy('productPostId desc')->one();
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

        return $products;
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
            $score = 0;
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
        $productPosts = ProductPost::find()->where("productId in($allProductId)")
                ->limit(6)
                ->orderBy("totalScore DESC")
                ->all();
        $postId = '';
        return $productPosts;
        /* if (isset($productPosts) & count($productPosts) > 0) {
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
          } */

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

        $productPost = ProductPost::find()->where("productPostId=" . $productPostId)->one();
        $allProductId = ProductSuppliers::productSupplierGroupStory($productPost->productId);
        $productPosts = ProductPost::find()->where("productId in($allProductId)")->all();
        $postId = '';
        $have = '';
        $notHave = '';
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
            if (isset($productPostRating) && count($productPostRating) > 0) {
                foreach ($productPostRating as $rating):
                    $have .= $rating->productPostId . ",";
                endforeach;
                $have = substr($have, 0, -1);
            }
        }
        if ($have != '') {
            $byCreate = ProductPost::find()->where("productPostId in($postId) and productPostId not in($have) and productId in($allProductId)")
                    ->orderBy('createDateTime DESC')
                    ->all();
        }
        if (isset($byCreate) && count($byCreate) > 0) {
            $productPostRating = $byCreate;
        } else {
            $productPostRating = null;
        }
        return $productPostRating;
    }

    public static function postView($productPostId) {
        $view = \common\models\costfit\ProductPostView::find()->where("productPostId=" . $productPostId)->all();
        return count($view);
    }

    public static function comparePrice($productPostId, $currency, $sort) {
        $products = [];
        $sortStr = "product_post_compare_price.price ";
        if ($sort == 'SORT_ASC') {
            $sortStr .= 'asc';
        } else {
            $sortStr .= 'desc';
        }
        if (isset($currency)) {
            $productPost = \common\models\costfit\ProductPostComparePrice::find()
                    ->select('`product_post_compare_price`.* ,`currency_info`.currency_code,`currency_info`.ccy_name ,`currency_info`.images ')
                    ->join("LEFT JOIN", "currency_info", "currency_info.currencyId = product_post_compare_price.currency")
                    ->where("product_post_compare_price.productPostId=" . $productPostId . " and product_post_compare_price.currency=" . $currency)
                    ->orderBy($sortStr)
                    ->all();
            foreach ($productPost as $value) {
                if (isset($value->images)) {
                    $urlImages = \Yii::$app->urlManager->baseUrl . '/images/flags/flags/compare-price/16x10/' . $value->images;
                } else {
                    $urlImages = '';
                }
                $products[$value->comparePriceId] = [
                    'comparePriceId' => $value->comparePriceId,
                    'userId' => $value->userId,
                    'productPostId' => $value->productPostId,
                    'country' => $value->country,
                    'place' => $value->shopName,
                    'price' => number_format($value->price),
                    'LocalPrice' => "THB " . number_format(\common\models\costfit\Currency::ToThb($value->currency, $value->price), 2),
                    'latitude' => $value->latitude, 'longitude' => $value->longitude,
                    'currency_code' => $value->currency_code,
                    'ccy_name' => $value->ccy_name,
                    'images' => $urlImages
                ];
            }
        } else {
            $productPost = \common\models\costfit\ProductPostComparePrice::find()
                    ->select('`product_post_compare_price`.* ,`currency_info`.currency_code,`currency_info`.ccy_name,`currency_info`.images ')
                    ->join("LEFT JOIN", "currency_info", "currency_info.currencyId = product_post_compare_price.currency")
                    ->where("product_post_compare_price.productPostId=" . $productPostId)
                    ->orderBy($sortStr)
                    ->all();
            foreach ($productPost as $value) {
                if ($value->currency != '') {
                    $currency = number_format(\common\models\costfit\Currency::ToThb($value->currency, $value->price), 2);
                } else {
                    $currency = '';
                }
                if (isset($value->images)) {
                    $urlImages = \Yii::$app->urlManager->baseUrl . '/images/flags/flags/compare-price/16x10/' . $value->images;
                } else {
                    $urlImages = '';
                }
                $products[$value->comparePriceId] = [
                    'comparePriceId' => $value->comparePriceId,
                    'userId' => $value->userId,
                    'productPostId' => $value->productPostId,
                    'country' => $value->country,
                    'place' => $value->shopName,
                    'price' => number_format($value->price),
                    'LocalPrice' => "THB " . $currency,
                    'latitude' => $value->price, 'longitude' => $value->longitude,
                    'currency_code' => $value->currency_code,
                    'ccy_name' => $value->ccy_name,
                    'images' => $urlImages
                ];
            }
        }


        return $products;
    }

    public static function productMyaacountStories($productId, $productSupplierId, $var1 = false) {
        $products = [];
        $productPost = \common\models\costfit\ProductPost::find()->where('userId =' . Yii::$app->user->id . ' and status = 1')->all();
        $i = 0;
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productId =' . $value->productId)->all();
            foreach ($productPostList as $items) {
                //$productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $items['productSuppId'])->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $items['productSuppId'] . ' and status=1')->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = isset($productPrice->price) ? number_format($productPrice->price) : '';
                $price = isset($productPrice->price) ? number_format($productPrice->price) : '';

                /* if (isset($productImages->imageThumbnail2) && !empty($productImages->imageThumbnail2)) {
                  if (file_exists(Yii::$app->basePath . "/web/" . $productImages->imageThumbnail2)) {
                  $productImagesThumbnail2 = '/' . $productImages->imageThumbnail1;
                  } else {
                  $productImagesThumbnail2 = Base64Decode::DataImageSvg260x260(FALSE, FALSE, FALSE);
                  }
                  } else {
                  $productImagesThumbnail2 = Base64Decode::DataImageSvg260x260(FALSE, FALSE, FALSE);
                  } */
                $productImagesThumbnail2 = \common\helpers\DataImageSystems::DataImageMaster($items['productId'], $items['productSuppId'], 'Svg260x260');
                //$star = DisplayMyStory::calculatePostRating($value->productPostId);
                // $values = explode(", ", $star);
                $rating_score = \common\helpers\Reviews::RatingInProduct($value->productId, $value->productPostId);
                $rating_member = \common\helpers\Reviews::RatingInMember($value->productId, $value->productPostId);
                if ($rating_score == 0 && $rating_member == 0) {
                    $results_rating = 0;
                } else {
                    $results_rating = $rating_score / $rating_member;
                }
                $products[$value->productPostId] = [
                    'productPostId' => $value->productPostId,
                    'image' => $productImagesThumbnail2,
                    'urlProduct' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $items->productId, 'productSupplierId' => $items->productSuppId]),
                    'url' => Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $items['productSuppId']]),
                    'url_seemore' => Yii::$app->homeUrl . 'story/see-more/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $productSupplierId]),
                    'urlEditStory' => Yii::$app->homeUrl . 'story/update-stories/' . $value->encodeParams(['productId' => $items->productId, 'productPostId' => $value->productPostId, 'productSuppId' => $items['productSuppId']]),
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => isset($items->title) ? substr($items->title, 0, 35) : '',
                    'head' => isset($value->title) ? substr($value->title, 0, 45) : '',
                    'price_s' => $price_s,
                    'price' => $price,
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($value->productPostId)),
                    //'star' => $values[0],
                    'star' => number_format($results_rating),
                    'avatar' => \common\models\costfit\User::getAvatar(Yii::$app->user->id),
                    'productPostId' => $value->productPostId,
                ];
            }
        }
// throw new \yii\base\Exception(print_r($products, true));
        return $products;
    }

    public static function favoriteStories($limit) {
        $products = [];
        if ($limit == 0) {
            $allFavorite = \common\models\costfit\FavoriteStory::find()->where('userId =' . Yii::$app->user->id . " and status=1")
                    ->orderBy('updateDateTime DESC')
                    ->all();
        } else {
            $allFavorite = \common\models\costfit\FavoriteStory::find()->where('userId =' . Yii::$app->user->id . " and status=1")
                    ->limit($limit)
                    ->orderBy('updateDateTime DESC')
                    ->all();
        }
        $postId = '';
        if (isset($allFavorite) && count($allFavorite) > 0) {
            foreach ($allFavorite as $favorite):
                $postId .= $favorite->productPostId . ',';
            endforeach;
            if ($postId != '') {
                $postId = substr($postId, 0, -1);
            }

            $productPost = \common\models\costfit\ProductPost::find()->where("productPostId in ($postId)")->all();
            $i = 0;
            foreach ($productPost as $value):
                $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productId =' . $value->productId)->all();
                foreach ($productPostList as $items):
                    //$productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $items['productSuppId'])->one();
                    $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $items['productSuppId'] . ' and status=1')->orderBy('productPriceId desc')->limit(1)->one();
                    $price_s = isset($productPrice->price) ? number_format($productPrice->price) : '';
                    $price = isset($productPrice->price) ? number_format($productPrice->price) : '';
                    $productImagesThumbnail2 = \common\helpers\DataImageSystems::DataImageMaster($items['productId'], $items['productSuppId'], 'Svg260x260');

                    $rating_score = \common\helpers\Reviews::RatingInProduct($value->productId, $value->productPostId);
                    $rating_member = \common\helpers\Reviews::RatingInMember($value->productId, $value->productPostId);
                    if ($rating_score == 0 && $rating_member == 0) {
                        $results_rating = 0;
                    } else {
                        $results_rating = $rating_score / $rating_member;
                    }
                    $products[$value->productPostId] = [
                        'productPostId' => $value->productPostId,
                        'image' => $productImagesThumbnail2,
                        'urlProduct' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $items->productId, 'productSupplierId' => $items->productSuppId]),
                        'url' => Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $items['productSuppId']]),
                        //'url_seemore' => Yii::$app->homeUrl . 'story/see-more/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $productSupplierId]),
                        'urlEditStory' => Yii::$app->homeUrl . 'story/update-stories/' . $value->encodeParams(['productId' => $items->productId, 'productPostId' => $value->productPostId, 'productSuppId' => $items['productSuppId']]),
                        'brand' => isset($items->brand) ? $items->brand->title : '',
                        'title' => isset($items->title) ? substr($items->title, 0, 35) : '',
                        'head' => isset($value->title) ? substr($value->title, 0, 45) : '',
                        'price_s' => $price_s,
                        'price' => $price,
                        'views' => number_format(\common\models\costfit\ProductPost::getCountViews($value->productPostId)),
                        'star' => number_format($results_rating),
                        'productPostId' => $value->productPostId,
                        'avatar' => \common\models\costfit\User::getAvatar($value->userId),
                    ];
                endforeach;
            endforeach;
        }
        return $products;
    }

    public static function productEditRecentStories($productPostId) {
        $productPost = \common\models\costfit\ProductPost::find()->where('productPostId=' . $productPostId)
                        ->groupBy(['productId'])->orderBy('productPostId desc')->one();

        $star = DisplayMyStory::calculatePostRating($productPost->productPostId);
        $values = explode(",", $star);
        if (isset($productPost)) {
            $productContent = \common\models\costfit\ProductSuppliers::find()->where('productId=' . $productPost['productId'])->one();
            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($productPost['productId'], 0, 'Svg260x260');
            $products['ViewsRecentStories'] = [
                'userId' => $productPost['userId'],
                'title' => $productPost['title'],
                'shortDescription' => $productPost['shortDescription'],
                'description' => $productPost['description'],
                'price' => $productPost->price,
                'views' => number_format(\common\models\costfit\ProductPost::getCountViews($productPost->productPostId)),
                'star' => $values[0],
                'titleProduct' => $productContent->title,
                'image' => $productImagesThumbnail1,
            ];
        } else {
            $products['ViewsRecentStories'] = [
                'userId' => FALSE,
                'title' => FALSE,
                'shortDescription' => FALSE,
                'description' => FALSE,
                'price' => FALSE,
                'views' => FALSE,
                'star' => FALSE,
                'titleProduct' => FALSE,
                'image' => FALSE,
            ];
        }

        return $products;
    }

    public static function productMyacountStoriesSort($userId, $status, $sort, $isType) {
        $products = [];
        $whereArray = [];
        $sortStr = ($status == "new") ? "createDateTime " : (($status == "price") ? "price " : (($status == "stars") ? "sum(product_post_rating.score)" : (($status == "view") ? "count(product_post_view.productPostViewId) " : "count(product_post_view.productPostViewId) ")));
        if ($sort == 'SORT_ASC') {
            $sortStr .= ' asc';
        } else {
            $sortStr .= ' desc';
        }

        $whereArray["product_post.isPublic"] = 1;
        if ($userId != '') {
            $whereArray["product_post.userId"] = Yii::$app->user->id;
        }

        if ($status == 'price') {
            $productPost = \common\models\costfit\ProductPost::find()
                    ->where($whereArray)
                    ->andWhere('product_post.status =1')
                    ->orderBy($sortStr)
                    ->all();
        } elseif ($status == 'new') {
            $productPost = \common\models\costfit\ProductPost::find()
                    ->where($whereArray)
                    ->andWhere('product_post.status =1')
                    ->orderBy($sortStr)
                    ->all();
        } elseif ($status == 'view') {
            $productPost = \common\models\costfit\ProductPost::find()
                    ->select('count(product_post_view.productPostViewId) as viewNew  ,product_post.*')
                    ->join("LEFT JOIN", "product_post_view", "product_post_view.productPostId = product_post.productPostId")
                    ->where('product_post.userId =' . Yii::$app->user->id)
                    ->where($whereArray)
                    ->andWhere('product_post.status =1')
                    ->groupBy('product_post.productPostId')
                    ->orderBy($sortStr)
                    ->all();
        } elseif ($status == 'stars') {
            $productPost = \common\models\costfit\ProductPost::find()
                    ->select('sum(product_post_rating.score) as scoreNew  ,product_post.*')
                    ->join("LEFT JOIN", "product_post_rating", "product_post_rating.productPostId = product_post.productPostId")
                    ->where($whereArray)
                    ->groupBy('product_post.productPostId')
                    ->orderBy($sortStr)
                    ->all();
        } else {
            $productPost = \common\models\costfit\ProductPost::find()
                    ->where($whereArray)
                    ->all();
        }
        $i = 0;
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productId =' . $value->productId)->all();
            foreach ($productPostList as $items) {
                //$productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $items['productSuppId'])->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $items['productSuppId'] . ' and status=1')->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = isset($productPrice->price) ? number_format($productPrice->price) : '';
                $price = isset($productPrice->price) ? number_format($productPrice->price) : '';

                $productImagesThumbnail2 = \common\helpers\DataImageSystems::DataImageMaster($items['productId'], $items['productSuppId'], 'Svg260x260');
                //$star = DisplayMyStory::calculatePostRating($value->productPostId);
                //$values = explode(", ", $star);
                $rating_score = \common\helpers\Reviews::RatingInProduct($value->productId, $value->productPostId);
                $rating_member = \common\helpers\Reviews::RatingInMember($value->productId, $value->productPostId);
                if ($rating_score == 0 && $rating_member == 0) {
                    $results_rating = 0;
                } else {
                    $results_rating = $rating_score / $rating_member;
                }
                $products[$value->productPostId] = [
                    'productPostId' => $value->productPostId,
                    'image' => $productImagesThumbnail2,
                    //'url' => '/story?id=' . $items->productSuppId,
                    'url' => Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $items['productSuppId']]),
                    'url_seemore' => Yii::$app->homeUrl . 'story/see-more/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $items['productSuppId']]),
                    'urlEditStory' => Yii::$app->homeUrl . 'story/update-stories/' . $value->encodeParams(['productId' => $items->productId, 'productPostId' => $value->productPostId, 'productSuppId' => $items['productSuppId']]),
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => isset($items->title) ? substr($items->title, 0, 35) : '',
                    'head' => isset($value->title) ? substr($value->title, 0, 45) : '',
                    'price_s' => $price_s,
                    'price' => $price,
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($value->productPostId)),
                    //'star' => $values[0],
                    'star' => number_format($results_rating),
                    'productPostId' => $value->productPostId,
                    'sort' => $sort,
                    'urlProduct' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $items->productId, 'productSupplierId' => $items['productSuppId']]),
                    'avatar' => ''
                ];
            }
        }
// throw new \yii\base\Exception(print_r($products, true));
        return $products;
    }

    public static function productRecentStoriesSort($productId, $productSupplierId, $productPostId, $status, $sort) {
        $products = [];
        $whereArray = [];

        $sortStr = ($status == "stars") ? "sum(product_post_rating.score)" : (($status == "view") ? "count(product_post_view.productPostViewId) " : "count(product_post_view.productPostViewId) ");
        if ($sort == 'SORT_ASC') {
            $sortStr .= ' asc';
        } else {
            $sortStr .= ' desc';
        }
        $whereArray["product_post.productId"] = $productId;
        $whereArray["product_post.status"] = 1;
        if ($status == 'view') {
            $productPost = \common\models\costfit\ProductPost::find()
                    ->select('count(product_post_view.productPostViewId) as viewNew  ,product_post.*')
                    ->join("LEFT JOIN", "product_post_view", "product_post_view.productPostId = product_post.productPostId")
                    ->where($whereArray)
                    ->groupBy('product_post.productPostId')
                    ->orderBy($sortStr)
                    ->all();
        } elseif ($status == 'stars') {
            $productPost = \common\models\costfit\ProductPost::find()
                    ->select('sum(product_post_rating.score) as scoreNew  ,product_post.*')
                    ->join("LEFT JOIN", "product_post_rating", "product_post_rating.productPostId = product_post.productPostId")
                    ->where($whereArray)
                    ->groupBy('product_post.productPostId')
                    ->orderBy($sortStr)
                    ->all();
        }
        /*
          $productPost = \common\models\costfit\ProductPost::find()->where("productId=" . $productId)->orderBy('productPostId desc') //แสดงแค่ 5 รายการ
          ->all();
         */

        $i = 0;
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\Product::find()->where('productId =' . $value->productId)->all();
            foreach ($productPostList as $items) {
                //$productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSupplierId)->one();
                $productImages = \common\models\costfit\ProductImage::find()->where('productId=' . $value->productId)->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $productSupplierId)->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = number_format($productPrice->price);
                $price = number_format($productPrice->price);
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
                    }
                } else {
                    $productImagesThumbnail2 = Base64Decode::DataImageSvg64x64(FALSE, FALSE, FALSE);
                }
                $star = DisplayMyStory::calculatePostRating($value->productPostId);
                $values = explode(",", $star);
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
                    'avatar' => '',
                ];
            }
        }
// throw new \yii\base\Exception(print_r($products, true));
        return $products;
    }

    public static function CurrencyInfos() {
        $products = [];
        $CurrencyInfo = \common\models\costfit\CurrencyInfo::find()->all();
        if (isset($CurrencyInfo)) {
            foreach ($CurrencyInfo as $value) {
                $products[$value->currencyId] = [
                    'currencyId' => $value->currencyId,
                    'ctry_name' => $value->ctry_name,
                    'ccy_name' => $value->ccy_name,
                    'ccy_name_th' => $value->ccy_name_th,
                    'currency_code' => $value->currency_code,
                    'currency_name' => $value->currency_name,
                    'currrency_symbol' => $value->currrency_symbol,
                    'toThb' => $value->toThb,
                    'images' => $value->images,
                ];
            }
        }

        return $products;
    }

}
