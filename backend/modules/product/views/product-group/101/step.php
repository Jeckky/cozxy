<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductGroup */

$this->title = 'Create Product Group';
$this->params['breadcrumbs'][] = ['label' => 'Product Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-group-create">

    <style>
        .wizard {
            margin: 20px auto;
            background: #fff;
        }

        .wizard .nav-tabs {
            position: relative;
            margin: 40px auto;
            margin-bottom: 0;
            border-bottom-color: #e0e0e0;
        }

        .wizard > div.wizard-inner {
            position: relative;
        }

        .connecting-line {
            height: 2px;
            background: #e0e0e0;
            position: absolute;
            width: 80%;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: 50%;
            z-index: 1;
        }

        .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
            color: #555555;
            cursor: default;
            border: 0;
            border-bottom-color: transparent;
        }

        span.round-tab {
            width: 70px;
            height: 70px;
            line-height: 70px;
            display: inline-block;
            border-radius: 100px;
            background: #fff;
            border: 2px solid #e0e0e0;
            z-index: 2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 25px;
        }

        span.round-tab i {
            color: #555555;
        }

        .wizard li.active span.round-tab {
            background: #fff;
            border: 2px solid #5bc0de;

        }

        .wizard li.active span.round-tab i {
            color: #5bc0de;
        }

        span.round-tab:hover {
            color: #333;
            border: 2px solid #333;
        }

        .wizard .nav-tabs > li {
            width: 20%;
        }

        .wizard li:after {
            content: " ";
            position: absolute;
            left: 46%;
            opacity: 0;
            margin: 0 auto;
            bottom: 0px;
            border: 5px solid transparent;
            border-bottom-color: #5bc0de;
            transition: 0.1s ease-in-out;
        }

        .wizard li.active:after {
            content: " ";
            position: absolute;
            left: 46%;
            opacity: 1;
            margin: 0 auto;
            bottom: 0px;
            border: 10px solid transparent;
            border-bottom-color: #5bc0de;
        }

        .wizard .nav-tabs > li a {
            width: 70px;
            height: 70px;
            margin: 20px auto;
            border-radius: 100%;
            padding: 0;
        }

        .wizard .nav-tabs > li a:hover {
            background: transparent;
        }

        .wizard .tab-pane {
            position: relative;
            padding-top: 50px;
        }

        .wizard h3 {
            margin-top: 0;
        }

        @media ( max-width: 585px ) {

            .wizard {
                width: 90%;
                height: auto !important;
            }

            span.round-tab {
                font-size: 16px;
                width: 50px;
                height: 50px;
                line-height: 50px;
            }

            .wizard .nav-tabs > li a {
                width: 50px;
                height: 50px;
                line-height: 50px;
            }

            .wizard li.active:after {
                content: " ";
                position: absolute;
                left: 35%;
            }
        }

        .not-active {
            pointer-events: none;
            cursor: default;
        }
    </style>
    <div class="product-group-form">


        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #000;vertical-align: middle;">
                <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
            </div>
            <div class="panel-body">
                <?php
                $form = ActiveForm::begin([
                    'enableClientValidation' => ($step == 2 || $step == 3 || $step == 4 || $step == 5) ? false : TRUE,
                    'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
                    'fieldConfig' => [
                        'template' => '{label}<div class="col-sm-9">{input}</div>',
                        'labelOptions' => [
                            'class' => 'col-sm-3 control-label'
                        ]
                    ]
                ]);
                ?>
                <div class="wizard" style="padding:10px;">
                    <div class="wizard-inner">
                        <div class="connecting-line"></div>
                        <ul class="nav nav-tabs" role="tablist">

                            <li role="presentation" class="<?= ($step == 1) ? "active" : "disabled not-active" ?>">
                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                    <span class="round-tab">
                                        <i class="fa fa-folder-open"></i>
                                    </span>
                                </a>
                            </li>

                            <li role="presentation" class="<?= ($step == 2) ? "active" : "disabled not-active" ?>">
                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                    <span class="round-tab">
                                        <i class="fa fa-picture-o"></i>
                                    </span>
                                </a>
                            </li>
                            <li role="presentation" class="<?= ($step == 3) ? "active" : "disabled not-active" ?>">
                                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                    <span class="round-tab">
                                        <i class="fa fa-archive"></i>
                                    </span>
                                </a>
                            </li>

                            <li role="presentation" class="<?= ($step == 4) ? "active" : "disabled not-active" ?>">
                                <a href="#step4" data-toggle="tab" aria-controls="complete" role="tab" title="Step 4">
                                    <span class="round-tab">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                </a>
                            </li>

                            <li role="presentation" class="<?= ($step == 5) ? "active" : "disabled not-active" ?>">
                                <a href="#step5" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                    <span class="round-tab">
                                        <i class="fa fa-check"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane <?= ($step == 1) ? " active" : " " ?>" role="tabpanel" id="step1">
                            <h3>Step 1 - Create Product Group Name</h3>
                            <?= $form->errorSummary($model) ?>

                            <?=
                            $form->field($model, 'productGroupTemplateId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(common\models\costfit\ProductGroupTemplate::find()->all(), 'productGroupTemplateId', function ($model) {
                                $title = $model->title . " - Option : ";
                                foreach ($model->productGroupTemplateOptions as $k => $option) {
                                    $title .= $option->title;
                                    if ($k < count($model->productGroupTemplateOptions) - 1) {
                                        $title .= ",";
                                    }
                                }
                                return $title;
                            })
                            , ['prompt' => '-- Select Option Template --'])
                            ?>

                            <?php
                            //echo Html::hiddenInput('input-type-1', $model->categoryId, ['id' => 'input-type-1']);
                            //echo Html::hiddenInput('input-type-2', $model->categoryId, ['id' => 'input-type-2']);
                            echo $form->field($model, 'categoryId')->widget(kartik\select2\Select2::classname(), [
//            'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'),
                                'data' => common\models\costfit\search\Category::findCategoryArrayWithMultiLevelBackend(),
                                'pluginOptions' => [
                                    'loadingText' => '-- Select Category System --',
                                //'params' => ['input-type-1', 'input-type-2']
                                ],
                                'options' => [
                                    'placeholder' => 'Select Category System ...',
                                    'id' => 'categoryId',
                                    'class' => 'required'
                                ],
                            ]); //->label('Category');
                            echo $form->field($model, 'brandId')->widget(kartik\select2\Select2::classname(), [
                                'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Brand::find()->all(), 'brandId', 'title'),
                                'pluginOptions' => [
                                    'loadingText' => '-- Select Brand --',
                                ],
                                'options' => [
                                    'placeholder' => 'Select Brand ...',
                                    'id' => 'brandId',
                                    'class' => 'required'
                                ],
                            ]); //->label('Brand');
                            ?>

                            <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]); ?>

                            <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

                            <?= $form->field($model, 'specification', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

                            <?= $form->field($model, 'price', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 15])->label("Market Price"); ?>

                            <ul class="list-inline pull-right">
                                <li>
                                    <?php echo Html::submitButton('Next', ['class' => 'btn btn-primary next-step', 'name' => 'next', 'value' => 'next']); ?>
                                    <!--<button type="button" class="btn btn-primary next-step">Save and continue</button>-->
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane <?= ($step == 2) ? " active" : " " ?>" role="tabpanel" id="step2">
                            <h3>Step 2 - Product Image</h3>
                            <?php if (isset($_GET["productGroupId"]) && isset($_GET["productGroupTemplateId"])): ?>
                                <?= $this->render("_image_grid", ["id" => $_GET["productGroupId"]]); ?>
                                <?= $this->render("_image_form", ["id" => $_GET["productGroupId"]]); ?>
                            <?php endif; ?>
                            <ul class="list-inline pull-right">
                                <li>
                                    <button type="button" class="btn btn-default prev-step">Previous</button>
                                </li>
                                <li>
                                    <!-- <button type="button" class="btn btn-primary next-step">Save and continue</button>-->
                                    <?php echo Html::submitButton('Next', ['class' => 'btn btn-primary next-step', 'name' => 'next', 'value' => 'next']); ?>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane <?= ($step == 3) ? " active" : " " ?>" role="tabpanel" id="step3">
                            <h3>Step 3</h3>
                            <?php if (isset($productGroupTemplateOptions)): ?>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Seq</th>
                                            <th style="width:10%">Option</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $data = [];
                                        $pgovs = common\models\costfit\ProductGroupOptionValue::find()->where("productGroupId=" . $_GET["productGroupId"])->groupBy("value , productGroupTemplateOptionId")->orderBy("productGroupTemplateOptionId ASC")->all();
                                        foreach ($pgovs as $pgov) {
                                            if (isset($data[$pgov->productGroupTemplateOptionId]) && in_array($pgov->value, $data[$pgov->productGroupTemplateOptionId])) {
                                                continue;
                                            }
                                            $data[$pgov->productGroupTemplateOptionId][] = $pgov->value;
                                        }
                                        //                                                    throw new \yii\base\Exception(print_r($data, true));
                                        $seq = 1;
                                        foreach ($productGroupTemplateOptions as $option):
                                            ?>
                                            <tr>
                                                <td><?= $seq; ?></td>
                                                <td><?= $option->title; ?></td>
                                                <td>
                                                    <?//= Html::textInput("ProductGroupOptionValue[$option->productGroupTemplateOptionId]", NULL, ['class' => 'form-control input-lg', 'placeHolder' => 'ระบุได้หลาย Option ที่มี เช่นสี เป็น Red,Green,Yellow'])
                                                    ?>
                                                    <?php
                                                    // Multiple select without model
                                                    echo Select2::widget([
                                                        'name' => "ProductGroupOptionValue[$option->productGroupTemplateOptionId]",
                                                        'value' => isset($data[$option->productGroupTemplateOptionId]) ? $data[$option->productGroupTemplateOptionId] : NULL, // initial value
//                                                                    'data' => $data,
                                                        'maintainOrder' => true,
                                                        'toggleAllSettings' => [
                                                            'selectLabel' => '<i class="glyphicon glyphicon-ok-circle"></i> Tag All',
                                                            'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle"></i> Untag All',
                                                            'selectOptions' => ['class' => 'text-success'],
                                                            'unselectOptions' => ['class' => 'text-danger'],
                                                        ],
                                                        'options' => ['placeholder' => 'ระบุได้หลาย Option ที่มี เช่นสี เป็น Red,Green,Yellow', 'multiple' => true],
                                                        'pluginOptions' => [
                                                            'tags' => true,
                                                            'maximumInputLength' => 20
                                                        ],
                                                    ]);
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $seq++;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                            <ul class="list-inline pull-right">
                                <li>
                                    <button type="button" class="btn btn-default prev-step">Previous</button>
                                </li>
                                <!--<li><button type="button" class="btn btn-default next-step">Skip</button></li>-->
                                <li><?php echo Html::submitButton('Next', ['class' => 'btn btn-primary next-step', 'name' => 'next', 'value' => 'next']); ?></li>
                            </ul>
                        </div>
                        <div class="tab-pane <?= ($step == 4) ? " active" : " " ?>" role="tabpanel" id="productDetail">
                            <style>
                                .popover-lg {
                                    min-width: 750px
                                }
                            </style>
                            <h3>Edit Product Information</h3>
                            <?php if (isset($dataProvider)): ?>
                                <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                        <li role="presentation" class="<?= (isset($_GET['tab'])) ? (($_GET['tab'] == 1) ? "active " : " ") : "active " ?> text-center">
                                            <a href="#masterProduct" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><br>Master<br>(<?= $dataProvider->getTotalCount() ?>)</a>
                                        </li>
                                        <?php // if ($dataProvider2->totalItemCount > 0): ?>
                                        <li role="presentation" class="<?= (isset($_GET['tab'])) ? (($_GET['tab'] == 2) ? "active " : " ") : " " ?> text-center">
                                            <a href="#myProduct" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><br>My Product<br>(<?= $dataProvider2->getTotalCount() ?>)</a>
                                        </li>
                                        <?php // endif; ?>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade <?= (isset($_GET['tab'])) ? (($_GET['tab'] == 1) ? "active in " : " ") : "active in " ?>  " role="tabpanel" id="masterProduct" aria-labelledby="home-tab">
                                            <?= $this->render("_product_grid", ["dataProvider" => $dataProvider]); ?>
                                        </div>
                                        <div class="tab-pane fade <?= (isset($_GET['tab'])) ? (($_GET['tab'] == 2) ? "active in " : " ") : " " ?> " role="tabpanel" id="myProduct" aria-labelledby="profile-tab">
                                            <?php if ($dataProvider2->getTotalCount() > 0): ?>
                                                <?= $this->render("_product_grid", ["dataProvider" => $dataProvider2, 'gridTitle' => "<span style='color:white;font-weight:bold'>My Product</span>", 'type' => 2, 'isProductSupp' => TRUE]); ?>
                                            <?php else: ?>
                                                <center>
                                                    <h3>Create My Product</h3>
                                                    <a  href="<?= Yii::$app->homeUrl . "product/product-group/create-my-product?productGroupId=" . $_GET["productGroupId"] . "&step=4&productGroupTemplateId=" . $_GET["productGroupTemplateId"]; ?>" class="btn btn-success btn-lg">Create</a>
                                                </center>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li>
                                        <!--<button type="button" class="btn btn-default prev-step">Previous</button>-->
                                        <?php echo Html::a("<i class='glyphicon glyphicon-arrow-left'></i> Back", ['create', 'step' => 3, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]], ['class' => 'btn btn-default']) ?>
                                    </li>

                                    <li><?php echo Html::submitButton('Next', ['class' => 'btn btn-primary next-step', 'name' => 'next', 'value' => 'next']); ?></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane <?= ($step == 5) ? " active" : " " ?>" role="tabpanel" id="productDetail">
                            <style>
                                .popover-lg {
                                    min-width: 750px
                                }
                            </style>
                            <h3>Complete</h3>
                            <?php
                            // Control your pjax options
                            if (isset($countProduct)) {
                                ?>
                                <h4>สร้าง สินค้าในกลุ่ม <?= $model->title; ?> แล้ว<br> จำนวน <?= $countProduct ?> ชิ้น
                                </h4>

                                <ul class="list-inline pull-right">
                                    <li>
                                        <?php echo Html::a("<i class='glyphicon glyphicon-arrow-left'></i> Back", ['create', 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]], ['class' => 'btn btn-default']) ?>
                                        <!--<button type="button" class="btn btn-default prev-step">Previous</button>-->
                                    </li>
                                    <!--<li><button type="button" class="btn btn-default next-step">Skip</button></li>-->
                                    <li><?php echo Html::submitButton('Save Draft', ['class' => 'btn btn-primary next-step', 'name' => 'saveDraft', 'value' => 'saveDraft']); ?></li>
                                    <li><?php echo Html::submitButton('Finish', ['class' => 'btn btn-success next-step', 'name' => 'finish', 'value' => 'finish']); ?></li>
                                </ul>
                                <div class="row col-lg-12 pull-right" style="color:red;text-align: right">
                                    **หมายเหตุ**<br>
                                    หากต้องการแก้ไขอีก ให้กดปุ่ม <b>Save Draft</b> <br>
                                    หากต้องการส่งอนุมัติ ให้กดปุ่ม <b>Finish</b> (ไม่สามารถกลับมาแก้ไขได้ จนกว่าผู้อนุมัติจะส่งกลับเพื่อให้แก้ไข)
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                <!-- Button trigger modal -->
                <!--                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLive">
                                    Launch demo modal
                                </button>-->

                <!-- Modal -->
                <div id="productModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLiveLabel">Product Update</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body" id="productModalBody">
                                <p>Woohoo, you're reading this text in a modal!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->registerJs("
           init.push(function () {
            if (!$('html').hasClass('ie8')) {
                $('#product-description').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
                $('#product-specification').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
            }

        });

", \yii\web\View::POS_END); ?>



    </div>
