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
<style type="text/css">
    .row {
        margin-left: 11px;
        margin-right: 11px;
    }
</style>
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
                        'options' => ['class' => 'form-horizontalx', 'enctype' => 'multipart/form-data'],
                    ]);
                    ?>

                    <div class ="col-sm-4">
                        <?= $form->field($model, 'firstname', ['options' => ['class' => 'row form-group ']])->textInput(['maxlength' => 200, 'value' => isset($_POST["User"]['firstname']) ? $_POST["User"]['firstname'] : ''])->label('ชื่อ') ?>
                    </div>
                    <div class ="col-sm-4">
                        <?= $form->field($model, 'lastname', ['options' => ['class' => 'row form-group ']])->textInput(['maxlength' => 200, 'value' => isset($_POST["User"]['lastname']) ? $_POST["User"]['lastname'] : ''])->label('นามสกุล') ?>
                    </div>
                    <div class ="col-sm-4">
                        <?= $form->field($model, 'email', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200, 'value' => isset($_POST["User"]['email']) ? $_POST["User"]['email'] : ''])->label('email') ?>
                    </div>
                    <div class ="col-sm-4">
                        <?=
                        Html::dropDownList("User[type]", isset($_POST["User"]['type']) ? $_POST["User"]['type'] : NULL, ['0' => 'All Type', '1' => 'Frontend', '2' => 'Backend', '3' => 'Frontend and Backend'], ['class' => 'row form-control'], ['options' =>
                            [
                            //$_POST["User"]['type'] => ['selected' => true]
                            ]
                        ])
                        ?>
                    </div>
                    <div class =" col-sm-4">
                        <?php
                        echo $form->field($authAssignment, 'item_name')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => ['ALL Group' => 'All Group', 'Group List' => $authItems],
                            'options' => [
                            //'placeholder' => 'Select role group ...',
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => FALSE,
                            ],
                        ])->label(FALSE);
                        ?>
                    </div>
                    <div class ="col-sm-12"><br>
                        &nbsp;&nbsp;&nbsp;<button type="submit" class="btn"><i class="fa fa-search"></i> ค้นหา</button>
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
                    //
                    //'password_hash:ntext',
                    'firstname',
                    //
                    'password',
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
//                            $getUserGroup = common\models\costfit\UserGroups::checkUserGroup($model->user_group_Id);
//                            return $getUserGroup['name'];
                            //echo '<pre>';
                            //print_r($model->roles);
                            // Get table : auth_assignment
                            $roles = [];
                            foreach ($model->roles as $role) {
                                $roles[] = $role->item_name;
                            }
                            return Html:: a(implode(', ', $roles), [ 'view', 'id' => $model->userId, 'tab' => 3, 'page' => isset($_GET["page"]) ? $_GET["page"] : 1]);
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
                            $margin = \common\models\costfit\Margin:: getSupplierMargin($model->userId, TRUE);
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
                                return Html::a('<i class="fa fa-pencil"></i> ตั้งค่าสมาชิก', [ 'view', 'id' => $model->userId, 'page' => isset($_GET["page"]) ? $_GET["page"] : 1], [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                            'address' => function ($url, $model) {
                                if ($model->type == 4) {
                                    return "<br>" . Html::a('<i class="fa fa-home"></i> ที่อยู่ suppliers', Yii::$app->homeUrl . "management/address/?userId=" . $model->userId, [
                                        'title' => Yii ::t('app', 'สถานที่'), 'class' => 'text-center']);
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
