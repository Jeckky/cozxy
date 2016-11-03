<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use leandrogehlen\treegrid\TreeGrid;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
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
                                <p>
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
                                            'type',
                                            //'auth_key:ntext',
                                            'auth_type',
                                            'birthDate',
                                            'gender',
                                            'tel',
                                            'status',
                                            'createDateTime',
                                            'updateDateTime',
                                        ],
                                    ])
                                    ?>
                                </p>
                            </div>
                            <div class="tab-pane" id="bs-tabdrop-pill2">
                                <p>
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
                                                    return '<input type="checkbox" name="ViewLevels[user_group_Id][]" value="' . $data->user_group_Id . '" /> &nbsp;' . $data->name;
                                                },
                                            ],
                                        // 'name',
                                        //'user_group_Id',
                                        //'parent_id',
                                        //['class' => 'yii\grid\ActionColumn']
                                        ]
                                    ]);
                                    ?>

                                </p>
                            </div>
                            <div class="tab-pane" id="bs-tabdrop-pill3">
                                <p>Howdy, I'm in Section 3.</p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
