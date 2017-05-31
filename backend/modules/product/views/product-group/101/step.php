<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use kartik\grid\GridView;

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
        span.round-tab i{
            color:#555555;
        }
        .wizard li.active span.round-tab {
            background: #fff;
            border: 2px solid #5bc0de;

        }
        .wizard li.active span.round-tab i{
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

        @media( max-width : 585px ) {

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
            <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
                <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
            </div>
            <div class="panel-body">
                <?php
                $form = ActiveForm::begin([
                    'enableClientValidation' => ($step == 2 || $step == 3) ? false : TRUE,
                    'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
                    'fieldConfig' => [
                        'template' => '{label}<div class="col-sm-9">{input}</div>',
                        'labelOptions' => [
                            'class' => 'col-sm-3 control-label'
                        ]
                    ]
                ]);
                ?>
                <div class="container">
                    <div class="row">
                        <section>
                            <div class="wizard">
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

                                        <?= $form->field($model, 'productGroupTemplateId', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(common\models\costfit\ProductGroupTemplate::find()->all(), 'productGroupTemplateId', 'title'), ['prompt' => '-- Select Option Template --']) ?>

                                        <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200, 'value' => isset($title) ? $title : false]); ?>

                                        <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

                                        <?= $form->field($model, 'specification', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>



                                        <ul class="list-inline pull-right">
                                            <li>
                                                <?php echo Html::submitButton('Next', ['class' => 'btn btn-primary next-step', 'name' => 'next', 'value' => 'next']); ?>
                                                <!--<button type="button" class="btn btn-primary next-step">Save and continue</button>-->
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane <?= ($step == 2) ? " active" : " " ?>" role="tabpanel" id="step2">
                                        <h3>Step 2 - Product Image</h3>
                                        <?php if (isset($_GET["productGroupId"])): ?>
                                            <?= $this->render("_image_form", ["id" => $_GET["productGroupId"]]); ?>
                                        <?php endif; ?>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
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
                                                        <th>Option</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $seq = 1;
                                                    foreach ($productGroupTemplateOptions as $option):
                                                        ?>
                                                        <tr>
                                                            <td><?= $seq; ?></td>
                                                            <td><?= $option->title; ?></td>
                                                            <td><?= Html::textInput("ProductGroupOptionValue[$option->productGroupTemplateOptionId]", NULL, ['class' => 'form-control input-lg', 'placeHolder' => 'ระบุได้หลาย Option ที่มี เช่นสี เป็น Red,Green,Yellow']) ?></td>
                                                        </tr>
                                                        <?php
                                                        $seq++;
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                            <!--<li><button type="button" class="btn btn-default next-step">Skip</button></li>-->
                                            <li><?php echo Html::submitButton('Next', ['class' => 'btn btn-primary next-step', 'name' => 'next', 'value' => 'next']); ?></li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane <?= ($step == 4) ? " active" : " " ?>" role="tabpanel" id="complete">
                                        <h3>Complete</h3>
                                        <?php
                                        // Control your pjax options
                                        if (isset($dataProvider)) {
                                            echo GridView::widget([
                                                'dataProvider' => $dataProvider,
//                                                'filterModel' => $searchModel,
                                                'columns' => $gridColumns,
                                                'pjax' => true,
                                                'pjaxSettings' => [
                                                    'neverTimeout' => true,
                                                    'beforeGrid' => 'My fancy content before.',
                                                    'afterGrid' => 'My fancy content after.',
                                                ],
                                                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                                                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                                                'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                                                'pjax' => true, // pjax is set to always true for this demo
                                                // set your toolbar
//                                                'toolbar' => [
//                                                    ['content' =>
//                                                        Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
//                                                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
//                                                    ],
//                                                    '{export}',
//                                                    '{toggleData}',
//                                                ],
                                                // set export properties
                                                'export' => [
                                                    'fontAwesome' => true
                                                ],
                                                'panel' => [
                                                    'type' => GridView::TYPE_PRIMARY,
                                                    'heading' => "Product Editor",
                                                ],
                                            ]);
                                        }
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
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
