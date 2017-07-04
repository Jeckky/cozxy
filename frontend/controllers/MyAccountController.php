<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\DisplayMyAccount;

class MyAccountController extends MasterController {

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $billingAddress = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountBillingAddress('', \common\models\costfit\Address::TYPE_BILLING)]);
        $personalDetails = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountPersonalDetails('', '')]);
        $cozxyCoin = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountCozxyCoin('', '')]);
        // $wishList = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountWishList(12)]);
        $orderHistory = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountOrderHistory('', ''),
            'pagination' => ['defaultPageSize' => 50]]);
        $productPost = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::productMyaacountStories('', '', '')]);
        $trackingOrder = NULL; //new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyTracking::productShowTracking()]);
        $statusText = '';
        return $this->render('index', compact('statusText', 'billingAddress', 'personalDetails', 'cozxyCoin', 'orderHistory', 'productPost', 'trackingOrder'));
    }

    public function actionEditPersonalDetail() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        $model->scenario = 'editinfo'; // calling scenario of update

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
        if (!isset($model->isDefault)) {
            $model->isDefault = 0;
        }
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
        $wishlists = DisplayMyAccount::myAccountWishList($shelfId);
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
            $productShelf = \common\models\costfit\ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and productShelfId !=" . $shelfId)->all();
            if (isset($productShelf) && count($productShelf) > 0) {
                $i = 0;
                foreach ($productShelf as $id):
                    $idHide[$i] = $id->productShelfId;
                    $i++;
                endforeach;
                $res['idHide'] = $idHide;
            }else {
                $res['idHide'] = false;
            }

            $res['text'] = $text;
            $res['status'] = true;
        } else {
            $group = \common\models\costfit\ProductShelf::find()->where("productShelfId=" . $shelfId)->one();
            $res['text'] = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <h3>There are no item in "' . $group->title . '"</h3></div>';
            $res['status'] = true;
        }
        return \yii\helpers\Json::encode($res);
    }

}
