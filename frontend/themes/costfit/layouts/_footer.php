<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<style>
    .footer {
        background: #000000;
        width: 100%;
        color: #fff;
        padding: 60px 0 16px 0;
    }
    .catalog-grid h2 {
        color: #ffffff;

    </style>
    <!--Sticky Buttons-->
    <div class="sticky-btns">
        <form class="quick-contact" method="post" name="quick-contact" action="<?= $baseUrl ?>/contact-us">
            <h3>Contact us</h3>
            <p class="text-muted">
                For customer services, please leave your email and message below, or call us at 064-184-7414 (Thailand)
            </p>
            <div class="form-group">
                <label for="qc-name">Full name</label>
                <input class="form-control input-sm" type="text" name="name" id="qc-name" placeholder="Enter full name" required="true">
            </div>
            <div class="form-group">
                <label for="qc-email">Email</label>
                <input class="form-control input-sm" type="email" name="email" id="qc-email" placeholder="Enter email" required="true">
            </div>
            <div class="form-group">
                <label for="qc-message">Your message</label>
                <textarea class="form-control input-sm" name="message" id="qc-message" placeholder="Enter your message" required="true"></textarea>
            </div>
            <!-- Validation Response -->
            <div class="response-holder"></div>
            <!-- Response End -->
            <input class="btn btn-black btn-sm btn-block" type="submit" value="Send">
        </form>
        <span id="qcf-btn"><i class="fa fa-envelope"></i></span>
        <span id="scrollTop-btn"><i class="fa fa-chevron-up"></i></span>
    </div><!--Sticky Buttons Close-->

    <!--Footer-->
    <footer class="footer">
        <?php
        echo $this->render('@app/views/modal/modal_cart_not_item');
        echo $this->render('@app/views/modal/modal_cart_not_shipping');
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="info">
                        <a class="logo" href="<?php echo $baseUrl; ?>"><img src="<?php echo $baseUrl . $logoImage->image; ?>" alt="footer Cozxy.com"></a>
                        <p><?php echo isset($logoImage->contents[0]) ? $logoImage->contents[0]->description : ""; ?></p>
                        <div class="social">
                            <a href="https://www.instagram.com/cozxy_thailand/" target="_blank"><i class="fa fa-instagram"></i></a>
                            <!--<a href="#" target="_blank"><i class="fa fa-youtube-square"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-tumblr-square"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-vimeo-square"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-pinterest-square"></i></a>-->
                            <a href="https://www.facebook.com/cozxydotcom/" target="_blank"><i class="fa fa-facebook-square"></i></a>
                        </div>
                    </div>
                </div>
                <!--<div class="col-lg-4 col-md-4 col-sm-4">
                  <h2>Latest news</h2>
                   <ul class="list-unstyled">
                <?php
                /* foreach ($news->contents as $allNew):

                  if (isset($allNew) && !empty($allNew)) {
                  if (date('Y-m-d H:i:s') <= $allNew->endDate):
                  ?>

                  <li><?php echo $allNew->headTitle . " "; ?><a href="#"><?php echo $allNew->title; ?></a></li>
                  <?php
                  endif;
                  }endforeach; */
                ?>
                   </ul>
               </div>-->
                <div class="contacts col-lg-6 col-md-6 col-sm-6">
                    <h2>Contact Us</h2>
                    <p class="p-style3">
                        <?php
                        echo $footerContact->contents[0]->description;
                        ?>
                    </p>
                </div>
            </div>
            <div class="copyright">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-7">
                        <p>&copy; 2017 www.cozxy.com All Rights Reserved. <!--Designed by <a href="http://8guild.com/" target="_blank">8Guild</a>-->
                        </p>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        <div class="payment">
                           <!-- <img src="<?//php echo $directoryAsset; ?>/img/payment/visa.png" alt="Visa"/>
                            <img src="<?//php echo $directoryAsset; ?>/img/payment/paypal.png" alt="PayPal"/>
                            <img src="<?//php echo $directoryAsset; ?>/img/payment/master.png" alt="Master Card"/>
                            <img src="<?//php echo $directoryAsset; ?>/img/payment/discover.png" alt="Discover"/>
                            <img src="<?//php echo $directoryAsset; ?>/img/payment/amazon.png" alt="Amazon"/>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!--Footer Close-->
