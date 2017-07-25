<?php
//foreach ($productViews->allModels as $key => $model) {
?>

<div class="row">
    <!--<div class="col-xs-12 bg-white">
        <div class="size12 size10-xs">&nbsp;</div>

        <ul class="nav nav-pills size18 size14-xs b" role="tablist">
            <li role="presentation" class="active"><a href="#account-cozxy" aria-controls="account-cozxy" role="tab" data-toggle="tab">Cozxy</a></li>
           <li role="presentation"><a href="#account-suppliers" aria-controls="account-suppliers" role="tab" data-toggle="tab">Suppliers</a></li>
        </ul>
        <div class="size18 size14-xs">&nbsp;</div>
        <hr>
    </div>-->
    <div class="col-xs-12 bg-white myData">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="account-cozxy">
                <div class="row">
                    <div class="col-xs-12 bg-white">
                        <ul class="nav nav-pills size18 size14-xs b">
                            <li class="active"><a data-toggle="pill" href="#menu1">DETAIL</a></li>
                            <li><a data-toggle="pill" href="#menu2">SPEC</a></li>
                            <!--<li><a data-toggle="pill" href="#menu3">BRAND CONTENT</a></li>
                            <li><a data-toggle="pill" href="#menu4">ETC.</a></li>-->
                        </ul>
                        <div class="size18 size14-xs">&nbsp;</div>
                        <div class="tab-content">
                            <div id="menu1" class="tab-pane fade in active">
                                <p><?php echo $model['descriptionCozxy'] ?></p>
                                <h3>&nbsp;</h3>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <p><?php echo $model['shortDescriptionCozxy'] ?></p>
                                <h3>&nbsp;</h3>
                            </div>
                            <!--
                            <div id="menu3" class="tab-pane fade">
                                <p>&nbsp;</p>
                                <h3>&nbsp;</h3>
                            </div>
                            <div id="menu4" class="tab-pane fade">
                                <p>&nbsp;</p>
                                <h3>&nbsp;</h3>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <!--<div role="tabpanel" class="tab-pane fade in" id="account-suppliers">
                <div class="row">
                    <div class="col-xs-12 bg-white" style="background-color: #fdfdfd;">
                        <ul class="nav nav-pills size18 size14-xs b">
                            <li class="active"><a data-toggle="pill" href="#menu5">DETAIL</a></li>
                            <li><a data-toggle="pill" href="#menu6">SPEC</a></li>

                        </ul>
                        <div class="size18 size14-xs">&nbsp;</div>
                        <div class="tab-content" style="background-color: #fdfdfd;">
                            <div id="menu5" class="tab-pane fade in active">
                                <p><?php echo $model['description'] ?></p>
                                <h3>&nbsp;</h3>
                            </div>
                            <div id="menu6" class="tab-pane fade">
                                <p><?php echo $model['specification'] ?></p>
                                <h3>&nbsp;</h3>
                            </div>

                        </div>
                    </div>
                </div>
            </div>-->

        </div>
    </div>
</div>


<?php
//}?>