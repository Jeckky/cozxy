<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductViewMaster;

/**
 * This is the model class for table "product_view".
 *
 * @property string $productViewId
 * @property string $productId
 * @property string $userId
 * @property string $token
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductView extends \common\models\costfit\master\ProductViewMaster
{

    const TIME_OF_NEW_RECORD = 5;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), [
            'sumViews'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    public static function saveProductView($productId)
    {

        $route = Yii::$app->requestedRoute;
        $routeArray = explode("/", $route);
        if ($routeArray[0] == "products" && ($routeArray[1] == "index" || $routeArray[1] == "change-option")) {
//            throw new \yii\base\Exception;
            $model = new ProductView();
            $model->productId = $productId;
            $strAnd = " ";
            if (\Yii::$app->user->isGuest) {
                $model->token = \common\helpers\Token::getTokenToAnothor();
                $strAnd.=" AND token = '$model->token' ";
            } else {
                $model->userId = \Yii::$app->user->id;
                $strAnd.=" AND userId = $model->userId ";
            }
            $model->createDateTime = new yii\db\Expression("NOW()");
            if (isset($_GET['hash'])) {
                $hash = $_GET['hash'];
                $k = base64_decode(base64_decode($hash));
                $params = \common\models\ModelMaster::decodeParams($hash);
                if (isset($params['productId'])) {
                    $pproductId = $params['productId'];
                } else {
                    $pproductId = null;
                }
            } else {
                $pproductId = null;
            }
            $productViewAll = ProductView::find()->all();
            if (count($productViewAll) > 0) {
                $recentView = ProductView::find()->where("TIMESTAMPDIFF(MINUTE,createDateTime,NOW()) < " . self::TIME_OF_NEW_RECORD . " and productId= $productId $strAnd")->all();
                if (count($recentView) == 0) {
                    if ((isset($pproductId) && $productId == $pproductId) || $routeArray[1] == "change-option") {
                        $model->save();
                    }
                }
            } else {
                if ((isset($pproductId) && $productId == $pproductId) || $routeArray[1] == "change-option") {
                    $model->save();
                }
            }
        }
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

}
