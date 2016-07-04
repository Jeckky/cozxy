<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Tab1 (Specs)-->
<div class="tab-pane fade" id="specs">
    <div class="container">
        <div class="row">
            <section class="tech-specs">
                <div class="container">
                    <div class="row">
                        <!--Column 1-->
                        <!--                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                    Item
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-dollar"></i><span>Best Price</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Affordable prices</p></div>
                                                        </div>
                                                    </div>
                                                    Item
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-umbrella"></i><span>Materials</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Waterproof materials</p></div>
                                                        </div>
                                                    </div>
                                                    Item
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-sort-numeric-asc"></i><span>City bags</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Any size</p></div>
                                                        </div>
                                                    </div>
                                                    Item
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-smile-o"></i><span>Mentions</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Give a smile</p></div>
                                                        </div>
                                                    </div>
                                                    Item
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-recycle"></i><span>Eco activity</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Eco-friendly materials</div>
                                                        </div>
                                                    </div>
                                                    Item
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4"><i class="fa fa-archive"></i><span>Package</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8"><p class="p-style2">Individual packing</p></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                Column 2
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    Item
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-umbrella"></i><span>Materials</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Waterproof materials</p></div>
                                                        </div>
                                                    </div>
                                                    Item
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4"><i class="fa fa-archive"></i><span>Package</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8"><p class="p-style2">Individual packing</p></div>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-smile-o"></i><span>Mentions</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Give a smile</p></div>
                                                        </div>
                                                    </div>
                                                    Item
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-dollar"></i><span>Best Price</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Affordable prices</p></div>
                                                        </div>
                                                    </div>
                                                    Item
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-recycle"></i><span>Eco activity</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Eco-friendly materials</div>
                                                        </div>
                                                    </div>
                                                    Item
                                                    <div class="item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-sort-numeric-asc"></i><span>City bags</span></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Any size</p></div>
                                                        </div>
                                                    </div>
                                                    Item
                                                </div>-->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p class="p-style2"><?= strip_tags($model->specification); ?></p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!--Tab2 (Description)-->
<div class="tab-pane fade  in active" id="descr">
    <div class="container">
        <div class="row">
            <!--<div class="col-lg-4 col-md-5 col-sm-5">
                <img class="center-block" src="<?php //echo $directoryAsset;           ?>/img/posts-widget/1.jpg" alt="Description"/>
            </div>-->
            <div class="col-lg-12 col-md-12 col-sm-12">
<!--                <p class="p-style2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.</p>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6">
                        <h4>Unordered list</h4>
                        <ul>
                            <li>List item</li>
                            <li><a href="#">List item link</a></li>
                            <li>List item</li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6">
                        <h4>Ordered list</h4>
                        <ol>
                            <li>List item</li>
                            <li><a href="#">List item link</a></li>
                            <li>List item</li>
                        </ol>
                    </div>
                </div>-->
                <p class="p-style2"><?= strip_tags($model->description); ?></p>
            </div>
        </div>
    </div>
</div>

<!--Tab3 (Reviews)-->
<div class="tab-pane fade" id="review">
    <div class="container">
        <div class="row">
            <!--Disqus Comments Plugin-->
            <div class="col-lg-10 col-lg-offset-1">
                <div id="disqus_thread"></div>
                <script type="text/javascript">
                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                    var disqus_shortname = '8guild'; // required: replace example with your forum shortname

                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function () {
                        var dsq = document.createElement('script');
                        dsq.type = 'text/javascript';
                        dsq.async = true;
                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
            </div>
        </div>
    </div>
</div>