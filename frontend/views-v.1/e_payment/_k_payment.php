<html>
    <body>
        <section id="content" class="gray-area">
            <div class="container">
                <div class="row">
                    <div id="main" class="col-sm-12 col-md-12">
                        <div class="booking-information travelo-box">
                            <h2>Kasikorn Bank PaymentGateway System</h2>
                            <hr />
                            <div class="booking-confirmation clearfix">
                                <i class="soap-icon-clock-1 icon circle"></i>
                                <div class="message">
                                    <h1 class="main-message">Please wait for Redirect to K-Payment Gateway...</h1>
                                    <form id="sendform" name=sendform method=post action=<?= $sendUrl ?>>
                                        <INPUT type="hidden" id=MERCHANT2 name=MERCHANT2 value="<?= $merchantId ?>">
                                        <INPUT type="hidden" id=TERM2 name=TERM2 value="<?= $terminalId ?>">
                                        <INPUT type="hidden" id=AMOUNT2 name=AMOUNT2 value="<?= $amount ?>">
                                        <INPUT type="hidden" id=URL2 name=URL2 value="<?= $url ?>">
                                        <INPUT type="hidden" id=RESPURL name=RESPURL value="<?= $resUrl ?>">
                                        <INPUT type="hidden" id=IPCUST2 name=IPCUST2 value="<?= $cusIp ?>">
                                        <INPUT type="hidden" id=DETAIL2 name=DETAIL2 value="<?= $description ?>">
                                        <INPUT type="hidden" id=INVMERCHANT name=INVMERCHANT value="<?= $invoiceNo ?>">
                                        <input type="hidden" id=FILLSPACE name=FILLSPACE value="<?= $fillSpace ?>"> 
                                        <!-- this input checksum you have to do md5 hash as description in integration guide -->
                                        <INPUT  type="hidden" id=checksum name=checksum value="<?= $checksum; ?>">
                                    </form>
                                    <!--<button onclick="document.sendform.submit();">Submit</button><script>document.sendform.submit();</script>-->
                                </div>
                                <!--<a href="#" class="button btn-small print-button uppercase">print Details</a>-->
                            </div>
                            <!--                            <hr />
                                                        <p><?//= isset($desc) ? $desc : "" ?></p>
                                                        <h2>Buy Again ?</h2>

                                                        <br />
                                                        <a class="button white-color green-bg btn-large" href="<?= Yii::$app->homeUrl . "user/buy-package" ?>">Yes</a>
                                                        <a class="button white-color red-bg btn-large" href="<?= Yii::$app->homeUrl . "user" ?>">No</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Kasikorn Bank PaymentGateway Systemurl for recieving CUP card--><!--<form name=sendform method=post action="https://rt05.kasikornbank.com/pggroup/payment.aspx">--><!-- url for mobile site --><!--<form name=sendform method=post action="https://rt05.kasikornbank.com/mobilepay/payment.aspx">--><!-- normal url for visa,master -->
        <!--        <form name=sendform method=post action="https://rt05.kasikornbank.com/pgpayment/payment.aspx">-->
        <!--        <form name=sendform method=post action="https://rt05.kasikornbank.com/pgpayment/payment.aspx">-->


        <script>

            var auto_refresh = setInterval(
                    function ()
                    {
                        submitform();
                    }, 5000);

            function submitform()
            {
                document.sendform.submit();
            }
        </script>
    </body>
</html>