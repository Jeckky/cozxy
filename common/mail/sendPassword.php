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
                        <table background="https://scontent.fbkk10-1.fna.fbcdn.net/v/t1.0-9/13627169_1304244949603614_4827214866156693546_n.jpg?oh=7f153e886b70ba02a5139fd2821c1c5f&oe=583185F8sxxx"  width="100%"text-align="center" style=" height:700px; width:100% ;  text-align: center;  ">
                            <tr>
                                <td>
                                    <p style="color: #ff9016; font-size: 20px;"><strong>Congratulation! Your order from COZXY.COM has arrived your locker at</strong></p>
                                    <p style="color: #CE3C2D; font-size: 16px;"><b>"<?= $location ?>"</b></p>
                                    <p style="color: #CE3C2D; font-size: 15px;"><b>Address: <?= $address ?></b></p>
                                    <p>MAP</p>
                                    <p><img src="<?= $img ?>" style="width: 700px;height: 440px;"></p>
                                    <p style="color: #ff9016; font-size: 20px;"><strong>Please enter the following code at the locker :</strong></p>
                                    <p style="color: #CE3C2D; font-size: 20px;"><b>" <?= $password ?> "</b></p>
                                    <p style="color: #CE3C2D; font-size: 16px;"><b>You will recieve another one-time passcode at the locker to verify your indentity via SMS.</b></p>
                                    <p style="color: #CE3C2D; font-size: 16px;"><b>Please have your phone with you to retrieve your order.</b></p>
                                    <p>

                                        <a class="btn btn-warning" href="<?= $url ?>" class="btn btn-yellow">View or manage your order here:</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </center>
                    <br><br>


                </div>
                <div class="foorter title"  style="background-color: #000000; color: rgba(255,212,36,.9); padding: 20px;">
                    Cozxy Dot Com Co., Ltd<br>
                    tax Identification Number 0105553036789 <br>
                    5 Ram Intra Soi 5 Yeak4, Anusawari, Khet Bang Ken, Bangkok,10220
                    For customer care please contact us at: customercare@cozxy.com or call 064-184-7414<br>
                </div>
            </div>
        </div>
    </body>
</html>
<!--AIzaSyBuhR_9QIyJeA5Ss8DZKrjteY8yDIvEzoU-->
<?php
//$this->registerCss('
//#map {
//   width: 600px;
//   height: 300px;
//   background-color: grey;
//        }
//');
//
//$this->registerJs('
// var map;
//function initMap() {
//       var uluru = {lat: ' . $lat . ', lng: ' . $lng . '};
//        var map = new google.maps.Map(document.getElementById("map"), {
//          zoom: 17,
//          center: uluru
//        });
//        var marker = new google.maps.Marker({
//          position: uluru,
//          map: map
//        });
//      }', \yii\web\View::POS_HEAD);
//$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&callback=initMap', ['depends' => ['yii\web\YiiAsset']]);
?>