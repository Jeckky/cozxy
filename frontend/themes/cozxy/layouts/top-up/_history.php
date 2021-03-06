<?php

use frontend\assets\TopUpAsset;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\models\costfit\TopUp;
use common\models\costfit\User;
use jlorente\remainingcharacters\RemainingCharacters;
use kato\DropZone;

TopUpAsset::register($this);
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style type="text/css">
    .dropzone {
        position: relative;
        min-height: 284px;
        border: 3px dashed #ddd;
        border-radius: 3px;
        vertical-align: middle;
        width: 100%;
        cursor: pointer;
        padding: 0 15px 15px 0;
        -webkit-transition: all .2s;
        transition: all .2s;
    }
</style>
<div class="order-index">

    <div>
        <div class="col-lg-12 col-md-12">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'No.',
                        'value' => function($model) {
                            if ($model->topUpNo == NULL) {
                                return 'COZXY';
                            } else {
                                return $model->topUpNo;
                            }
                        }
                    ],
                    [
                        'attribute' => 'Cozxy Coins',
                        'value' => function($model) {

                            return number_format($model->point);
                        }
                    ],
                    [
                        'attribute' => 'money',
                        'value' => function($model) {

                            return number_format($model->money);
                        }
                    ],
                    [
                        'attribute' => 'updateDateTime',
                        'value' => function($model) {
                            return frontend\controllers\MasterController::dateThai($model->updateDateTime, 4);
                        }
                    ],
                    [
                        'attribute' => 'Payment Type',
                        'format' => 'raw',
                        'value' => function($model) {
                            if ($model->paymentMethod == 1) {
                                if ($model->image == NULL) {
                                    /*  return \kato\DropZone::widget([
                                      <<<<<<< HEAD
                                      //'id' => '123456',
                                      //'dropzoneContainer' => '#' . $model->topUpId,
                                      'options' => [
                                      'url' => \yii\helpers\Url::to(['upload', 'id' => $model->topUpId]),
                                      'paramName' => 'image',
                                      //'id' => $model->topUpId,
                                      =======
                                      'options' => [
                                      'url' => \yii\helpers\Url::to(['upload', 'id' => $model->topUpId]),
                                      'paramName' => 'image',
                                      'id' => $model->topUpId,
                                      >>>>>>> 10dee662f2c1ad5cd6bb9bf3b32a7f063376d4d4
                                      // 'maxFilesize' => '200',
                                      //'id' => $model->topUpId,
                                      'clickable' => true,
                                      'addRemoveLinks' => true,
                                      'enqueueForUpload' => true,
                                      //'dictDefaultMessage' => 'asdfasdfa',
                                      'dictDefaultMessage' => "<h1><i class='fa fa-cloud-upload'></i><br>Drop files in here<h1><br><span class='dz-text-small'>or click to pick manually</span>",
                                      ],
                                      'clientEvents' => [
                                      'sending' => "function(file, xhr, formData) {
                                      console.log(file);
                                      }",
                                      'complete' => "function(file){console.log(file)}",
                                      'removedfile' => "function(file){alert(file.name + ' is removed')}"
                                      ],
                                      ]); */
                                    return 'Bill payment<br><i class="fa fa-upload" aria-hidden="true"></i>'
                                            . '<a href="#" style="color:blue;font-size:9pt;" data-toggle="modal" data-target="#upload' . $model->topUpId . '">'
                                            . ' Upload payment slip </a>';
                                    /* return 'Bill payment<br><i class="fa fa-upload" aria-hidden="true"></i>'
                                      . '<a href="' . Yii::$app->homeUrl . 'top-up/upload-form?id=' . $model->topUpId . '" style="color:blue;font-size:9pt;">'
                                      . ' Upload payment slip </a>'; */
                                } else {
                                    return 'Bill payment<br><i class="fa fa-file-image-o" aria-hidden="true"></i>'
                                            . '<a href="#" style="color:blue;font-size:9pt;" data-toggle="modal" data-target="#seePic' . $model->topUpId . '"><i> Image </i></a> or ' .
                                            '<a href="#" style="color:blue;font-size:9pt;" data-toggle="modal" data-target="#upload' . $model->topUpId . '">'
                                            . ' change </a>';
                                }
                            } else if ($model->paymentMethod == 2) {
                                return 'Credit card';
                            } else {
                                if ($model->paymentMethod == 4) {
                                    return $model->description;
                                }
                            }
                        }
                    ],
                    ['attribute' => 'Type',
                        'format' => 'raw',
                        'value' => function($model) {
                            $type = '';
                            if ($model->type == 1) {
                                $type = "Top Up";
                            }
                            if ($model->type == 2) {
                                $type = "From cozxy";
                            }
                            return $type;
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function($model) {
                            if (($model->status == TopUp::TOPUP_STATUS_COMFIRM_PAYMENT) || ($model->status == TopUp::TOPUP_STATUS_COMFIRM_PAYMENT)) {
                                $customerName = User::userName($model->userId);
                                $customerTel = common\models\costfit\Address::userTel($model->userId);
                                $taxId = '0105553036789';
                                $topUpNo = $model->topUpNo;
                                $tel = str_replace("-", "", $customerTel);
                                $amount = $model->money;
                                $topUpCut = str_replace("/", "", $model->topUpNo);
                                $amount1 = str_replace(",", "", number_format($amount, 2));
                                $amount2 = str_replace(".", "", $amount1);
                                $barCode = $taxId . $topUpCut . $tel . $amount2;
                                $data = "| " . $taxId . " " . $topUpCut . " " . $tel . " " . $amount2;
                                if ($model->paymentMethod == 1) {
                                    return TopUp::statusText($model->status) . '<br>' .
                                            '<i class="fa fa-print" aria-hidden="true"></i>'
                                            . ' <a href="' . Yii::$app->homeUrl . 'top-up/print-payment-form-topdf?amount=' . $amount . '&customerName=' . $customerName . '&customerTel=' . $customerTel . '&topUpNo=' . $topUpNo . '&taxId=' . $taxId . '&barCode=' . $barCode . '&data=' . $data . '"'
                                            . 'style = "color:blue;font-size:10pt;" target="_blank">Re-print Bill payment</a>';
                                } else {
                                    return TopUp::statusText($model->status);
                                }
                            } else {
                                return TopUp::statusText($model->status);
                            }
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Bill',
                        'template' => '{view}{history}',
                        'buttons' => [
                            'view' => function( $url, $model) {
                                if ($model->status == TopUp::TOPUP_STATUS_E_PAYMENT_SUCCESS) {
                                    if ($model->type != 2) {//มาจากระบบไม่ต้องprint
                                        $topUpId = common\models\ModelMaster::encodeParams($model->topUpId);
                                        return Html::a('<span class = "btn-black btn-xs" style="padding: 2px 5px; "><i class="fa fa-print" aria-hidden="true"></i> Print</span>', ['top-up/billpay?epay=' . $topUpId], [
                                                    'target' => '_blank']
                                        );
                                    }
                                } else {
                                    return '<span style="padding: 2px 5px; "> - </span>';
                                }
                            },]
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <?php
        if (isset($topUps) && count($topUps) > 0) {
            foreach ($topUps as $topUp):
                ?>
                <div class="modal fade" id="upload<?= $topUp->topUpId ?>" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>
                                </button>
                                <h2>Upload payment slip for "<?= $topUp->topUpNo ?>"</h2>
                            </div>
                            <div class="modal-body">
                                <?php
                                $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']
                                ]);
                                /* echo \kato\DropZone::widget([
                                  'options' => [
                                  'maxFilesize' => '2',
                                  ],
                                  'clientEvents' => [
                                  'complete' => "function(file){console.log(file)}",
                                  'removedfile' => "function(file){alert(file.name + ' is removed')}"
                                  ],
                                  ]); */
                                ?>
                                <?php
                                $csrfToken = \Yii::$app->request->getCsrfToken();
                                /* echo \kato\DropZone::widget([
                                  'dropzoneContainer' => '#' . $topUp->topUpId,
                                  'options' => [
                                  'url' => \yii\helpers\Url::to(['upload', 'id' => $topUp->topUpId]),
                                  'paramName' => 'image',
                                  // 'maxFilesize' => '200',
                                  'clickable' => true,
                                  'addRemoveLinks' => true,
                                  'enqueueForUpload' => true,
                                  //'dictDefaultMessage' => 'asdfasdfa',
                                  'dictDefaultMessage' => "<h1><i class='fa fa-cloud-upload'></i><br>Drop files in here<h1><br><span class='dz-text-small'>or click to pick manually</span>",
                                  ],
                                  'clientEvents' => [
                                  'sending' => "function(file, xhr, formData) {
                                  console.log(file);
                                  }",
                                  'complete' => "function(file){console.log(file)}",
                                  'removedfile' => "function(file){alert(file.name + ' is removed')}"
                                  ],
                                  ]); */
                                ?>

                                <div class="form-group text-center" style="width:100%;height: 100px;border: #ffcc00 solid 0.5px;padding: 10px;color:#000;">
                                    <div id="ImgPreview"></div>
                                    <input type="file" id="inputImg" name="slipUpload[image]" class="btn btn-lg btn-warning"style="width: 525px;font-size: 10pt;height:75px"  required="true">
                                    <input type="hidden" name="topUpId" value="<?= $topUp->topUpId ?>">
                                </div>
                                <div class="form-group text-center">
                                    <?= yii\helpers\Html::submitButton('Upload', ['class' => 'btn btn-black', 'name' => 'Upload-button']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            <?php endforeach; ?>

        <?php }
        ?>
        <?php
        if (isset($topUps) && count($topUps) > 0) {
            foreach ($topUps as $topUp):
                ?>
                <div class="modal fade" id="seePic<?= $topUp->topUpId ?>" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                                <h3><?= $topUp->topUpNo ?></h3>
                            </div>
                            <div class="modal-body" style="padding-left: 120px;">
                                <img src="<?= $baseUrl . '/' . $topUp->image ?>" style="width:300px;height: 400px;">
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            <?php endforeach; ?>

            <?php
        }
        ?>