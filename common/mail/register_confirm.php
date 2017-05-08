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
                    <span style="color:  rgba(255,212,36,.9); ">Cozxy Email Verification</span>
                </div>
                <div class="content" style="background-color: #f5f5f5;">
                    <center>
                        <table background=""  width="100%" height="260" text-align="center" style=" height:260px; width:100% ;  text-align: center;  ">
                            <tr>
                                <td>
                                    <p style="color: #000000; font-size: 20px;">
                                        <strong>
                                            Thank you joining us on Cozxy<br>
                                            Please click the following link to verify your account
                                        </strong>
                                    </p>

                                    <p style="color: #CE3C2D; font-size: 16px;">
                                        <b>Click</b>
                                        <a href="<?php echo $url ?>" style="color: #ff9016; font-size: 16px;"><?php echo $url ?></a> <!--เพื่อยืนยันการสมัคร-->
                                    </p>

                                    <p style="color: #ff9016; font-size: 16px;">This email is an auto-generated email. <br> Please do not reply.</p>
                                </td>
                            </tr>
                        </table>
                    </center>
                    <br><br>
                </div>
                <div class="foorter title"  style="background-color: #000000; color: rgba(255,212,36,.9); padding: 20px;">
                    Cozxy Dot Com Co.,Ltd.<br>
                    Tax : 0105546109903 <br>
                    5 Soi Ram Intra 5 Yeak 4, Anusawari,  <br>
                    Bang Ken, Bangkok 10220<br>
                    T: , F: <br>
                </div>
            </div>
        </div>
    </body>
</html>

