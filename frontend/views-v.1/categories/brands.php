
<!--sorting-->
<?php

use yii\bootstrap\ActiveForm;

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
    ?>
    <!--<form class="subscr-form" >-->
    <?php
    $form = ActiveForm::begin([
        'options' => ['class' => 'subscr-form', 'enctype' => 'multipart/form-data'],
//                        'fieldConfig' => [
//                            'template' => '{label}<div class="col-sm-9">{input}</div>',
//                            'labelOptions' => [
//                                'class' => 'col-sm-3 control-label'
//                            ]
//                        ]
    ]);
    ?>
    <!--    <div class="form-group">
            <label class="sr-only" for="subscr-name">Enter name</label>
            <input type="text" class="form-control input-sm" name="subscr-name" id="subscr-name" placeholder="Search by Brand" required="">
            <button class="subscr-next" style="top:4px;"><i class="icon-magnifier"></i></button>
        </div>-->

    <?php
//        throw new \yii\base\Exception(print_r($this->params['brandId'], true));
    if (isset($allBrands) && !empty($allBrands)) {
        foreach ($allBrands as $brand) {
            if (isset($brand)) {
                $brands = \common\models\costfit\Brand::find()->where("brandId=" . $brand)->one();
                //$total = count(common\models\costfit\Product::find()->where("brandId=" . $brand . " and categoryId in (" . $allCategory . ")")->all());
                $total = count(common\models\costfit\ProductSuppliers::find()->where("brandId=" . $brand . " and categoryId in (" . $allCategory . ")")->all());
                if (isset($brands)) {
                    ?>
                    <div class="checkbox">
                        <input type="checkbox" <?= (in_array($brands->brandId, isset($this->params['brandId']) ? $this->params['brandId'] : [])) ? " checked " : " " ?> class="search-brands" id="search-brands-<?= $brands->brandId ?>" name="search-brands[]" value="<?php echo $brands->brandId; ?>">
                        <label for="search-brands-<?= $brands->brandId ?>" style="padding-left:3px;"><?php echo $brands->title . " (" . $total . ")"; ?></label>
                    </div>
                    <?php
                }
            }
        }
    }
    ?>
    <input id="search-brands-categoryId" type="hidden" name="search-brands-categoryId" value="<?php echo $categoryId; ?>">
    <!--</form>-->
    <?php ActiveForm::end(); ?>
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
