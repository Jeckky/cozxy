<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use leandrogehlen\treegrid\TreeGrid;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="user-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">สมาชิก: แก้ไขข้อมูลส่วนตัว</span>
            <div class="panel-heading-controls">

            </div> <!-- / .panel-heading-controls -->
        </div> <!-- / .panel-heading -->
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">

                        <!-- Pills -->
                        <ul class="nav nav-pills bs-tabdrop-example">
                            <li class="active"><a href="#bs-tabdrop-pill1" data-toggle="tab">รายละเอียด</a></li>
                            <li><a href="#bs-tabdrop-pill2" data-toggle="tab">เข้าอยู่ในกลุ่ม</a></li>
                            <li><a href="#bs-tabdrop-pill3" data-toggle="tab">ตั้งค่าพื้นฐาน</a></li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="bs-tabdrop-pill1">
                                <p><?php
                                    //echo '<pre>';
                                    //print_r($model);
                                    ?>
                                    <?=
                                    DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'userId',
                                            'username',
                                            //'password_hash:ntext',
                                            'firstname',
                                            // 'password',
                                            'lastname',
                                            'email:email',
                                            //'token:ntext',
                                            [
                                                'attribute' => 'กลุ่มทำงาน',
                                                'format' => 'raw',
                                                'value' => $model->type,
                                            ],
                                            //'auth_key:ntext',
                                            //'auth_type',
                                            [
                                                'attribute' => 'สมัครสมาชิกผ่านช่องทางของ',
                                                'format' => 'raw',
                                                'value' => $model->auth_type
                                            ],
                                            'birthDate:date',
                                            //'gender',
                                            [
                                                'attribute' => 'เพศ',
                                                'format' => 'raw',
                                                'value' => $model->getGenderText($model->gender)
                                            ],
                                            'tel',
                                            //'status',
                                            [
                                                'attribute' => 'สถานะ',
                                                'format' => 'raw',
                                                'value' => $model->getStatusText($model->status)
                                            ],
                                            //'createDateTime',
                                            [
                                                'attribute' => 'createDateTime',
                                                'format' => 'raw',
                                                'value' => Yii::$app->formatter->asDate($model->createDateTime) . ' ' . Yii::$app->formatter->asTime($model->createDateTime)
                                            ],
                                            [
                                                'attribute' => 'updateDateTime',
                                                'format' => 'raw',
                                                'value' => Yii::$app->formatter->asDate($model->updateDateTime) . ' ' . Yii::$app->formatter->asTime($model->updateDateTime)
                                            ],
                                        //'updateDateTime',
                                        ],
                                    ])
                                    ?>
                                </p>
                            </div>
                            <div class="tab-pane" id="bs-tabdrop-pill2">

                                <?php
                                $form = ActiveForm::begin([
                                    'id' => 'default-shipping-address',
                                    'action' => $baseUrl . '/management/user/group',
                                    'options' => ['class' => 'space-bottom'],
                                ]);
                                ?>
                                <?=
                                TreeGrid::widget([
                                    'dataProvider' => $listViewLevels,
                                    'keyColumnName' => 'user_group_Id',
                                    'parentColumnName' => 'parent_id',
                                    'parentRootValue' => '0', //first parentId value
                                    'pluginOptions' => [
                                    //'initialState' => 'collapsed',
                                    ],
                                    'columns' => [
                                        [
                                            'attribute' => 'เลือกกลุ่มที่เข้าใช้งาน',
                                            'format' => 'raw',
                                            'value' => function($data) {
                                                return '<input type="checkbox" name="ViewLevels[user_group_Id][]" class"px" value="' . $data->user_group_Id . '" /> &nbsp;' . $data->name;
                                            },
                                        ],
                                    // 'name',
                                    //'user_group_Id',
                                    //'parent_id',
                                    //['class' => 'yii\grid\ActionColumn']
                                    ]
                                ]);
                                ?>
                                <?php
                                echo Html::hiddenInput('user-group-userId', $model->userId, ['id' => 'user-group-userId']);
                                echo Html::submitButton('submit', ['class' => 'btn btn-primary', 'name' => 'btn-shipping-address'])
                                ?>
                                <?php
                                ActiveForm::end();
                                ?><br>
                                <div class="note note-info padding-xs-vr">
                                    <strong>อธิบาย</strong><br>
                                    - กำหนดสิทธ์เข้าใช้งานของแต่ละเมนู
                                </div>
                            </div>
                            <div class="tab-pane" id="bs-tabdrop-pill3">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <span class="panel-title">สิทธิ์การเข้าใช้งาน Cozxy.com</span>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        $form = ActiveForm::begin([
                                            'id' => 'default-shipping-address',
                                            'action' => $baseUrl . '/management/user/access',
                                            'options' => ['class' => 'space-bottom'],
                                        ]);
                                        ?>
                                        <div class="form-group">

                                            <div class="col-sm-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="radio"  name="jq-validation-radios" class="px" value="1" <?php
                                                        if ($model->type == 1) {
                                                            echo "checked";
                                                        }
                                                        ?>> <span class="lbl">Frontend</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="radio" name="jq-validation-radios" class="px" value="2" <?php
                                                        if ($model->type == 2) {
                                                            echo "checked";
                                                        }
                                                        ?>> <span class="lbl">Backend</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="radio" name="jq-validation-radios" class="px" value="3" <?php
                                                        if ($model->type == 3) {
                                                            echo "checked";
                                                        }
                                                        ?>> <span class="lbl">Frontend and Backend</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        echo Html::hiddenInput('access-userId', $model->userId, ['id' => 'access-userId']);
                                        echo Html::submitButton('submit', ['class' => 'btn btn-primary', 'name' => 'btn-shipping-address'])
                                        ?>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
