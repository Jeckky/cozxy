<?php

namespace frontend\controllers;

use common\models\costfit\Address;
use common\models\costfit\User;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\DisplayMyAccount;
use common\models\costfit\ProductShelf;
use common\models\costfit\Wishlist;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\imagine\Image;

class MyAccountController extends MasterController {

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        // throw new \yii\base\Exception(Yii::getVersion());
        $billingAddress = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountBillingAddress('', \common\models\costfit\Address::TYPE_BILLING)]);
        $personalDetails = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountPersonalDetails('', '')]);
        $cozxyCoin = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountCozxyCoin('', '')]);
        // $wishList = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountWishList(12)]);
        $orderHistory = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountOrderHistory('', ''),
            'pagination' => ['defaultPageSize' => 10]]);

        $productPost = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::productMyaacountStories('', '', ''),
            'pagination' => ['defaultPageSize' => 8]]);

        $trackingOrder = NULL; //new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyTracking::productShowTracking()]);
        $returnList = \common\models\costfit\Ticket::find()->where("userId=" . Yii::$app->user->id)->all();
        $this->createDefault(); //สร้าง  Defalut wishlist and default favorite stories
        $favoriteStory = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::favoriteStories(8)]);
        $statusText = '';
        $user = User::find()->where(['userId' => Yii::$app->user->id])->one();


        return $this->render('index', compact('statusText', 'billingAddress', 'personalDetails', 'cozxyCoin', 'orderHistory', 'productPost', 'trackingOrder', 'returnList', 'favoriteStory', 'user'));
    }

    public function actionMap() {
        return $this->render('map');
    }

    public function actionEditPersonalDetail() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
//        $model->scenario = 'editinfo'; // calling scenario of update

        if (isset($_POST["User"])) {
            $editPersonalDetail = \frontend\models\DisplayMyAccount::myAccountEditPersonalDetail($_POST["User"]);
            if ($editPersonalDetail == TRUE) {
                return $this->redirect(['/my-account']);
            } else {
                return $this->redirect(['/my-account/edit-personal-detail']);
            }
        } else {
            $birthDate = $model->birthDate;
            $historyBirthDate = [];
            if (isset($birthDate)) {
                $birthDateFull = explode(' ', $model->attributes['birthDate']);
                $birthDateShort = explode('-', $birthDateFull[0]);
                $historyBirthDate['day'] = $birthDateShort[2];
                $historyBirthDate['month'] = $birthDateShort[1];
                $historyBirthDate['year'] = $birthDateShort[0];
            } else {
                $historyBirthDate['day'] = FALSE;
                $historyBirthDate['month'] = FALSE;
                $historyBirthDate['year'] = FALSE;
            }

            return $this->render('@app/themes/cozxy/layouts/my-account/_form_personal_detail', compact('model', 'historyBirthDate'));
        }
    }

    public function actionNewBilling() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
        if (isset($_POST['Address'])) {
            $model->attributes = $_POST['Address'];
            if ($_POST["Address"]['isDefault']) {
                \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\Address::TYPE_BILLING]);
                $model->isDefault = 1;
            }
            $model->userId = Yii::$app->user->id;
            $model->type = \common\models\costfit\Address::TYPE_BILLING;
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save(FALSE)) {
                return $this->redirect(['/my-account']);
            }
        }
        //first billing address set default = 1

        $hasAddress = Address::find()->where(['userId' => Yii::$app->user->id, 'isDefault' => 1])->count();
        $model->isDefault = (!$hasAddress) ? 1 : 0;

        $hash = 'add';

        return $this->render('@app/themes/cozxy/layouts/my-account/_form_billing', compact('model', 'hash'));
    }

    public function actionChangePassword() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        $model->scenario = 'profile'; // calling scenario of update
        if (isset($_POST["User"])) {

            $editChangePassword = \frontend\models\DisplayMyAccount::myAccountChangePassword($_POST["User"]);
            if ($editChangePassword == TRUE) {
                return $this->redirect(['/my-account']);
            } else {
                return $this->redirect(['/my-account/change-password']);
            }
        } else {
            return $this->render('@app/themes/cozxy/layouts/my-account/_form_change_password', compact('model'));
        }
    }

    public function actionReset() {
        $request = Yii::$app->request;
        $token = $request->post('token');

        if (Yii::$app->security->validatePassword($token, \Yii::$app->user->identity->password_hash)) {
            // Password Match
            echo TRUE;
        } else {
            // No Match
            echo FALSE;
        }
    }

    public function actionEditBilling($hash) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $addressId = $params['addressId'];
        $model = \common\models\costfit\Address::find()->where('addressId=' . $addressId)->one();
        $model->scenario = 'shipping_address';
        if (isset($_POST['Address'])) {
            $model->attributes = $_POST['Address'];
            if ($_POST["Address"]['isDefault']) {
                \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'addressId' => $addressId, 'type' => \common\models\costfit\Address::TYPE_BILLING]);
                $model->isDefault = 1;
            }
            $model->userId = Yii::$app->user->id;
            $model->type = \common\models\costfit\Address::TYPE_BILLING;
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save(FALSE)) {
                return $this->redirect(['/my-account']);
            }
        }
        if (!isset($model->isDefault)) {
            $model->isDefault = 0;
        }
        $hash = 'edit';

        return $this->render('@app/themes/cozxy/layouts/my-account/_form_billing', compact('model', 'hash'));
    }

    public function actionDeleteItemToBillingAddress() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $address_id = Yii::$app->request->post('addressId');
        $model = \common\models\costfit\Address::find()->where("addressId ='" . $address_id . "'")->one();
        if ($model->delete()) {
            echo 'complete';
        } else {
            //$this->redirect(Yii::$app->homeUrl . 'profile');
            echo 'wrong';
        }
    }

    public function actionPurchaseOrder($hash) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $orderId = Yii::$app->request->get('OrderNo');
        //$this->layout = "/content_profile";
        $this->title = 'Cozxy.com | Order Purchase';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order Purchase";

        //echo htmlspecialchars($orderId);
        if (isset($params['orderId'])) {
            $order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId = "' . $params['orderId'] . '" ')->one();
            $issetPoint = \common\models\costfit\UserPoint::find()->where("userId=" . $order->userId)->one();
            if (isset($issetPoint)) {
                $userPoint = $issetPoint;
            } else {
                $userPoint = $this->CreateUserPoint($order->userId);
            }

            //$orderItem = PickingPoint::GetOrderItemrGroupLockersMaster($orderId);
            return $this->render('@app/themes/cozxy/layouts/my-account/purchase_order', compact('order', 'userPoint'));
        } else {
            return $this->redirect(['my-account']);
        }
    }

    public function actionOrderSort() {

        $status = Yii::$app->request->post('status');
        $selectSearch = Yii::$app->request->post('selectSearch');
        if ($status == 'show1') { // Last 10 orders
            $statusText = 'Last 10 orders';
        } else if ($status == 'show2') { // 15วันที่ผ่านมา
            $statusText = 'Last 15 days';
        } else if ($status == 'show3') { // ระยะ 30 วันที่ผ่านมา
            $statusText = 'Last 30 days';
        } else if ($status == 'show4') { // ระยะ 6 เดือนที่ผ่านมา
            $statusText = 'Last 6 months';
        } else if ($status == 'show5') { // คำสั่งซื้อในปี 2017
            $statusText = 'Orders placed in 2017';
        } else if ($status == 'show6') { // คำสั่งซื้อในปี 2016
            $statusText = 'Orders placed in 2016';
        } else {
            $statusText = '';
        }

        $orderHistorySort = new ArrayDataProvider([
            'allModels' => DisplayMyAccount::myAccountOrderHistorySort($status, $selectSearch),
            'pagination' => ['defaultPageSize' => 50]
        ]);

        return $this->renderAjax("@app/themes/cozxy/layouts/my-account/_order_history", ['orderHistory' => $orderHistorySort, 'statusText' => $statusText]);
    }

    public function actionSortStories() {
        /*
         * request : get
         */
        $isUserId = Yii::$app->request->get('userId');
        /*
         * request : post
         */
        $isStatus = Yii::$app->request->post('status');
        $isSort = Yii::$app->request->post('sort');
        $isType = Yii::$app->request->post('type');
        /*
         * productMyacountStoriesSort($productId, $productSupplierId, $var1 = false)
         */

        $productPost = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::productMyacountStoriesSort($isUserId, $isStatus, $isSort, $isType)]);
        if ($isStatus == 'new') {
            if ($isSort === 'SORT_DESC') {
                $sort = 'SORT_ASC';
                $icon = 'down';
            } elseif ($isSort === 'SORT_ASC') {
                $sort = 'SORT_DESC';
                $icon = 'up';
            }
        }

        if ($isStatus == 'price') {
            if ($isSort === 'SORT_DESC') {
                $sort = 'SORT_ASC';
                $icon = 'down';
            } elseif ($isSort === 'SORT_ASC') {
                $sort = 'SORT_DESC';
                $icon = 'up';
            }
        }

        if ($isStatus == 'view') {
            if ($isSort === 'SORT_DESC') {
                $sort = 'SORT_ASC';
                $icon = 'down';
            } elseif ($isSort === 'SORT_ASC') {
                $sort = 'SORT_DESC';
                $icon = 'up';
            }
        }

        if ($isStatus == 'stars') {
            if ($isSort === 'SORT_DESC') {
                $sort = 'SORT_ASC';
                $icon = 'down';
            } elseif ($isSort === 'SORT_ASC') {
                $sort = 'SORT_DESC';
                $icon = 'up';
            }
        }

        if ($isType == 'myAccount') {
            return $this->renderAjax('@app/themes/cozxy/layouts/my-account/items/_stories_items', compact('productPost', 'sort', 'isStatus', 'icon'));
        } else if ($isType == 'product') {
            return $this->renderAjax('@app/themes/cozxy/layouts/story/_panel_recent_stories_items', compact('productPost', 'sort', 'isStatus', 'icon'));
        }
    }

    public function actionSortStoriesRecent() {

        $isUserId = Yii::$app->request->get('userId');
        /*
         * request : post
         */
        $isStatus = Yii::$app->request->post('status');
        $isSort = Yii::$app->request->post('sort');
        $isType = Yii::$app->request->post('type');
        $productSupplierId = Yii::$app->request->post('productSupplierId');
        $productId = Yii::$app->request->post('productId');

        /*
         * productMyacountStoriesSort($productId, $productSupplierId, $var1 = false)
         */

        $StoryRecentStories = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::productRecentStoriesSort($productId, $productSupplierId, '', $isStatus, $isSort),
            'pagination' => ['defaultPageSize' => 5]]);

        if ($isStatus == 'view') {
            if ($isSort === 'SORT_DESC') {
                $sort = 'SORT_ASC';
                $icon = 'down';
            } elseif ($isSort === 'SORT_ASC') {
                $sort = 'SORT_DESC';
                $icon = 'up';
            }
        } else if ($isStatus == 'stars') {
            if ($isSort === 'SORT_DESC') {
                $sort = 'SORT_ASC';
                $icon = 'down';
            } elseif ($isSort === 'SORT_ASC') {
                $sort = 'SORT_DESC';
                $icon = 'up';
            }
        } else {
            $sort = '';
            $icon = '';
            $isStatus = '';
        }

        return $this->renderAjax("@app/themes/cozxy/layouts/story/items/_panel_recent_stories_sort", ['status' => $isStatus,
                    'icon' => $icon, 'sort' => $sort, 'StoryRecentStories' => $StoryRecentStories, 'productId' => $productId, 'productSupplierId' => $productSupplierId]);
    }

    public function actionDetailTracking($hash) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $orderId = Yii::$app->request->get('OrderNo');
        $this->title = 'Cozxy.com | Order Purchase';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order Purchase";


        if (isset($params['orderId'])) {
            $order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId = "' . $params['orderId'] . '" ')->one();
            $issetPoint = \common\models\costfit\UserPoint::find()->where("userId=" . $order->userId)->one();
            if (isset($issetPoint)) {
                $userPoint = $issetPoint;
            } else {
                $userPoint = $this->CreateUserPoint($order->userId);
            }

            $trackingOrder = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyTracking::productShowTracking($params['orderId'])]);

            //$orderItem = PickingPoint::GetOrderItemrGroupLockersMaster($orderId);
            return $this->render('@app/themes/cozxy/layouts/my-account/purchase_order', compact('order', 'userPoint', 'trackingOrder'));
        } else {
            return $this->redirect(['my-account']);
        }
    }

    public function actionShowWishlistGroup() {
        $shelfId = $_POST['shelfId'];
        $res = [];
        $idHide = [];
        $text = '';
        $productShelf = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and productShelfId !=" . $shelfId)->all();
        if (isset($productShelf) && count($productShelf) > 0) {
            $i = 0;
            foreach ($productShelf as $id):
                $idHide[$i] = $id->productShelfId;
                $i++;
            endforeach;
            $res['idHide'] = $idHide;
        } else {
            $res['idHide'] = false;
        }
        $shelfType = ProductShelf::find()->where("productShelfId =" . $shelfId)->one();
        if ($shelfType->type == 2) {
            $text .= " <div id='editShelf" . $shelfId . "' style='display: none;' class='col-md-12'>
            <h4>Shelf Name</h4>
            <input type='text' name='shelfName' class='fullwidth input-lg' id='shelfName" . $shelfId . "' style='margin-bottom: 10px;' value='" . $shelfType->title . "'>
            <div class='text-right' style=''>
                <input type='hidden' id='productSuppId' value='no'>
                <a href='javascript:cancelEditShelf(" . $shelfId . ")'class='btn btn-black' id='cancelEditShelf" . $shelfId . "'>Cancle</a>&nbsp;&nbsp;&nbsp;
                <a href='javascript:updateShelf(" . $shelfId . ")'class='btn btn-yellow'id='updateShelf" . $shelfId . "'>Update</a>
            </div>
        </div>";
        }
        $wishlists = DisplayMyAccount::myAccountWishList($shelfId, 8);
        if (isset($wishlists) && count($wishlists) > 0) {
            foreach ($wishlists as $item):
                $quantity = 1;
                $text .= '
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 item-to-wishlist-' . $item['wishlistId'] . '">
			<div class="product-box">
				<div class="product-img text-center">
					<a href="' . $item['url'] . '"><img src="' . $item['image'] . '" alt="' . $item['title'] . '" class="fullwidth"></a>
				</div>
				<div class="product-txt">
					<p class="size16"  style="height:50px;"><a href="' . $item['url'] . '" class="fc-black">' . $item['title'] . '</a></p>';
                if ($item['price_s'] > 0) {
                    $text .= '<p>
						<span class="size18">' . $item['price_s'] . '</span> &nbsp;
						<span class="size14 onsale">' . $item['price_s'] . '</span>
					</p>';
                } else {
                    $text .= '<p>
						<span class="size18">&nbsp</span> &nbsp;
						<span class="size14">&nbsp;</span>
					</p>';
                }
                $text .= '<p class="size14 fc-g999">' . $item['brand'] . '</p>'; //sak
                if ($item['maxQnty'] > 0 && $item['price_s'] > 0) {
                    $text .= '<p><a href="javascript:addItemToCartUnitys(\'' . $item['productSuppId'] . '\',\'' . $quantity . '\',\'' . $item['maxQnty'] . '\',\'' . $item['fastId'] . '\',\'' . $item['productId'] . '\',\'' . $item['productSuppId'] . '\',\'' . $item['receiveType'] . '\')" id="addItemsToCartMulti-' . $item['wishlistId'] . '" data-loading-text="ADD TO CART" class="btn-yellow">ADD TO CART</a> &nbsp; <a href="javascript:deleteItemToWishlist(' . $item['wishlistId'] . ');" id="deletetemToWishlists-' . $item['wishlistId'] . '"  class="fc-g999" data-loading-text="<a><i class=\'fa fa-circle-o-notch fa-spin\' aria-hidden=\'true\'></i></a>">REMOVE</a></p>';
                } else {
                    $text .= '<p><a class="btn-black-s">NO TO CART</a> &nbsp; <a href="javascript:deleteItemToWishlist(' . $item['wishlistId'] . ');" id="deletetemToWishlists-' . $item['wishlistId'] . '" class="fc-g999" data-loading-text="<a><i class=\'fa fa-circle-o-notch fa-spin\' aria-hidden=\'true\'></i></a>">REMOVE</a></p>';
                }
                $text .= '</div></div></div>';
            endforeach;
            $isShowSeemore = DisplayMyAccount::wishlistItems($shelfId);
            if ($isShowSeemore > 8) {
                $text .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right" style="margin-bottom:20px;cursor:pointer;"><a href="' . Yii::$app->homeUrl . 'my-account/all-wishlist?s=' . $shelfId . '">See more >></a></div>';
            }
            $res['text'] = $text;
            $res['status'] = true;
        } else {
            $group = ProductShelf::find()->where("productShelfId=" . $shelfId)->one();
            $res['text'] = $text . '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><h4>Your wishlist shelf is empty <span style="margin-left:20px;"><a href="' . Yii::$app->homeUrl . 'site/faqs" target="_blank" style="font-s">What' . "'s " . 'this? </a></span></h4></div>';
            $res['status'] = true;
        }

        return \yii\helpers\Json::encode($res);
    }

    public function createDefault() {
        $defaultWishlist = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and type=1")->one();
        if (!isset($defaultWishlist)) {
            $default = new ProductShelf();
            $default->userId = Yii::$app->user->id;
            $default->title = 'My wishlist';
            $default->type = 1;
            $default->status = 1;
            $default->createDateTime = new \yii\db\Expression('NOW()');
            $default->updateDateTime = new \yii\db\Expression('NOW()');
            $default->save();
        }
        $defaultFavoriteStories = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and type=3")->one();
        if (!isset($defaultFavoriteStories)) {
            $default = new ProductShelf();
            $default->userId = Yii::$app->user->id;
            $default->title = 'My favorite stories';
            $default->type = 3;
            $default->status = 1;
            $default->createDateTime = new \yii\db\Expression('NOW()');
            $default->updateDateTime = new \yii\db\Expression('NOW()');
            $default->save();
        }
    }

    public function actionDeleteShelf() {
        $res = [];
        $text = '';
        $productShelfId = $_POST['shelfId'];
        $productShelf = ProductShelf::find()->where("productShelfId=" . $productShelfId)->one();
        if (isset($productShelf)) {
            $shelfItems = Wishlist::find()->where("productShelfId=" . $productShelfId)->all();
            if (isset($shelfItems) && count($shelfItems) > 0) {
                foreach ($shelfItems as $shelfItem):
                    $shelfItem->delete();
                endforeach;
            }
            $productShelf->delete();
            $allshelf = ProductShelf::wishListGroup();
            $fullCol = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
            if (isset($allshelf) && count($allshelf) > 0) {
                foreach ($allshelf as $shelf):

                    if ($shelf->type == 1) {
                        $a = "<i class='fa fa-heart' aria-hidden='true' style='color:#FFFF00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                    }
                    if ($shelf->type == 2) {
                        $a = "<i class='fa fa-gratipay' aria-hidden='true' style='color:#FF6699;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                    }
                    if ($shelf->type == 3) {
                        $a = "<i class='fa fa-star' aria-hidden='true' style='color:#FFCC00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                    }
                    $text .= '<div class="col-lg-10 bg-gray" style="cursor: pointer;padding:18px 18px 10px;margin-bottom: 10px;" onclick="javascript:showWishlistGroup(' . $shelf->productShelfId . ', 1);" id="showGroup-' . $shelf->productShelfId . '">
                ' . $a . ' ' . $shelf->title . '
            </div>
            <div class="col-lg-10 bg-gray" style="display: none;cursor: pointer;padding:18px 18px 10px;margin-bottom: 10px;" onclick="javascript:showWishlistGroup(' . $shelf->productShelfId . ', 0);" id="hideGroup-' . $shelf->productShelfId . '">
                ' . $a . ' ' . $shelf->title . '
            </div>
            <div class="col-lg-2 bg-gray text-right" style="padding:18px 18px 10px;margin-bottom: 10px; color:#FF6699;">
                <i class="fa fa-edit" aria-hidden="true" style="font-size:20pt;cursor:pointer;" onclick="javascript:editShelf(' . $shelf->productShelfId . ', 1)" id="showEditShelf' . $shelf->productShelfId . '"></i>
                <i class="fa fa-edit" aria-hidden="true" style="font-size:20pt;cursor:pointer;display: none;" onclick="javascript:editShelf(' . $shelf->productShelfId . ', 0)" id="hideEditShelf' . $shelf->productShelfId . '"></i>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-trash" aria-hidden="true" style="font-size:20pt;cursor:pointer;" onclick="javascript:deleteShelf(' . $shelf->productShelfId . ')"></i>
            </div>
            <div id="editShelf' . $shelf->productShelfId . '" style="display: none;" class="col-md-12">

                <h4>Shelf Name</h4>
                <input type="text" name="shelfName" class="fullwidth input-lg" id="shelfName' . $shelf->productShelfId . '" style="margin-bottom: 10px;" value="' . $shelf->title . '">
                <div class="text-right" style="">
                    <input type="hidden" id="productSuppId" value="no">
                    <a href="javascript:cancelEditShelf(' . $shelf->productShelfId . ')"class="btn btn-black" id="cancelEditShelf' . $shelf->productShelfId . '">Cancel</a>&nbsp;&nbsp;&nbsp;
                    <a href="javascript:updateShelf(' . $shelf->productShelfId . ')"class="btn btn-yellow"id="updateShelf' . $shelf->productShelfId . '">Update</a>
                </div>
            </div>';
                    $text .= "<div id='wishListShelf-$shelf->productShelfId'></div>";

                endforeach;
            }
            $res['status'] = true;
            $res['text'] = $text;
        } else {
            $res['status'] = false;
        }

        return \yii\helpers\Json::encode($res);
    }

    public function actionUpdateShelf() {
        $res = [];
        $text = '';
        $productShelfId = $_POST['shelfId'];
        $title = $_POST['name'];
        $productShelfs = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and title='" . $title . "' and status=1")->all();
        if (isset($productShelfs) && count($productShelfs) > 0) {
            $res['status'] = false;
            $res['error'] = 'This name already exists.';
        } else {
            $productShelf = ProductShelf::find()->where("productShelfId=" . $productShelfId)->one();
            if (isset($productShelf)) {
                $productShelf->title = $title;
                $productShelf->updateDateTime = new \yii\db\Expression('NOW()');
                $productShelf->save(false);
                $allshelf = ProductShelf::wishListGroup();
                $fullCol = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
                if (isset($allshelf) && count($allshelf) > 0) {
                    foreach ($allshelf as $shelf):

                        if ($shelf->type == 1) {
                            $a = "<i class='fa fa-heart' aria-hidden='true' style='color:#FFFF00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                        }
                        if ($shelf->type == 2) {
                            $a = "<i class='fa fa-gratipay' aria-hidden='true' style='color:#FF6699;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                        }
                        if ($shelf->type == 3) {
                            $a = "<i class='fa fa-star' aria-hidden='true' style='color:#FFCC00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                        }

                        $text .= '<div class="col-lg-10 bg-gray" style="cursor: pointer;padding:18px 18px 10px;margin-bottom: 10px;" onclick="javascript:showWishlistGroup(' . $shelf->productShelfId . ', 1);" id="showGroup-' . $shelf->productShelfId . '">
                ' . $a . ' ' . $shelf->title . '
            </div>
            <div class="col-lg-10 bg-gray" style="display: none;cursor: pointer;padding:18px 18px 10px;margin-bottom: 10px;" onclick="javascript:showWishlistGroup(' . $shelf->productShelfId . ', 0);" id="hideGroup-' . $shelf->productShelfId . '">
                ' . $a . ' ' . $shelf->title . '
            </div>
            <div class="col-lg-2 bg-gray text-right" style="padding:18px 18px 10px;margin-bottom: 10px; color:#FF6699;">
                <i class="fa fa-edit" aria-hidden="true" style="font-size:20pt;cursor:pointer;" onclick="javascript:editShelf(' . $shelf->productShelfId . ', 1)" id="showEditShelf' . $shelf->productShelfId . '"></i>
                <i class="fa fa-edit" aria-hidden="true" style="font-size:20pt;cursor:pointer;display: none;" onclick="javascript:editShelf(' . $shelf->productShelfId . ', 0)" id="hideEditShelf' . $shelf->productShelfId . '"></i>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-trash" aria-hidden="true" style="font-size:20pt;cursor:pointer;" onclick="javascript:deleteShelf(' . $shelf->productShelfId . ')"></i>
            </div>
            <div id="editShelf' . $shelf->productShelfId . '" style="display: none;" class="col-md-12">

                <h4>Shelf Name</h4>
                <input type="text" name="shelfName" class="fullwidth input-lg" id="shelfName' . $shelf->productShelfId . '" style="margin-bottom: 10px;" value="' . $shelf->title . '">
                <div class="text-right" style="">
                    <input type="hidden" id="productSuppId" value="no">
                    <a href="javascript:cancelEditShelf(' . $shelf->productShelfId . ')"class="btn btn-black" id="cancelEditShelf' . $shelf->productShelfId . '">Cancle</a>&nbsp;&nbsp;&nbsp;
                    <a href="javascript:updateShelf(' . $shelf->productShelfId . ')"class="btn btn-yellow"id="updateShelf' . $shelf->productShelfId . '">Update</a>
                </div>
            </div>';
                        $text .= "<div id='wishListShelf-$shelf->productShelfId'></div>";

                    endforeach;
                }
                $res['status'] = true;
                $res['text'] = $text;
            } else {
                $res['status'] = false;
                $res['error'] = 'Shelf not found.';
            }
        }

        return \yii\helpers\Json::encode($res);
    }

    public function actionAllWishlist() {
        $shelfId = $_GET['s'];
        $wishlists = DisplayMyAccount::myAccountWishList($shelfId, 0);
        $productShelf = ProductShelf::find()->where("productShelfId=" . $shelfId)->one();

        return $this->render('@app/themes/cozxy/layouts/my-account/_wish_list_all', [
                    'wishlists' => $wishlists,
                    'title' => $productShelf->title
        ]);
    }

    public function actionAllFavoriteStory() {
        $favoriteStory = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::favoriteStories(0)]);

        return $this->render('@app/themes/cozxy/layouts/my-account/_favorite_stories_all', [
                    'favoriteStory' => $favoriteStory,
                    'title' => 'Favorite stories'
        ]);
    }

    public function actionUploadAvatar() {
        ini_set('memory_limit', '-1');
        $model = User::find()->where(['userId' => Yii::$app->user->id])->one();

        $imageFile = UploadedFile::getInstance($model, 'avatar');

        $directory = Yii::getAlias('@frontend/web/images/user/');
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }

        $avatarDirectory = Yii::getAlias('@frontend/web/images/user/avatar/');
        if (!is_dir($avatarDirectory)) {
            FileHelper::createDirectory($avatarDirectory);
        }

        if ($imageFile) {
            $uid = uniqid(time(), true);
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;

            if ($imageFile->saveAs($filePath)) {
                Image::thumbnail($filePath, 200, 200)->save($avatarDirectory . $fileName, ['quality' => 80]); // thumbnail file
                $model->avatar = $fileName;
                $model->save(false);
                $res = ['avatar' => Url::home() . 'images/user/avatar/' . $fileName];

                echo Json::encode($res);
            }
        }

        echo '';
    }

}
