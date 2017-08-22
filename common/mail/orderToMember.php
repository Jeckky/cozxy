<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        -->
    </head>
    <?php
    $billingCompany = $adress['billingCompany'];
    $billingTax = $adress['billingTax'];

    $billingFirstname = $adress['billingFirstname'];
    $billingLastname = $adress['billingLastname'];

    $billingAddress = $adress['billingAddress'];
    $billingCountryId = $adress['billingCountryId'];
    $billingProvinceId = $adress['billingProvinceId'];
    $billingAmphurId = $adress['billingAmphurId'];
    $billingDistrictId = $adress['billingDistrictId'];
    $billingZipcode = $adress['billingZipcode'];
    $billingTel = $adress['billingTel'];
    ?>
    <body>
        <style type="text/css">
            .title{
                color: #fff;
            }
            .main{
                text-align: center;
                width:100%;
                background-color: #ffffff;

            }
            .main .main-leyouts{
                /*padding: 50px;*/
                background-color: #f5f5f5;

            }
            .head{
                background-color: #03a9f4;
                padding: 20px;
                text-align: left;
            }
            .content{
                background-color: #ffffff;
                /*padding: 20px;*/
                text-align: center;
                background-image: url("https://scontent.fbkk10-1.fna.fbcdn.net/v/t1.0-9/13627169_1304244949603614_4827214866156693546_n.jpg?oh=7f153e886b70ba02a5139fd2821c1c5f&oe=583185F8xxxx") ;
                background-repeat: repeat;
                /*height: 260px;*/
                height: auto;
                color: #ffffff;
                color: #000;
            }
            .foorter{
                background-color: #03a9f4;
                padding: 20px;
                text-align: left;
                line-height: 25px;
            }
            #order > table, td, th {
                /* border: 1px solid black;*/
            }
        </style>

        <div class="main">
            <div class="main-leyouts" style="text-align: left;">
                <div class="head title" style=" background-color: #000000; color: rgba(255,212,36,.9); padding: 20px;">
                    <span style="color:  rgba(255,212,36,.9); ">COZXY</span>
                </div>
                <div class="content" style="background-color: #f5f5f5; padding: 30px;">
                    <p>
                        <strong>Hello <?php echo $type; ?>,</strong>
                    </p>
                    <p>
                        Thank you for shopping with us. Your order has been received for the following item. We’ll send a confirmation with your code to open your locker once your items are in!
                    </p>
                    <p>
                        You can track your order with the link below or see it through <i>Order History</i> in  <i>My Account</i>.
                    </p>
                    <p>
                        Note: You will be notified via email and SMS for any changes in delivery schedule.
                    </p>
                    <p>
                        <a href="http://www.cozxy.com/profile/order">
                            <input class="btn btn-black" type="submit" value=" Order status"  style=" background-color:#f1fa8c;text-align:center;">
                        </a>
                    </p>
                    <p>
                        <strong>Billing address :</strong> <br>
                        <?php
                        if (isset($billingCompany)) {
                            //echo 'คุณ' . $billingFirstname . ' ' . $billingLastname . '<br>';
                        } else {
                            echo $billingCompany . ' Tax : ' . $billingTax . '<br>';
                        }
                        echo $billingAddress . ', ' . $billingDistrictId . ' ,' . $billingAmphurId . ' , ' . $billingProvinceId . ' , ' . $billingCountryId . ' , ' . $billingZipcode;
                        ?> <br>
                        Tel: <?php echo $billingTel; ?>
                    </p>
                    <p>
                        <?php
                        /* $GetOrderItemShipping = \common\models\costfit\OrderItem::find()->where("orderId='" . $order->orderId . "' ")->groupBy(['sendDate'])->sum('sendDate');
                          //2017-04-03  วันที่จัดส่งสินค้า ภายในวันที่ Dates Month Years
                          if ($GetOrderItemShipping == 1) {  // 2 วัน
                          $shipping = 2;
                          $date = date("Y-m-d"); //"04-15-2013";
                          $date1 = str_replace('-', '/', $date);
                          $tomorrow = date('Y-m-d', strtotime($date1 . "+1 days"));
                          $date2 = str_replace('-', '/', $tomorrow);
                          $tomorrow_start = date('Y-m-d', strtotime($date2 . "+2 days"));
                          $tomorrow_end = date('Y-m-d', strtotime($date2 . "+5 days"));
                          echo 'วันที่จัดส่งสินค้า ภายในวันที่ ' . \frontend\controllers\MasterController::dateThai($tomorrow, 1) . ' - ' . \frontend\controllers\MasterController::dateThai($tomorrow_end, 1);
                          } else if ($GetOrderItemShipping == 3) { // 5 วัน
                          $shipping = 5;
                          } */
                        ?>
                    </p>
                    <center>
                        <table width="100%"  text-align="center"  style=" width:100% ; height: auto;  text-align: center; margin-left: 20px;">
                            <tr>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="border-collapse:collapse; padding:0">
                                    <div style="margin-top:20px; margin-bottom:10px; margin-right:10px"><strong>detail:</strong></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id="order" class="table table-list-order"  border="0"  style="padding: 0px;" >
                                        <thead>
                                            <tr style="background-color: #f5f5f5;">
                                                <th style="font-size: 13px;">#</th>
                                                <th style="font-size: 13px;">Product code</th>
                                                <th style="font-size: 13px;">Items</th>
                                                <th style="font-size: 13px;">Unit</th>
                                                <th style="font-size: 13px;">Price/Unit</th>
                                                <th style="font-size: 13px;">Quantity</th>
                                                <th style="font-size: 13px;">Total include tax</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            if (count($order) > 0) {
                                                $listOrderItems = common\models\costfit\OrderItem::find()
                                                                ->select('orderId,productSuppId,supplierId,receiveType')->where('orderId=' . $order->orderId)->groupBy('supplierId')->all();
                                                foreach ($listOrderItems as $value1) {
                                                    /*
                                                     * # แยก Suppliers ไม่ซ้ำกัน
                                                     * จาก table OderItem
                                                     * 10/1/2017
                                                     */
                                                    ?>
                                                    <tr style="background-color:rgb(220, 220, 220) ; border-bottom: 1px #000000 solid; height: 25px;text-align: left;">
                                                        <td style="font-size: 12px; text-align: left;" colspan="7"><strong><?php echo isset($value1->user) ? $value1->user->code : '-'; ?></strong></td>
                                                    </tr>
                                                    <?php
                                                    $GetOrderItemMasters = \common\models\costfit\OrderItem::find()->where("orderId=" . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'])->groupBy('receiveType')->all();
                                                    foreach ($GetOrderItemMasters as $value1) {
                                                        //if ($value1->receiveType == 1) {
                                                        ?>

                                                        <?php
                                                        //$GetOrder = common\models\costfit\OrderItem::find()->where('orderId=' . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'] . ' and receiveType=' . $value1->receiveType)->all();
                                                        $GetOrder = common\models\costfit\OrderItem::find()->where('orderId=' . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'])->all();
                                                        $num = 0;
                                                        foreach ($GetOrder as $value) {
                                                            /*
                                                             * # แสดงข้อมูล Product ของแต่ละ Suppliers
                                                             * # เงือนไขของ Product Suppliers
                                                             */
                                                            //$listOrderItemsShow = common\models\costfit\ProductSuppliers::find()->where('productSuppId=' . $value['productSuppId'] . ' and receiveType=' . $value1->receiveType)->one();
                                                            $listOrderItemsShow = common\models\costfit\ProductSuppliers::find()->where('productSuppId=' . $value['productSuppId'])->one();
                                                            ?>
                                                            <tr style=" border-bottom: 1px #000000 solid; text-align: left;">
                                                                <td style="font-size: 12px;text-align: left;"><?php echo ++$i; ?></td>
                                                                <td style="font-size: 12px;text-align: left;"><?php echo isset($listOrderItemsShow['code']) ? $listOrderItemsShow['code'] : '-'; ?></td>
                                                                <td style="font-size: 12px; width: 40%;text-align: left;"><?php echo isset($listOrderItemsShow['title']) ? $listOrderItemsShow['title'] : '-'; ?></td>
                                                                <td style="font-size: 12px;"><?php echo isset($listOrderItemsShow['unit']) ? $listOrderItemsShow->units->title : '-'; ?></td>
                                                                <td style="font-size: 12px; text-align: right;"><?php echo isset($value->price) ? number_format($value->price, 2) : '-'; ?></td>
                                                                <td style="font-size: 12px; text-align: right;"><?php echo isset($value->quantity) ? $value->quantity : '-' ?></td>
                                                                <td style="font-size: 12px; text-align: right;"><?php echo isset($value->total) ? number_format($value->total, 2) : '-'; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <tr style="background-color:#f1f1f1 ; border-bottom: 1px #000000 solid; height: 25px; text-align: left; color: #166db9;">
                                                            <td style="font-size: 12px;" colspan="7">
                                                                <?php
                                                                // $GetOrder = common\models\costfit\OrderItem::find()->where('orderId=' . $value1['orderId'] . ' and supplierId=' . $value1['supplierId'] . ' and receiveType=' . $value1->receiveType)->groupBy('orderId')->one();
                                                                if (isset($GetOrder->pickingId)) {
                                                                    $picking_point = common\models\costfit\PickingPoint::find()->where('pickingId=' . $GetOrder->pickingId)->one();
                                                                    if (count($picking_point) > 0) {
                                                                        $picking_pointName = $picking_point->title;
                                                                    } else {
                                                                        $picking_pointName = '';
                                                                    }
                                                                    $Countries = common\models\dbworld\Countries::find()->where("countryId= '" . $picking_point->countryId . "' ")->one();
                                                                    if (count($Countries) > 0) {
                                                                        $CountriesName = $Countries->localName;
                                                                    } else {
                                                                        $CountriesName = '';
                                                                    }
                                                                    $States = common\models\dbworld\States::find()->where("stateId='" . $picking_point->provinceId . "'")->one();
                                                                    if (count($States) > 0) {
                                                                        $StateslocalName = $States->localName;
                                                                    } else {
                                                                        $StateslocalName = '';
                                                                    }
                                                                    $Cities = common\models\dbworld\Cities::find()->where("cityId='" . $picking_point->amphurId . "'")->one();
                                                                    if (count($Cities) > 0) {
                                                                        $CitieslocalName = $Cities->localName;
                                                                    } else {
                                                                        $CitieslocalName = '';
                                                                    }
                                                                    if ($value1->receiveType == 1) {
                                                                        //echo 'Pickup location: ปลายทางที่ <strong><span style="color: #0286c2;">Lockers เย็น</span></strong>';
                                                                        echo 'Pickup location : <br>' . $picking_pointName;
                                                                        echo '<br> ' . $CountriesName;
                                                                        echo ', ' . $StateslocalName;
                                                                        echo ', ' . $CitieslocalName;
                                                                    } elseif ($value1->receiveType == 2) {
                                                                        //echo 'Pickup location : ปลายทางที่ <strong><span style="color: #0286c2;">Lockers ร้อน</span></strong>';
                                                                    } elseif ($value1->receiveType == 3) {
                                                                        //echo 'Pickup location : ปลายทางที่ <strong><span style="color: #0286c2;">Booth</span></strong>';
                                                                    }
                                                                }

                                                                /*
                                                                  $picking_point = common\models\costfit\PickingPoint::find()->where('pickingId=' . $GetOrder->pickingId)->one();
                                                                  $Countries = common\models\dbworld\Countries::find()->where("countryId= '" . $picking_point->countryId . "' ")->one();
                                                                  $States = common\models\dbworld\States::find()->where("stateId='" . $picking_point->provinceId . "'")->one();
                                                                  $Cities = common\models\dbworld\Cities::find()->where("cityId='" . $picking_point->amphurId . "'")->one();
                                                                  echo '<b>จุดรับสินค้าที่ :</b>' . $picking_point->title;
                                                                  echo ', <b>ประเทศ :</b>' . $Countries->localName;
                                                                  echo ', ' . $States->localName;
                                                                  echo ', ' . $Cities->localName;
                                                                  echo ($value1->receiveType == 1) ? ' สถานที่รับของ : ปลายทางที่ <strong>Lockers</strong>' : ' สถานที่รับของ : ปลายทางที่ <strong>Booth</strong>'; */
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">ไม่พบข้อมูล</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="6">&nbsp;</td>
                                                <td >&nbsp;</td>
                                            </tr>
                                            <tr style="font-size: 12px;">
                                                <td colspan="6" style="text-align: right;">Total Before VAT:</td>
                                                <td style="text-align: right;"><?php echo number_format($order->totalExVat, 2); ?></td>
                                            </tr>
                                            <tr style="font-size: 12px;">
                                                <td colspan="6" style="text-align: right;">VAT 7%:</td>
                                                <td style="text-align: right;"><?php echo number_format($order->vat, 2); ?></td>
                                            </tr>
                                            <tr style="font-size: 12px;">
                                                <td colspan="6" style="text-align: right;">Discount Coupons:</td>
                                                <td style="text-align: right;"><?php echo isset($order->discount) ? number_format($order->discount, 2) : '-'; ?></td>
                                            </tr>
                                            <!--<tr style="font-size: 12px;">
                                                <td colspan="6" style="text-align: right;"><!ส่วนลดพิเศษ / Extra Saving :</td>
                                                <td style="text-align: right;"><?//php echo number_format($order->discount, 2); ?></td>
                                            </tr>-->
                                            <tr style="font-size: 12px;">
                                                <td colspan="6" style="text-align: right;">Shipping Free:</td>
                                                <td style="text-align: right;"><?php echo ($order->shippingRate > 0) ? number_format($order->shippingRate, 2) : "Free"; ?></td>
                                            </tr>
                                            <tr style="font-size: 12px;">
                                                <td colspan="6" style="text-align: right;"> Order Total: </td>
                                                <td style="text-align: right;"><?php echo number_format($order->summary, 2); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <td>
                            </tr>
                        </table>
                    </center>
                    <br><br>
                    <!--<p style="color: #ff9016; font-size: 12px;">*** อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>-->
                </div>
                <div class="foorter title"  style="background-color: #000000; color: rgba(255,212,36,.9); padding: 20px;">
                    Cozxy Dot Com Co.,Ltd.<br>
                    5 Soi Ram Intra 5 Yeak 4, Anusawari, Bang Ken,<br>
                    Bangkok 10220<br>
                    info@cozxy.com<br>
                    064-184-7414 | 9.00-18.00 <br>
                </div>
                <div style="width: 100%;">
                    By placing your order, you agree to cozxy.com’s Conditions of Use.
                    <br>This email is an auto-generated email. Please do not reply.
                </div>
            </div>
        </div>
        <br><br><br>
    </body>
</html>

