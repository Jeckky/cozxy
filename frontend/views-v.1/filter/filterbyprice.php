<?php $priceRange = $this->context->findPriceRange($categoryId); ?>
<?php
if (isset($priceRange)):
//    throw new \yii\base\Exception(print_r($priceRange, true));
    ?>
    <form method="post" name="price-filters" action="<?= Yii::$app->homeUrl . 'search/' . $title . "/" . common\models\ModelMaster::encodeParams(['categoryId' => $categoryId]); ?>">
        <span class="clear" id="clearPrice" >Clear price</span>
        <!--    <div class="price-btns">
                <button class="btn btn-black btn-sm" value="below 50$">below 50฿</button><br/>
                <button class="btn btn-black btn-sm disabled" value="50$-100$">from 50฿ to 100฿</button><br/>
                <button class="btn btn-black btn-sm" value="100$-300$">from 100฿ to 300฿</button><br/>
                <button class="btn btn-black btn-sm" value="300$-1000$">from 300฿ to 1000฿</button>
            </div>-->
        <div class="price-slider">
            <div id="price-range"></div>
            <div class="values group">

                <!--data-min-val represent minimal price and data-max-val maximum price respectively in pricing slider range; value="" - default values-->
                <input class="form-control" name="min" id="minVal" type="text" data-min-val="<?= $priceRange['min'] ?>" value="<?= isset($_POST['min']) ? $_POST['min'] : $priceRange['min'] * 2 ?>">
                <span class="labels">฿ - </span>
                <input class="form-control" name="max" id="maxVal" type="text" data-max-val="<?= $priceRange['max'] ?>" value="<?= isset($_POST['max']) ? $_POST['max'] : $priceRange['max'] * 0.9 ?>">
                <span class="labels">฿</span>
            </div>
            <input class="btn btn-primary btn-sm" type="submit" value="Filter">
        </div>
    </form>
<?php endif; ?>