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
                height: 260px;
                color: #ffffff;
                color: #000;
            }
            .foorter{
                background-color: #03a9f4;
                padding: 20px;
                text-align: left;
                line-height: 25px;
            }
        </style>

        <div class="main">
            <div class="main-leyouts">
                <div class="head title" style=" background-color: #000000; color: rgba(255,212,36,.9); padding: 20px;">
                    <span style="color:  rgba(255,212,36,.9); ">COZXY</span>
                </div>
                <div class="content" style="background-color: #f5f5f5;">
                    <center>
                        <table width="100%"  text-align="center" style=" width:100% ;  text-align: center;  ">
                            <tr>
                                <td>
                                    <p style="color: #ff9016; font-size: 20px; text-align: left;"><strong>เรียนคุณ <?php echo $type; ?></strong></p>

                                    <table class="x_col1of2" width="50%" border="0" cellpadding="0" cellspacing="0" align="left" style="border-spacing:0; border-collapse:collapse; font-size:14px">
                                        <tbody>
                                            <tr>
                                                <td class="x_order-col x_pam" align="left" valign="top" style="border-collapse:collapse; padding-top:10px; padding-right:10px; padding-bottom:10px; padding-left:10px">
                                                    <div class="x_order-status-inner">
                                                        <div class="x_color-grey" style="color:#646464">สินค้าจะจัดส่งถึงคุณภายใน:</div>
                                                        <div class="x_pts" style="margin-top:5px; margin-bottom:10px">
                                                            <strong>การจัดส่ง # 1</strong>: Dates Month - Dates Month, Years <br>
                                                            <strong>หมายเหตุ</strong> หากมีการเปลียนวันจะแจ้งให้ทราบทาง Email และ SMS ในลำดับต่อไป
                                                        </div>
                                                        <table width="100%" cellpadding="10" style="width:100%!important">
                                                            <tbody>
                                                                <tr>
                                                                    <td valign="middle" align="center" style="background-color:#F36F21; text-align:center; width:100%!important">
                                                                        <a href="http://info.lazada.co.th/c/r?ACTION=ri&amp;EMID=09004HV02NOAK00UF9C67&amp;UID=KK3CC4L5JWFDRJYB6Q7A&amp;ordernumber=333762358&amp;email=piew%2D17%40hotmail%2Ecom" target="_blank" class="x_btn-orange" style="display:inline-block; text-decoration:none; color:#FFF; width:100%!important">สถานะของคำสั่งซื้อ</a> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="x_col1of2" width="50%" border="0" cellpadding="0" cellspacing="0" align="left" style="border-spacing:0; border-collapse:collapse; font-size:14px">
                                        <tbody>
                                            <tr>
                                                <td class="x_order-col x_pam x_txt-left" valign="top" style="border-collapse:collapse; padding-top:10px; padding-right:10px; padding-bottom:10px; padding-left:10px; text-align:left">
                                                    <div class="x_order-status-inner">
                                                        <div class="x_color-grey" style="color:#646464"><!--สินค้าของคุณจะได้รับการจัดส่งไปยัง-->ที่อยู่การจัดส่งใบบิลลิงส์:</div>
                                                        <div class="x_mts" style="margin-top:5px">
                                                            <strong class="x_color-orange" style="color:#f36f21"> <?php echo $type; ?></strong>
                                                        </div>
                                                        <div class="x_mts" style="margin-top:5px">
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
                                                            <strong>
                                                                <?php
                                                                if (isset($billingCompany)) {
                                                                    echo 'คุณ' . $billingFirstname . ' ' . $billingLastname;
                                                                } else {
                                                                    echo $billingCompany . ' เลขประจำตัวผู้เสียภาษีอากร : ' . $billingTax;
                                                                }
                                                                echo $billingAddress . ' ' . $billingDistrictId . ' / ' . $billingAmphurId . ' / ' . $billingProvinceId . ' / ' . $billingCountryId . ' / ' . $billingZipcode;
                                                                ?><!--บริษัท สยาม แอดมินนิสเทรทีฟ แมเนจเม้นท์
                                                                เลขที่ 313 อาคารมคธ ซ.รามคำแหง 21 (นวศรี)
                                                                แขวงวังทองหลาง กรุงเทพมหานคร/ Bangkok-วังทองหลาง/ Wang Thonglang-10310 10310 --><br>
                                                                Phone: <?php echo $billingTel; ?> </strong>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="border-collapse:collapse; padding:0">
                                    <div style="margin-top:20px; margin-bottom:10px; margin-right:10px"><strong>รายละเอียดของคำสั่งซื้อ:</strong></div>
                                </td>
                            </tr>
                        </table>
                    </center>
                    <br><br>
                    <p style="color: #ff9016; font-size: 16px;">อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>
                </div>
                <div class="foorter title"  style="background-color: #000000; color: rgba(255,212,36,.9); padding: 20px;">
                    บริษัท​ คอ​ซซี่​ ดอทคอม​ จํากัด​<br>
                    เลขประจำตัวผู้เสียภาษี : 0105546109903 <br>
                    สำนักงานใหญ่ เลขที่ 1 ซ.ลาดพร้าว 19 ถ.ลาดพร้าว <br>
                    แขวงจอมพล เขตจตุจักร จังหวัดกรุงเทพมหานคร 10900<br>
                    T: , F: <br>
                </div>
            </div>
        </div>
    </body>
</html>

