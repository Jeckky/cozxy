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
                                    <p style="color: #ff9016; font-size: 20px; text-align: left;"><strong>Purchase Orders to suppliers</strong></p>

                                    <table class="x_col1of2" width="50%" border="0" cellpadding="0" cellspacing="0" align="left" style="border-spacing:0; border-collapse:collapse; font-size:14px">
                                        <tbody>
                                            <tr>
                                                <td class="x_order-col x_pam" align="left" valign="top" style="border-collapse:collapse; padding-top:10px; padding-right:10px; padding-bottom:10px; padding-left:10px">
                                                    <div class="x_order-status-inner">
                                                        <div class="x_color-grey" style="color:#646464">มีรายการสั่งซื้อสั่งซื้อสินค้าส่งถึง supplier </div>
                                                        สามารถตรวจสอบรายการสั่งซื้อได้ที่ : <a href="<?= $url ?>"><?= $url ?></a>
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
                    <p style="color: #ff9016; font-size: 12px;">*** This email is an auto-generated email. <br> Please do not reply.</p>
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

