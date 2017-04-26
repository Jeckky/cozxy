<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตั้งค่า การใช้งานของ User';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="user-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create User', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">Search</div>
                    </div>
                </div>
                <div class="panel-body">
                    <?php
                    $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
                    ]);
                    ?>
                    <div class = "input-append col-lg-4">
                    <!--<input type = "text" class = "search-query" placeholder = "Search"> -->
                        <?= Html::dropDownList("type", isset($_POST["type"]) ? $_POST["type"] : NULL, ['0' => 'All', '1' => 'Frontend', '2' => 'Backend', '3' => 'Frontend and Backend', '4' => 'Suppliers', '5' => 'Content'], ['class' => 'form-control'])
                        ?>

                    </div>
                    <div class="col-lg-8">
                        <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>

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
                    'userId',
                    'username',
                    //'password_hash:ntext',
                    'firstname',
                    //'password',
                    'lastname',
                    // 'email:email',
                    // 'token:ntext',
                    [
                        'attribute' => 'type',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $model->getTypeText($model->type);
                        },
                    ],
                    [
                        'attribute' => 'group',
                        'format' => 'raw',
                        'value' => function($model) {
                            //return $model->user_group_Id;
                            $getUserGroup = common\models\costfit\UserGroups::checkUserGroup($model->user_group_Id);
                            return $getUserGroup['name'];
                        },
                    ],
                    // 'auth_key:ntext',
                    // 'auth_type',
                    // 'birthDate',
                    // 'gender',
                    // 'tel',
                    //'status',ยืนยันใช้งาน
                    ['attribute' => 'Magin',
                        'format' => 'raw',
                        'value' => function($model) {
                            $margin = \common\models\costfit\Margin::getSupplierMargin($model->userId, TRUE);
                            if (isset($margin)) {
                                return $margin . " %";
                            } else {
                                if ($model->type == 4) {
                                    return "<span class='label label-danger'>Not Set</span>";
                                } else {
                                    return "";
                                }
                            }
                        }
                    ],
                    ['attribute' => 'status',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $model->getStatusText($model->status);
                        }
                    ],
                    //'createDateTime',
                    //'updateDateTime',
                    [
                        'attribute' => 'เข้าใช้งานล่าสุด',
                        'format' => 'raw',
                        'value' => function($model) {
                            //if ($model->lastvisitDate == '0000-00-00 00:00:00') {
                            //return '';
                            // } else {
                            //return $this->context->dateThai($model->lastvisitDate, 1, TRUE);
                            return $model->lastvisitDate;
                            //}
                        }
                    ], /*
                     *
                      [
                      'attribute' => 'createDateTime',
                      'format' => 'raw',
                      'value' => function($model) {
                      return $this->context->dateThai($model->createDateTime, 1, TRUE);
                      }
                      ], */
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {address} {margin}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-pencil"></i> ตั้งค่าสมาชิก', $url, [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                            'address' => function ($url, $model) {
                                if ($model->type == 4) {
                                    return "<br>" . Html::a('<i class="fa fa-home"></i> ที่อยู่ suppliers', Yii::$app->homeUrl . "management/address/?userId=" . $model->userId, [
                                        'title' => Yii::t('app', 'สถานที่'), 'class' => 'text-center']);
                                }
                            },
                            'margin' => function ($url, $model) {
                                if ($model->type == 4) {
                                    return "<br>" . Html::a('<i class="fa fa-dollar"></i> Margin', Yii::$app->homeUrl . "management/user/margin?supplierId=" . $model->userId, [
                                        'title' => Yii::t('app', 'ผลกำไร'), 'class' => 'text-center']);
                                }
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                    'title' => Yii::t('yii', 'update'),
                                ]);
                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
