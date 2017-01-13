<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\costfit\Product;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Wishlist;

/**
 * Wishlist controller
 */
class WishlistController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        //return Yii::$app->getResponse()->redirect('register/login');

        $this->layout = 'content_right';
        $this->title = 'Cozxy.com | wishlist';
        $this->subTitle = 'Wishlist';
        $this->subSubTitle = '';
        $id = '';
        $wishlists = Wishlist::find()->where("userId=" . \Yii::$app->user->id)->orderBy("createDateTime DESC")->all();
        //$product = \common\models\costfit\search\Product::find()->where("categoryId='3'")->all();
        $product = ProductSuppliers::find()->where("approve='approve'")->all();
        $products = new Product();
        $wishlistId = $this->inwishlistId($wishlists);
        $allProducts = $this->allProduct();
        if (isset($allProducts) && !empty($allProducts) && ($allProducts != '') && ($wishlistId != '')) {
            foreach ($allProducts as $item):
                $id = $id . $item . ",";
            endforeach;
            $id = substr($id, 0, -1);
            $notInWislist = ProductSuppliers::find()
                    ->where("productSuppId in ($id) and productSuppId not in ($wishlistId) and approve='approve'")
                    ->orderBy(new \yii\db\Expression('rand()'))
                    ->limit(4)
                    ->all();
        } else {
            $notInWislist = ProductSuppliers::find()->where("approve='approve'")
                    ->orderBy(new \yii\db\Expression('rand()'))
                    ->limit(4)
                    ->all();
        }

        return $this->render('wishlist', compact('wishlists', 'product', 'products', 'notInWislist'));
    }

    public function allProduct() {
        $products = Product::find()->where("approve='approve'")->all();
        $productSuppId = [];
        if (isset($products) && !empty($products)) {
            $i = 0;
            foreach ($products as $product):
                $productSuppliers = ProductSuppliers::find()->where("productId=" . $product->productId . " and approve='approve'")->all();
                if (isset($productSuppliers) && !empty($productSuppliers)) {
                    $id = '';
                    foreach ($productSuppliers as $productSupplier):
                        $id = $id . $productSupplier->productSuppId . ",";
                    endforeach;
                    $id = substr($id, 0, -1);
                    if ($id != '') {
                        $price = \common\models\costfit\ProductPriceSuppliers::find()->where("productSuppId in ($id)")->orderBy("price ASC")->one();
                        $productSuppId[$i] = $price->productSuppId;
                        $i++;
                    }
                }
            endforeach;
            if (isset($productSuppId) && !empty($productSuppId)) {
                return $productSuppId;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public function inwishlistId($wishlist) {
        $id = '';
        if (isset($wishlist) && !empty($wishlist)) {
            foreach ($wishlist as $item):
                $id = $id . $item->productId . ",";
            endforeach;
            $id = substr($id, 0, -1);
        }
        return $id;
    }

}
