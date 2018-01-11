<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use common\models\costfit\Promotion;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Promotion */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #000;color: #ffcc33;">
        <div class="row">
            <div class="col-md-6" style="font-size: 20pt;"> <?= Html::encode($this->title) ?></div>
            <div class="col-md-6">
                <div class="btn-group pull-right">

                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="promotion-index">
            <div class="promotion-form">

                <?php $form = ActiveForm::begin(); ?>

                <?=
                $form->field($model, 'title')->textInput(['maxlength' => true, 'required' => 'true'
                ])
                ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'promotionCode')->textInput() ?>* ถ้าไม่ใส่ Promotion Code ระบบจะ Generate ให้
                <hr>
                <div class="col-md-12 col-lg-12 text-center"><h3><u>Discount</u></h3></div>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 text-center" style="height: 100px;">
                        <br>
                        <table style="width: 100%;">
                            <tr>
                                <td rowspan="2" style="width: 50%;vertical-align: middle;text-align: right;"><b>Discount Type</b></td>
                                <td><br>
                                    <input type="radio" name="Promotion[discountType]" value="1" required="true" <?= $model->discountType == 1 ? 'checked' : '' ?>>
                                    <span>&nbsp;&nbsp;percent  ( % )</span><br><br>
                                </td>
                            </tr>
                            <tr>

                                <td><input type="radio" name="Promotion[discountType]" value="2" required="true" <?= $model->discountType == 2 ? 'checked' : '' ?>>
                                    <span>&nbsp;&nbsp;cash ( THB )</span></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12"style="height: 100px;">
                        <table>
                            <tr>
                                <td><b>Discount</b></td>
                                <td>&nbsp;&nbsp;
                                    <input type="text" name="Promotion[discount]" class="form-control" required="true" value="<?= isset($model->discount) ? $model->discount : '' ?>">
                                    <br></td>
                            </tr>
                            <tr>
                                <td><b>Maximum discount</b><span><span>&nbsp;&nbsp;( cash THB. )</span></span></td>
                                <td>
                                    <input type="text" name="Promotion[maximumDiscount]" class="form-control" value="<?= isset($model->maximumDiscount) ? $model->maximumDiscount : '' ?>">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 text-center">
                        <b>จำนวนครั้งที่ใช้ได้</b>
                        <input type="text" name="Promotion[maximum]" class="form-control" value="<?= isset($model->maximum) ? $model->maximum : '' ?>">
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 text-center">
                        <b> จำนวนครั้ง / 1 user  </b><input type="text" name="Promotion[perUser]" class="form-control" value="<?= isset($model->perUser) ? $model->perUser : '' ?>">
                    </div>
                </div>
                <br>
                <hr>
                <div class="col-md-12 col-lg-12 text-center"><h3><u>Selsect Category / Brand</u></h3></div>
                <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="margin-top: 20px;margin-bottom: 20px;">
                        <?php
                        if (isset($categories) && count($categories) > 0) {

                            foreach ($categories as $category):
                                $checkcategory = Promotion::categoryPromotion($category->categoryId, $model->promotionId);
                                ?>
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="margin-top: 20px;margin-bottom: 10px;font-size: 12pt;">
                                    <input id="cate<?= $category->categoryId ?>" type="checkbox" name="Promotion[category][<?= $category->categoryId ?>]" value="<?= $category->categoryId ?>" <?= $checkcategory ? 'checked' : '' ?> onclick="javascript:unCheckBrand(<?= $category->categoryId ?>)">
                                    &nbsp;&nbsp;<b><?= $category->title ?></b>
                                </div>
                                <?php
                                $brands = Promotion::categoryToBrandPromotion($category->categoryId);
                                if (isset($brands) && count($brands) > 0) {

                                    foreach ($brands as $brand):
                                        $checkBrand = Promotion::brandPromotion($brand->brandId, $model->promotionId);
                                        ?>
                                        <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                                            <input type="checkbox" id="brand<?= $category->categoryId ?><?= $brand->brandId ?>"name="Promotion[brand][<?= $category->categoryId ?>][<?= $brand->brandId ?>]" value="<?= $brand->brandId ?>" <?= $checkBrand ? 'checked' : '' ?>onclick="javascript:checkCategory(<?= $category->categoryId ?>)">
                                            &nbsp;&nbsp;<?= $brand->title ?>
                                        </div>
                                        <?php
                                    endforeach;
                                    ?>
                                    <div class="text-right col-lg-12 col-md-12">
                                        <input type="checkbox" id="allBrand<?= $category->categoryId ?>" onclick="javascript:checkAllBrand(<?= $category->categoryId ?>)" value="1"> &nbsp;&nbsp;เลือกทุก Brand
                                    </div>
                                    <?php
                                }

                            endforeach;
                        }
                        ?>
                        <br>
                    </div>
                </div>
                <hr>
                <div class="col-md-12 col-lg-12 text-center"><h3><u>Date</u></h3></div>
                <div class="row" style="margin: 20px;">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 text-center">
                        <?=
                        DatePicker::widget(['name' => 'Promotion[startDate]',
                            'dateFormat' => 'yyyy-MM-dd',
                            'options' => ['placeholder' => 'Start Date',
                                'class' => 'form-control',
                                'style' => 'border-color: #66CCFF;height: 40px;',
                                'language' => 'en',
                            ], 'value' => isset($model->startDate) ? $model->startDate : null
                        ])
                        ?>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 text-center">
                        <?=
                        DatePicker::widget(['name' => 'Promotion[endDate]',
                            'dateFormat' => 'yyyy-MM-dd',
                            'options' => ['placeholder' => 'End Date',
                                'class' => 'form-control',
                                'style' => 'border-color: #66CCFF;height: 40px;',
                                'language' => 'en',
                            ], 'value' => isset($model->startDate) ? $model->endDate : null
                        ])
                        ?>
                    </div>
                </div> <br><hr>
                <div class="form-group text-center">
                    <?php
                    if (Yii::$app->controller->action->id == "create") {
                        ?>
                        <?= Html::submitButton('Generate Promotion Code', ['class' => 'btn btn-success']) ?>
                    <?php } else { ?>
                        <?= Html::submitButton('Update Promotion', ['class' => 'btn btn-warning']) ?>
                    <?php } ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>