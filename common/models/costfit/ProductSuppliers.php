<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductSuppliersMaster;

/**
 * This is the model class for table "product_suppliers".
 *
 * @property string $productId
 * @property string $userId
 * @property string $productGroupId
 * @property string $brandId
 * @property string $categoryId
 * @property string $isbn
 * @property string $code
 * @property string $title
 * @property string $optionName
 * @property string $shortDescription
 * @property string $description
 * @property string $specification
 * @property string $width
 * @property string $height
 * @property string $depth
 * @property string $weight
 * @property string $price
 * @property string $unit
 * @property string $smallUnit
 * @property string $tags
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductSuppliers extends \common\models\costfit\master\ProductSuppliersMaster {

    /**
     * @inheritdoc
     */
//    public function rules() {
//        return array_merge(parent::rules(), [[['price']]
//        ]);
//    }
    const SUPPLIERS_APPROVE = 'approve';
    const SUPPLIERS_OLD = 'old';
    const SUPPLIERS_NEW = 'new';

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'categoryId' => 'หมวดหมู่',
            'brandId' => 'ยี่ห้อ',
            'title' => 'หัวข้อ',
            'optionName' => 'option name',
            'shortDescription' => 'คำอธิบายสั้น',
            'description' => 'รายละเอียด',
            'specification' => 'สเปค',
            'width' => 'ความกว้าง',
            'height' => 'ความสูง',
            'depth' => 'ความลึก',
            'weight' => 'น้ำหนัก',
            // 'price' => 'ราคา',
            'unit' => 'หน่วย',
            'smallUnit' => 'หน่วยขนาดเล็ก',
            'tags' => 'แท็ก',
            'quantity' => 'จำนวนสินค้า',
            'bTitle' => 'Brand',
            'cTitle' => 'Category',
            'sUser' => 'Suppliers', 'pTitle' => 'หัวข้อสินค้า',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'price image', 'Smart Price', 'firstname', 'lastname', 'bTitle', 'cTitle', 'uTitle', 'smuTitle'
            , 'simage', 'simageThumbnail1', 'simageThumbnail2', 'priceSuppliers', 'pTitle', 'sUser', 'price'
        ]);
    }

    public function findCheckoutStepArray() {
        return [
            self::SUPPLIERS_APPROVE => "อนุมัติ",
            self::SUPPLIERS_OLD => "สินค้าจาก Cozxy",
            self::SUPPLIERS_NEW => "สินค้าจาก Suppliers"
        ];
    }

    public function getCheckoutStepText($step) {
        $res = $this->findCheckoutStepArray();
        if (isset($res[$step])) {
            return $res[$step];
        } else {
            return NULL;
        }
    }

    public function getBrand() {
        return $this->hasOne(Brand::className(), ['brandId' => 'brandId']);
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['categoryId' => 'categoryId']);
    }

    static public function getUser($userId) {
        $userSuppliers = \common\models\costfit\User::find()->where('UserId =' . $userId)->one();
        if (isset($userSuppliers)) {
            return 'คุณ ' . $userSuppliers->firstname . ' ' . $userSuppliers->lastname;
        } else {
            return 'ไม่พบข้อมูล';
        }
    }

    public static function productPrice($productSuppId) {
        //throw new \yii\base\Exception($productSuppId);
        $lowestPrice = ProductPriceSuppliers::find()->where("productSuppId=" . $productSuppId . " and status=1")->one();
        if (isset($lowestPrice) && !empty($lowestPrice)) {
            return $lowestPrice->price;
        }
    }

    public static function productImageSuppliers($productId) {
        //throw new \yii\base\Exception($productSuppId);
        $image = ProductImageSuppliers::find()->where("productSuppId=" . $productId . " and status=1")->one();
        if (isset($image) && !empty($image)) {
            return $image->imageThumbnail1;
        }
    }

    public static function productPriceSupplier($productSuppId) {
        //throw new \yii\base\Exception($productSuppId);
        $price = ProductPriceSuppliers::find()->where("productSuppId=" . $productSuppId . " and status=1")->one();
        if (isset($price) && !empty($price)) {
            return $price->price;
        }
    }

    public static function productSuppliersId($productSuppId) {
        $id = Product::find()->where("productSuppId=" . $productSuppId)->one();
        if (isset($id) && !empty($id)) {
            return $id->productId;
        }
    }

    public static function supplier($productSuppId) {
        $id = ProductSuppliers::find()->where("productSuppId=" . $productSuppId)->one();
        if (isset($id) && !empty($id)) {
            return $id->userId;
        }
    }

    public static function productSupplierName($productSuppId) {
        $id = ProductSuppliers::find()->where("productSuppId=" . $productSuppId)->one();
        if (isset($id) && !empty($id)) {
            return $id;
        } else {
            return '';
        }
    }

    public static function productImagesSuppliers($productSuppId) {
        //throw new \yii\base\Exception($productSuppId);
        $image = ProductImageSuppliers::find()->where("productSuppId=" . $productSuppId . " and status=1")->all();
        if (isset($image) && !empty($image)) {
            return $image;
        }
    }

    public function getUnits() {
        return $this->hasOne(Unit::className(), ['unitId' => 'unit']);
    }

}
