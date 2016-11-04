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
                        <?//= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create User', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
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
                        'attribute' => 'กลุ่มทำงาน',
                        'format' => 'raw',
                        'value' => function($data) {
                            if ($data->type == 1) {
                                return 'เว็บไซต์เท่านั่น';
                            } else {
                                return 'เว็บไซต์ ,' . $data->type;
                            }
                        },
                    ],
                    // 'auth_key:ntext',
                    // 'auth_type',
                    // 'birthDate',
                    // 'gender',
                    // 'tel',
                    //'status',ยืนยันใช้งาน
                    ['attribute' => 'ยืนยันใช้งาน',
                        'value' => function($model) {
                            return $model->getStatusText($model->status);
                        }
                    ],
                    //'createDateTime',
                    //'updateDateTime',
                    [
                        'attribute' => 'createDateTime',
                        'format' => 'raw',
                        'value' => function($model) {
                            return Yii::$app->formatter->asDate($model->createDateTime) . ' ' . Yii::$app->formatter->asTime($model->createDateTime);
                        }
                    ],
                    [
                        'attribute' => 'updateDateTime',
                        'format' => 'raw',
                        'value' => function($model) {
                            return Yii::$app->formatter->asDate($model->updateDateTime) . ' ' . Yii::$app->formatter->asTime($model->updateDateTime);
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view}   ',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('ตั้งค่าสมาชิก', $url, [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
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
