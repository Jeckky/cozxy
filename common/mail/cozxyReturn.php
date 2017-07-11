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
            <div class="main-leyouts">
                <div class="head title" style=" background-color: #000000; color: rgba(255,212,36,.9); padding: 20px;">
                    <span style="color:  rgba(255,212,36,.9); ">COZXY</span>
                </div>
                <div class="content" style="background-color: #f5f5f5;">
                    <center>
                        <table width="100%"  text-align="center"  style=" width:100% ; height: auto;  text-align: center;">
                            <tr>
                                <td>
                                    <p style="color: #ff9016; font-size: 20px; text-align: left;"><strong>Hello <?php echo $username; ?></strong></p>

                                    <table class="x_col1of2" width="100%" border="0" cellpadding="0" cellspacing="0" align="left" style="border-spacing:0; border-collapse:collapse; font-size:14px">
                                        <tbody>
                                            <tr>
                                                <td class="x_order-col x_pam" align="left" colspan="5" valign="top" style="border-collapse:collapse; padding-top:10px; padding-right:10px; padding-bottom:10px; padding-left:10px">
                                                    <div class="x_order-status-inner">
                                                        <h4>Your ticketNo #<?= $ticketNo ?> in orderNo <?= $orderNo ?> was verify by Cozxy.com</b></h4>
                                                        <div class="x_pts" style="margin-top:5px; margin-bottom:10px">
                                                            <strong>Status : <?= $status ?></strong>
                                                            <br><strong>Detail</strong>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style="height: 50px;background-color: #999999;">
                                                <th style="vertical-align: middle;text-align: center;width: 5%;">No.</th>
                                                <th style="vertical-align: middle;text-align: center;width: 20%;">product</th>
                                                <th style="vertical-align: middle;text-align: center;width: 5%;">Quantity</th>
                                                <th style="vertical-align: middle;text-align: center;width: 10%;">Price</th>
                                                <th style="vertical-align: middle;text-align: center;width: 10%;">total</th>
                                                <th style="vertical-align: middle;text-align: center;width: 20%;">status</th>
                                                <th style="vertical-align: middle;text-align: center;width: 30%;">remark</th>
                                            </tr>
                                            <?php
                                            $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
                                            if (count($listReturn) > 0) {
                                                foreach ($listReturn as $i => $item):
                                                    ?>
                                                    <tr class="text-center">
                                                        <td><?= $i + 1 ?></td>
                                                        <td>
                                                            <img src="<?= $baseUrl . '/' . \common\models\costfit\ProductSuppliers::productImagesSuppliers($item->productSuppId)[0]->image ?>" style="width:100px;height: 80px;">
                                                            <br><?= \common\models\costfit\ProductSuppliers::productSupplierName($item->productSuppId)->title ?>
                                                        </td>
                                                        <td><?= $item->quantity ?></td>
                                                        <td><?= number_format($item->price, 2) ?></td>
                                                        <td><?= number_format($item->totalPrice, 2) ?></td>
                                                        <td>
                                                            <?php
                                                            if ($item->status == 3) {
                                                                echo 'Booth not approve';
                                                            } else if ($item->status == 5) {
                                                                echo 'Cozxy approve';
                                                            } else if ($item->status == 6) {
                                                                echo 'Cozxy not approve';
                                                            } else {
                                                                echo 'Contact Cozxy.com';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $item->remark ?></td>
                                                    </tr>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="5" style="text-align: left;">
                                                    <?php if ($status == 'Successful') { ?>
                                                        <strong>Return coins : <?= number_format($returnCoin, 2) ?></strong><br>
                                                        <strong>Current coins : <?= number_format($currentCoin, 2) ?></strong><br>
                                                    <?php } else {
                                                        ?>
                                                        * <?= $remark ?><br>
                                                        Please get your products back at Booth : <?= $booth ?>
                                                    <?php } ?><br>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </center>
                    <br><br>
                    <p style="color: #ff9016; font-size: 12px;">*** This email is automatically reported. Please do not reply.</p>
                </div>
                <div class="foorter title"  style="background-color: #000000; color: rgba(255,212,36,.9); padding: 20px;">
                    Cozxy Dot C Co., Ltd<br>
                    Tax Identification Number 0105553036789 <br>
                    5 Ram Intra Soi 5 Yeak4, Anusawari, Khet Bang Ken, Bangkok,10220
                    Tel: 02-101-0689 , Fax: 02-101-0689<br>

                </div>
            </div>
        </div>
        <br><br><br>
    </body>
</html>

