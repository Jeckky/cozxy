<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
                            if ($model->lastvisitDate == '0000-00-00 00:00:00') {
                                return '';
                            } else {
                                return $this->context->dateThai($model->lastvisitDate, 1, TRUE);
                            }
                        }
                    ], /*
                      [
                      'attribute' => 'createDateTime',
                      'format' => 'raw',
                      'value' => function($model) {
                      return $this->context->dateThai($model->createDateTime, 1, TRUE);
                      }
                      ], */
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {address}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-pencil"></i> ตั้งค่าสมาชิก', $url, [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                            'address' => function ($url, $model) {
                                if ($model->type == 4) {
                                    return Html::a('<i class="fa fa-pencil"></i> สถานที่', Yii::$app->homeUrl . "management/address/?userId=" . $model->userId, [
                                        'title' => Yii::t('app', 'สถานที่'), 'class' => 'text-center']);
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
