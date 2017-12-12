<?php
foreach ($pickingPointActiveShow as $key => $model) {
    //echo '<pre>';
    //print_r($expression)
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label text-left" for="formGroupInputLarge">
                    <img src="http://www.cozxy.com/images/subscribe/cozxy-map.png">
                </label>
                <div class="col-sm-10">
                    <div class="size18-xs b" style="color: #000;"><?= $model['title'] ?></div>
                    <div class="size18-xs"><?= $model['description'] ?></div>
                    <div class="col-sm-12" style="top:10px; margin-left: -15px; color: #000;">
                        <h4>MON - SUN 24 hours</h4>
                        <p>
                            <a onclick="pickUpSet(<?= $model['pickingId'] ?>,<?= $model['latitude'] ?>,<?= $model['longitude'] ?>, '', '')" id="pickUpIdx" data-id="<?= $model['pickingId'] ?>-<?= $model['latitude'] ?>-<?= $model['longitude'] ?>" class="btn-default btn size14-xs">SELECT</a>
                                            <!--<a id="pickUpId" data-id="<?= $model['pickingId'] ?>-<?= $model['latitude'] ?>-<?= $model['longitude'] ?>" class="btn-default btn size14-xs">SELECT</a>-->
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <br><hr>
    </div>
    <?php
}?>