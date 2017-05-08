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

    /*
     * ส่วนของ รูปแบบการรับสินค้า
     * Create date : 09/02/2017
     * Create By : Taninut.Bm
     */
    const APPROVE_RECEIVE_LOCKERS_COOL = '1'; //Lockers เย็น
    const APPROVE_RECEIVE_LOCKERS_HOT = '2'; //Lockers ร้อน
    const APPROVE_RECEIVE_BOOTH = '3'; //Booth
    const APPROVE_RECEIVE_LvsB = '4'; //Lockers and Booth
    const ADD_NEW_PRODUCT_SUPPLIERS = 'ProductSuppliers';

    public $productPrice;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
                [['brandId', 'categoryId', 'title'], 'required', 'on' => self::ADD_NEW_PRODUCT_SUPPLIERS],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'categoryId' => 'หมวดหมู่',
            'brandId' => 'ยี่ห้อ',
            'title' => 'ชื่อสินค้า',
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
	        'productPrice' => 'Product Price'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'price image', 'Smart Price', 'firstname', 'lastname', 'bTitle', 'cTitle', 'uTitle', 'smuTitle'
            , 'simage', 'simageThumbnail1', 'simageThumbnail2', 'priceSuppliers', 'pTitle', 'sUser', 'price', 'orderItemId'
        ]);
    }

    public function findCheckoutStepArray() {
        return [
            self::SUPPLIERS_APPROVE => "อนุมัติ",
            self::SUPPLIERS_OLD => "สินค้าจาก Cozxy",
            self::SUPPLIERS_NEW => "สินค้าจาก Suppliers",
            self::APPROVE_RECEIVE_LOCKERS => "Lockers",
            self::APPROVE_RECEIVE_BOOTH => "Booth",
            self::APPROVE_RECEIVE_LvsB => "Lockers and Booth"
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

    public function getImages() {
        return $this->hasOne(ProductImageSuppliers::className(), ['productSuppId' => 'productSuppId']);
    }

    public function getImageSupp() {
        return $this->hasMany(ProductImageSuppliers::className(), ['productSuppId' => 'productSuppId']);
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['categoryId' => 'categoryId']);
    }

    public function getProductOnePrice() {
        return $this->hasOne(ProductPriceSuppliers::className(), ['productSuppId' => 'productSuppId']);
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
        $image = ProductImageSuppliers::find()->where("productSuppId=" . $productId . " and status=1")->orderBy("ordering ASC")->one();
        if (isset($image) && !empty($image)) {
            return $image->imageThumbnail1;
        } else {
            return '';
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

    public static function productOrder($productSuppId) {
        $model = Order::find()
                ->select(['`order`.*', '`product_suppliers`.*', '`order_item`.*'])
                ->join('LEFT JOIN', 'order_item', 'order.orderId = order_item.orderId')
                ->join('LEFT JOIN', 'product_suppliers', 'order_item.productSuppId = product_suppliers.productSuppId')
                ->where('`order`.status = ' . Order::ORDER_STATUS_E_PAYMENT_SUCCESS . '  '
                        . 'and `product_suppliers`.userId =' . Yii::$app->user->identity->userId . ' and `product_suppliers`.productSuppId=' . $productSuppId)
                ->all();
        if (isset($model) && count($model) > 0) {
            return $model;
        } else {
            return '';
        }
    }

    public static function productImagesSuppliers($productSuppId) {
        //throw new \yii\base\Exception($productSuppId);
        $image = ProductImageSuppliers::find()->where("productSuppId=" . $productSuppId . " and status=1")->orderBy("ordering ASC")->all();
        if (isset($image) && !empty($image)) {
            return $image;
        }
    }

    public function getUnits() {
        return $this->hasOne(Unit::className(), ['unitId' => 'unit']);
    }

    public static function bestSellers() {
        return ProductSuppliers::find()->where("approve='approve' and result>0")->orderBy("rand()")->limit(6)->all();
    }

    public static function itemOnSales() {
        return ProductSuppliers::find()->where("approve='approve' and result>0")->orderBy("rand()")->limit(6)->all();
    }

    public function getProduct() {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

}
