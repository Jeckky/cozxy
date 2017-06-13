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

/**
 * Description of DataImageSystems
 *
 * @author it
 */
class DataImageSystems {

    //put your code here
    public static function DataImageMaster($masterId, $suppliersId, $imageSvg) {
        $productImagesThumbnail1 = '';
        //$productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $suppliersId)->orderBy('ordering asc')->one();
        //$productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
        //echo '<pre>';
        //print_r($productImages);
        $productImages = \common\models\costfit\ProductImage::find()->where('productId=' . $masterId)->orderBy('ordering asc')->one();
        if (isset($productImages->imageThumbnail1) && !empty($productImages->imageThumbnail1)) {
            if (file_exists(Yii::$app->basePath . "/web/" . $productImages->imageThumbnail1)) {
                $productImagesThumbnail1 = \Yii::$app->homeUrl . $productImages->imageThumbnail1;
            } else {
                if (isset($masterId)) {
                    //$ImagesMaster = \common\models\costfit\ProductImage::find()->where('productId=' . $masterId)->one();
                    $ImagesMaster = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $suppliersId)->orderBy('ordering asc')->one();
                    if (isset($ImagesMaster->imageThumbnail1) && !empty($ImagesMaster->imageThumbnail1)) {
                        if (file_exists(Yii::$app->basePath . "/web/" . $ImagesMaster->imageThumbnail1)) {
                            $productImagesThumbnail1 = \Yii::$app->homeUrl . $ImagesMaster->imageThumbnail1;
                        } else {
                            $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg($imageSvg);
                        }
                    } else {
                        $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg($imageSvg);
                    }
                } else {
                    $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg($imageSvg);
                }
            }
        } else {
            if (isset($masterId)) {
                $ImagesMaster = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $suppliersId)->one();
                if (isset($ImagesMaster->imageThumbnail1) && !empty($ImagesMaster->imageThumbnail1)) {
                    if (file_exists(Yii::$app->basePath . "/web/" . $ImagesMaster->imageThumbnail1)) {
                        $productImagesThumbnail1 = \Yii::$app->homeUrl . $ImagesMaster->imageThumbnail1;
                    } else {
                        $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg($imageSvg);
                    }
                } else {
                    $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg($imageSvg);
                }
            } else {
                $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg($imageSvg);
            }
        }


        return $productImagesThumbnail1;
    }

    public static function DataImageMasterViewsProdcuts($producmasterId, $productSuppId, $imageSvg1, $imageSvg2) {

        $imagAll = [];
        /*
         * รูปสินค้า
         */
        //$productImagesOneTop = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSuppId)->orderBy('ordering asc')->one();
        $productImagesOneTop = \common\models\costfit\ProductImage::find()->where('productId=' . $producmasterId)->orderBy('ordering asc')->one();
        if (count($productImagesOneTop) > 0) {
            //$productImagesAll = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSuppId . ' and productImageId !=' . $productImagesOneTop['productImageId'])->orderBy('ordering asc')->all();
            $productImagesAll = \common\models\costfit\ProductImage::find()->where('productId=' . $producmasterId)->orderBy('ordering asc')->all();

            foreach ($productImagesAll as $items) {
                if (isset($items['imageThumbnail1']) && !empty($items['imageThumbnail1'])) {
                    if (file_exists(Yii::$app->basePath . "/web/" . $items['imageThumbnail1'])) {
                        $productimageThumbnail1 = Yii::$app->homeUrl . $items['imageThumbnail1'];
                    } else {
                        $masterId = $items['productId'];
                        if (isset($masterId)) {
                            $ImagesMaster = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSuppId)->one();
                            if (isset($ImagesMaster->imageThumbnail1) && !empty($ImagesMaster->imageThumbnail1)) {
                                if (file_exists(Yii::$app->basePath . "/web/" . $ImagesMaster->imageThumbnail1)) {
                                    $productimageThumbnail1 = \Yii::$app->homeUrl . $ImagesMaster->imageThumbnail1;
                                } else {
                                    $productimageThumbnail1 = \common\helpers\Base64Decode::DataImageSvg($imageSvg1);
                                }
                            } else {
                                $productimageThumbnail1 = \common\helpers\Base64Decode::DataImageSvg($imageSvg1);
                            }
                        } else {
                            $productimageThumbnail1 = \common\helpers\Base64Decode::DataImageSvg($imageSvg1);
                        }
                        //$productimageThumbnail1 = \common\helpers\Base64Decode::DataImageSvg260x260(FALSE, FALSE, FALSE);
                    }
                } else {
                    $productimageThumbnail1 = \common\helpers\Base64Decode::DataImageSvg($imageSvg1);
                }
                $imagAll[$items['productImageId']] = [
                    'productImageId' => $items->productImageId,
                    'imageThumbnail1' => $productimageThumbnail1,
                ];
            }

            if (isset($productImagesOneTop['image']) && !empty($productImagesOneTop['image'])) {
                if (file_exists(Yii::$app->basePath . "/web/" . $productImagesOneTop['image'])) {
                    $productImagesOneTopz = Yii::$app->homeUrl . $productImagesOneTop['image'];
                } else {
                    $masterId = $productImagesOneTop['productId'];
                    if (isset($masterId)) {
                        $ImagesMaster = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSuppId)->one();
                        if (isset($ImagesMaster->image) && !empty($ImagesMaster->image)) {
                            if (file_exists(Yii::$app->basePath . "/web/" . $ImagesMaster->image)) {
                                $productImagesOneTopz = \Yii::$app->homeUrl . $ImagesMaster->image;
                            } else {
                                $productImagesOneTopz = \common\helpers\Base64Decode::DataImageSvg($imageSvg2);
                            }
                        } else {
                            $productImagesOneTopz = \common\helpers\Base64Decode::DataImageSvg($imageSvg2);
                        }
                    } else {
                        $productImagesOneTopz = \common\helpers\Base64Decode::DataImageSvg($imageSvg2);
                    }
                }
            } else {
                $masterId = $productImagesOneTop['productId'];
                if (isset($masterId)) {
                    $ImagesMaster = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSuppId)->one();
                    if (isset($ImagesMaster->image) && !empty($ImagesMaster->image)) {
                        if (file_exists(Yii::$app->basePath . "/web/" . $ImagesMaster->image)) {
                            $productImagesOneTopz = \Yii::$app->homeUrl . $ImagesMaster->image;
                        } else {
                            $productImagesOneTopz = \common\helpers\Base64Decode::DataImageSvg($imageSvg2);
                        }
                    } else {
                        $productImagesOneTopz = \common\helpers\Base64Decode::DataImageSvg($imageSvg2);
                    }
                } else {
                    $productImagesOneTopz = \common\helpers\Base64Decode::DataImageSvg($imageSvg2);
                }
            }
        } else {
            $productimageThumbnail1 = \common\helpers\Base64Decode::DataImageSvg($imageSvg1);
            $productImagesOneTopz = \common\helpers\Base64Decode::DataImageSvg($imageSvg2);
        }

        return array('productimageThumbnail1' => $productimageThumbnail1, 'productImagesOneTopz' => $productImagesOneTopz, 'imagAll' => $imagAll);
    }

}
