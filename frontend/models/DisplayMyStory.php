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

/**
 * ContactForm is the model behind the contact form.
 */
class DisplayMyStory extends Model {

    public static function myStoryTop($hash, $status = FALSE, $type = FALSE) {

        $products = [];
        $productImagesThumbnailNull = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjYwIiBoZWlnaHQ9IjI2MCIgdmlld0JveD0iMCAwIDY0IDY0IiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48IS0tDQpTb3VyY2UgVVJMOiBob2xkZXIuanMvMjYweDI2MA0KQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4NCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQ0KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28NCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWMwYTg2ZjY1YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YzBhODZmNjVhIj48cmVjdCB3aWR0aD0iMjYwIiBoZWlnaHQ9IjI2MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjYuMjI2NTYyNSIgeT0iMzYuNTMyODEyNSI+MjYweDI2MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==';
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
                'url' => Yii::$app->homeUrl . 'story/write-your-story/' . $productPostList->encodeParams(['productSupplierId' => $productPostList['productId'], 'productPostId' => $productPost['productPostId']]),
                'brand' => isset($items->brand) ? $items->brand->title : '',
                'title' => $productPost['title'],
                'views' => number_format(\common\models\costfit\ProductPost::getCountViews($productPost['productPostId'])),
                'text' => 'Write your story'
            ];
        } else {
            $products[0] = [
                'image' => $productImagesThumbnailNull,
                'url' => Yii::$app->homeUrl . '/site/login',
                'brand' => NULL,
                'title' => NULL,
                'views' => NULL,
                'text' => isset(Yii::$app->user->id) ? 'Write your story' : 'Members Only'
            ];
        }

        return $products;
    }

}
