<!--sorting-->
<?php
if (isset($categoryId)) {
    $allBrands = [];
    $allCategory = "";
    $flag = FALSE;
    $i = 0;
    $allCategorys = common\models\costfit\Category::find()->where("parentId=" . $categoryId)->all();
    if (isset($allCategorys) && !empty($allCategorys)) {
        foreach ($allCategorys as $category) {
            $allCategory = $allCategory . $category->categoryId . ",";
        }
        $allCategory = $categoryId . "," . substr($allCategory, 0, -1);
    } else {
        $allCategory = $categoryId;
    }
    //$products = common\models\costfit\Product::find()->where("categoryId in (" . $allCategory . ")")->all();
    $products = common\models\costfit\ProductSuppliers::find()->where("categoryId in (" . $allCategory . ")")->all();
    foreach ($products as $product) {
        $flag = check($product->brandId, $allBrands);
        if ($flag == TRUE) {
            $allBrands[$i] = $product->brandId;
            $i++;
        }
    }

    //throw new \yii\base\Exception(print_r($this->params['brandId'], true));
    if (isset($allBrands) && !empty($allBrands)) {
        foreach ($allBrands as $brand) {
            if (isset($brand)) {
                $brands = \common\models\costfit\Brand::find()->where("brandId=" . $brand)->one();
                if (count($brands) > 0) {
                    $params = \common\models\ModelMaster::encodeParams(['brandId' => $brands->brandId]);
                    $total = count(common\models\costfit\ProductSuppliers::find()->where("brandId=" . $brand . " and categoryId in (" . $allCategory . ")")->all());
                    if (file_exists(Yii::$app->basePath . "/web" . $brands->image) && !empty($brands->image)) {
                        $image = $brands->image;
                    } else {
                        $image = Yii::$app->homeUrl . "images/no-image.jpg";
                    }
                    if (isset($brands)) {
                        ?>
                        <a class="item" href="<?php echo Yii::$app->homeUrl; ?>brand/<?= $brands->createTitle() ?>/<?php echo $params; ?>">
                            <img src="<?php echo $image; ?>" alt="" title="<?php echo $brands->title; ?>" width="164" height="120" class="img-responsive"/>
                        </a>
                        <?php
                    }
                } else {
                    $image = Yii::$app->homeUrl . "images/no-image.jpg";
                }
            }
        }
    }
}
?>
