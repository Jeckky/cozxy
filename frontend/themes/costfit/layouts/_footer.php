<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Sticky Buttons-->
<div class="sticky-btns">
    <form class="quick-contact ajax-form" method="post" name="quick-contact">
        <h3>Contact us</h3>
        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.</p>
        <div class="form-group">
            <label for="qc-name">Full name</label>
            <input class="form-control input-sm" type="text" name="name" id="qc-name" placeholder="Enter full name">
        </div>
        <div class="form-group">
            <label for="qc-email">Email</label>
            <input class="form-control input-sm" type="email" name="email" id="qc-email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="qc-message">Your message</label>
            <textarea class="form-control input-sm" name="message" id="qc-message" placeholder="Enter your message"></textarea>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5">
                <div class="info">
                    <a class="logo" href="<?php echo $baseUrl; ?>"><img src="<?php echo Yii::$app->homeUrl; ?>images/logo/costfit.png" alt="cost.fit"></a>
                    <p>Describe the mission of your online store and the advantages a customer can get once he makes a
                        purchase. If you have something to tell let customers know about it.</p>
                    <div class="social">
                        <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-youtube-square"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-tumblr-square"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-vimeo-square"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-pinterest-square"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <h2>Latest news</h2>
                <ul class="list-unstyled">
                    <li>25 of May <a href="#">new arrivals in Spring</a></li>
                    <li>24 of April <a href="#">5 facts about clutches</a></li>
                    <li>25 of May <a href="#">new arrivals in Spring</a></li>
                    <li>24 of April <a href="#">5 facts about clutches</a></li>
                </ul>
            </div>
            <div class="contacts col-lg-3 col-md-3 col-sm-3">
                <h2>Contacts</h2>
                <p class="p-style3">
                    4120 Lenox Avenue, New York, NY,<br/>
                    10035 76 Saint Nicholas Avenue<br/>
                    <a href="mailto:mail@Limo.com">mail@Limo.com</a><br/>
                    +48 543765234<br/>
                    +48 555 234 54 34<br/>
                </p>
            </div>
        </div>
        <div class="copyright">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <p>&copy; 2016 www.costfit.com. All Rights Reserved. <!--Designed by <a href="http://8guild.com/" target="_blank">8Guild</a>-->
                    </p>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="payment">
                        <img src="<?php echo $directoryAsset; ?>/img/payment/visa.png" alt="Visa"/>
                        <img src="<?php echo $directoryAsset; ?>/img/payment/paypal.png" alt="PayPal"/>
                        <img src="<?php echo $directoryAsset; ?>/img/payment/master.png" alt="Master Card"/>
                        <img src="<?php echo $directoryAsset; ?>/img/payment/discover.png" alt="Discover"/>
                        <img src="<?php echo $directoryAsset; ?>/img/payment/amazon.png" alt="Amazon"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer><!--Footer Close-->