<?php

use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use common\models\costfit\Product;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\SectionItem;
use yii\helpers\Html;
?>
<div class="panel panel-default">
    <div class="panel-heading">ค้นหา</div>
    <?php
    $form = ActiveForm::begin([
                'method' => 'GET',
                'options' => ['class' => 'form-horizontal'],
    ]);
    ?>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-3">
                <label for="">Title</label>
                <?php
                //echo '<label class="control-label">Provinces</label>';
                $title = isset($_GET["title"]) ? $_GET["title"] : ''; //isset($_GET['BrandId'] ? $_GET['BrandId'] : '');
                echo Html::textInput("title", $title, ['class' => 'form-control']);
                ?>
            </div>

            <div class="col-md-3">
                <label for="">Category</label>
                <?php
                //echo '<label class="control-label">Provinces</label>';
                $categoryId = isset($_GET["categoryId"]) ? $_GET["categoryId"] : ''; //isset($_GET['BrandId'] ? $_GET['BrandId'] : '');
                echo kartik\select2\Select2::widget([
                    'name' => 'categoryId',
                    'value' => $categoryId,
                    'data' => common\models\costfit\Category::findCategoryArrayWithMultiLevelBackend(),
                    //'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'),
                    'options' => ['placeholder' => 'Select or Search User Category ...', 'id' => 'CategoryId'], //, 'onchange' => 'this.form.submit()'
                    'pluginOptions' => [
                        'tags' => true,
                        'placeholder' => 'Select or Search ...',
                        'loadingText' => 'Loading Category ...',
                        'initialize' => true,
                    ],
                ]);
                ?>
            </div>

            <div class="col-md-3">
                <label for="">Brand</label>
                <?php
                $brandId = isset($_GET["brandId"]) ? $_GET["brandId"] : ''; //isset($_GET['BrandId'] ? $_GET['BrandId'] : '');
                //echo '<label class="control-label">Provinces</label>';
                echo kartik\select2\Select2::widget([
                    'name' => 'brandId',
                    'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Brand::find()->all(), 'brandId', 'title'),
                    'value' => $brandId,
                    'options' => ['placeholder' => 'Select or Search User Brand ...', 'id' => 'BrandId'], //, 'onchange' => 'this.form.submit()'
                    'pluginOptions' => [
                        'tags' => true,
                        'placeholder' => 'Select or Search ...',
                        'loadingText' => 'Loading Brand ...',
                    //'initialize' => true,
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-3">
                <br>
                <?php
                if (isset($sort) && $sort == 'ASC') {
                    ?>
                    <input type="hidden" name="sort" value="DESC">
                    <button style="border: 0 #ffffff none;background-color: #ffffff;" type="submit"><b>Discent percent</b>&nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-chevron-up"></i></button>
                    <?php
                }
                if (isset($sort) && $sort == 'DESC') {
                    ?>
                    <input type="hidden" name="sort" value="ASC">
                    <button style="border: 0 #ffffff none;background-color: #ffffff;" type="submit"><b>Discent percent</b>&nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-chevron-down"></i></button>
                <?php } ?>
            </div>
        </div>

    </div>
    <div class="panel-footer text-right">
        <button class="btn btn-info" type="submit">Search</button>
        <a href="<?= Yii::$app->homeUrl ?>productpost/section/choose-product?sectionId=<?= $sectionId ?>" class="btn btn-danger"> <i class="glyphicon glyphicon-refresh"></i> Reset</a>
    </div>
    <?php ActiveForm::end(); ?>
</div>