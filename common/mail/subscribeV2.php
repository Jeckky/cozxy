<html>
    <head>
        <title>subscribe</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style type="text/css">
            table, tr, td {
                border: none;
            }
            body {
                /*background: url(bg.png) no-repeat center center  ;*/

            }
            .bg {
                background: url("<?= $urlImg ?>bg.png");
                background-position:top;
                transition: all 1s ease;
                -moz-transition: all 1s ease;
                -ms-transition: all 1s ease;
                -webkit-transition: all 1s ease;
                -o-transition: all 1s ease;
                width: 945px;
                height:1075px;
            }
            .bg-top-head{
                padding-top: 220px;
            }
            .subscribe-layout-left{
                float: left;
                width: 39%;
                padding: 30px;
                color: #000;

            }
            .subscribe-layout-right{
                float: left;
                width: 50%;
                padding: 10px;
                color: #000;
            }
            .subscribe-layout-left-zone-1{
                text-align: left;
                font-weight: bold;
                margin-bottom: 10px;
            }
            .subscribe-layout-left-zone-2{
                text-align: left;
                margin-bottom: 10px;

            }
            .subscribe-layout-left-zone-3{
                text-align: right;
                margin-bottom: 40px;
                padding-right: 40px;
                margin-top: 20px;

            }
            .subscribe-layout-left-zone-4{

            }
            .subscribe-layout-left-zone-4-1{
                width: 370px;
                background-color: #000;
                height: 25px;
                text-align: left;
                color: #fff;
                line-height: 25px;
                padding: 10px;
            }
            .subscribe-layout-left-zone-4-2{
                width: 370px;
                text-align: left;
                padding: 10px;
                margin-top: 10px;
            }
            .subscribe-layout-left-zone-5{

            }
            .subscribe-layout-left-zone-6{

            }
            .subscribe-layout-right-zone-1{
                margin-top: 20px;
            }
            .subscribe-layout-right-zone-2{
                margin-top: 20px;
            }
            .subscribe-layout-footer{
                float: left;
                width: 100%;
                margin-top: 50px;
            }
            .subscribe-layout-footer-zone-1{
                text-align: center;
            }
            .subscribe-layout-footer-zone-2-1{
                text-align: right;
                float: left;
                width: 48%;
                margin-top: 10px;
            }
            .subscribe-layout-footer-zone-2-2{
                text-align: center;
                float: left;
                margin-top: 10px;
            }
            .subscribe-layout-footer-zone-2-3{
                text-align: center;
                float: left;
                margin-top: 10px;
            }
            .subscribe-foorter{
                color: #000; 
                float:left;
                width: 945px;
                height:200px;
                background-color: #CCC;
                background: url("<?= $urlImg ?>bg-footer.png");
                margin-top: 20px;
                text-align: left;

            }
            .subscribe-foorter-zone-1{
                padding: 10px;
            }
        </style>
    </head>
    <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="text-align: center;" >
        <!-- Save for Web Slices (subscribe.png) -->
        <div class="bg">
            <div class="bg-top-head">
                <div class="subscribe-layout-left">
                    <div class="subscribe-layout-left-zone-1">
                        HI (<?php echo $toMail; ?>)
                    </div>
                    <div class="subscribe-layout-left-zone-2">
                        &nbsp;Thank you for signing up to receive our emails. <br>
                        Is's one more way to shop smart with Cozxy.com. <br>
                        You are now part of an elite community and will <br>
                        be among the first to know about exclusive<br>
                        offers, exciting promotions, now products, and<br>
                        inspired tips to care for your skin, body and mind.
                    </div>
                    <div class="subscribe-layout-left-zone-3">
                        Warm regards,<br>
                        Cozxy.com
                    </div>
                    <div class="subscribe-layout-left-zone-4">
                        <div class="subscribe-layout-left-zone-4-1">
                            &nbsp;"Fuel your passion"
                        </div>
                        <div class="subscribe-layout-left-zone-4-2">
                            Our goal is to create an exciting shopping <br>
                            experience thtough our website and mobile<br>
                            application. We work to innovate the interaction<br>
                            of our website and mobiles-application, and<br>
                            the logistic network for self-pick-up at CozxyBox<br>
                            located around the city to serve our target<br>
                            customer
                        </div>
                        <div class="subscribe-layout-left-zone-4-2">
                            We are a marketplace partnering with businesses<br>
                            of all size to open doors to new market and <br>
                            growth,We work with qualified paerners to import <br>
                            and provide products that serve your needs.<br>
                            This is why all our products are <strong>100% authentic.</strong>
                        </div>
                    </div>

                </div>
                <div class="subscribe-layout-right">
                    <div class="subscribe-layout-right-zone-1">
                        <img src="<?= $urlImg ?>locker.png" width="501" height="470">
                    </div>
                    <div class="subscribe-layout-right-zone-2">
                        <img src="<?= $urlImg ?>3-step.png" width="490" height="145">
                    </div>
                </div>
                <div class="subscribe-layout-footer">
                    <div class="subscribe-layout-footer-zone-1">
                        <a href="http://www.cozxy.com/"><img src="<?= $urlImg ?>button-shop-now.png" border="0"></a>
                    </div>
                    <div class="subscribe-layout-footer-zone-2">
                        <div class="subscribe-layout-footer-zone-2-1">
                            <a href="https://www.facebook.com/cozxydotcom/"><img src="<?= $urlImg ?>social-facebook.png" border="0"></a>
                        </div>
                        <div class="subscribe-layout-footer-zone-2-2">
                            <a href="https://www.instagram.com/cozxy_thailand"><img src="<?= $urlImg ?>social-instragram.png" border="0"></a>
                        </div>
                        <div class="subscribe-layout-footer-zone-2-3">
                            <a href="http://www.cozxy.com/"><img src="<?= $urlImg ?>social-twitter.png" border="0"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="subscribe-foorter">
            <div class="subscribe-foorter-zone-1">
                <br><br>
                Please do not reply to this message. If you have any question, please contact us via email at <span style="color: #0000ff;">customercare@cozxy.com</span><br><br>
                Please click here for:COZXY.COM <a href="http://www.cozxy.com/site/terms-and-conditions">Terms and Condition.</a>
                If you received this email from a friend and would like to subscribe to our email list.
                <a href="http://www.cozxy.com/">click here.</a> You have received this email since you submitted your email address to our list of subscribers.
                If you to hear about what's right for you. This email may be considered an advertising or promotional message.
            </div>
        </div>
        <!-- End Save for Web Slices -->
    </body>
</html>