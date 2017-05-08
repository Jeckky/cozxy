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
                                    <p style="color: #ff9016; font-size: 20px; text-align: left;"><strong>เรียนคุณ <?php echo $username; ?></strong></p>

                                    <table class="x_col1of2" width="50%" border="0" cellpadding="0" cellspacing="0" align="left" style="border-spacing:0; border-collapse:collapse; font-size:14px">
                                        <tbody>
                                            <tr>
                                                <td class="x_order-col x_pam" align="left" valign="top" style="border-collapse:collapse; padding-top:10px; padding-right:10px; padding-bottom:10px; padding-left:10px">
                                                    <div class="x_order-status-inner">
                                                        <div class="x_color-grey" style="color:#646464">คุณได้เติมเงินเข้าเว็บไซต์ cozxy.com ผ่านทาง <b><?= $paymentMethod == 1 ? 'Bill payment' : 'Credit card' ?></b> เพื่อซื้อ Point.</div>
                                                        <div class="x_pts" style="margin-top:5px; margin-bottom:10px">
                                                            <strong>จำนวน : <?= $point ?> Point</strong>
                                                            <br>
                                                            <strong>คิดเป็นเงิน : <?= number_format($money, 2) ?> Bath</strong><br>
                                                            <strong>หมายเลขบัญชี :</strong><br>
                                                            <?php
                                                            if (isset($bank) && count($bank) > 0) {
                                                                $i = 1;
                                                                foreach ($bank as $b):
                                                                    echo $i . ' ธนาคาร' . \common\models\costfit\Bank::bankArray($b->bankId)->title . ' หมายเลขบัญชี :' . $b->accNo . '<br>';
                                                                    $i++;
                                                                endforeach;
                                                            }
                                                            ?>
                                                            สามารถตรวจสอบประวัติการเติมเงินได้ที่ : <a href="<?= $url ?>"><?= $url ?></a>
                                                            <br><br>
                                                            <?php
                                                            if ($paymentMethod == 1) {
                                                                echo '* เมื่อชำระเงินเสร็จแล้ว กรุณาอัพโหลดใบเสร็จชำระเงิน เพื่อยืนยันการชำระเงิน <br> จากนั้นรอการตอบกลับทาง Email จาก Cozxydotcom ภายใน 24 ชั่วโมง';
                                                            }
                                                            ?><br>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        </table>
                    </center>
                    <br><br>
                    <p style="color: #ff9016; font-size: 12px;">*** อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>
                </div>
                <div class="foorter title"  style="background-color: #000000; color: rgba(255,212,36,.9); padding: 20px;">
                    Cozxy Dot Com Co.,Ltd.<br>
                    5 Soi Ram Intra 5 Yeak 4, Anusawari, Bang Ken,<br>
                    Bangkok 10220<br>
                    info@cozxy.com<br>
                    064-184-7414 | 9.00-18.00 <br>
                </div>
            </div>
        </div>
        <br><br><br>
    </body>
</html>

