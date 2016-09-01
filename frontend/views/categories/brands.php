
<!--sorting-->
<?php
if (isset($categoryId)) {
    $allBrands = [];
    $flag = FALSE;
    $i = 0;
    $products = common\models\costfit\Product::find()->where("categoryId=" . $categoryId)->all();
    foreach ($products as $product) {
        $flag = check($product->brandId, $allBrands);
        if ($flag == TRUE) {
            $allBrands[$i] = $product->brandId;
            $i++;
        }
    }
    ?>
    <form class="subscr-form" >
        <div class="form-group">
            <label class="sr-only" for="subscr-name">Enter name</label>
            <input type="text" class="form-control" name="subscr-name" id="subscr-name" placeholder="Search by Brand" required="">
            <button class="subscr-next"><i class="icon-magnifier"></i></button>
        </div>

        <?php
//        throw new \yii\base\Exception(print_r($this->params['brandId'], true));
        if (isset($allBrands) && !empty($allBrands)) {
            foreach ($allBrands as $brand) {
                $brands = \common\models\costfit\Brand::find()->where("brandId=" . $brand)->one();
                $total = count(common\models\costfit\Product::find()->where("brandId=" . $brand . " and categoryId=" . $categoryId)->all());
                if (isset($brands)) {
                    ?>
                    <div class="checkbox">
                        <input type="checkbox" <?= (in_array($brands->brandId, isset($this->params['brandId']) ? $this->params['brandId'] : [])) ? " checked " : " " ?> class="search-brands" id="search-brands" name="search-brands[]" value="<?php echo $brands->brandId; ?>"><?php echo $brands->title . " (" . $total . ")"; ?>
                    </div>
                    <?php
                }
            }
        }
        ?>
        <input id="search-brands-categoryId" type="hidden" name="search-brands-categoryId" value="<?php echo $categoryId; ?>">
    </form>
    <?php
}

function check($brandId, $allBrands)
{
    $check = 0;
    foreach ($allBrands as $old) {
        if ($old == $brandId) {
            $check++;
        }
    }
    if ($check == 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}
?>
