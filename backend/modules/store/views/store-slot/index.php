<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Slots';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="store-slot-index">

    <?php
    $msg = "111";
    //QRcode::png('code data text', Yii::$app->homeUrl . 'images/qr' . $msg . '.png'); // creates file
    ?>

    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?php if (isset($_GET['storeId'])): ?>
                            <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Store Slot', ['create?storeId=' . $_GET["storeId"]], ['class' => 'btn btn-success btn-xs']) ?>
                        <?php else: ?>
                            <?php if (isset($_GET['parentId'])): ?>
                                <?php if (isset($_GET['level'])): ?>
                                    <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Store Slot', ['create?parentId=' . $_GET["parentId"] . "&level=" . $_GET["level"]], ['class' => 'btn btn-success btn-xs']) ?>
                                <?php else: ?>
                                    <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Store Slot', ['create?parentId=' . $_GET["parentId"]], ['class' => 'btn btn-success btn-xs']) ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
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
                    'storeSlotId',
                    'storeId',
                    'barcode',
//                    [
//                        'attribute' => 'barcode',
//                        'value' => function($model) {
//                            return QrCode::png($model->barcode);
//                        }
//                    ],
                    'code',
                    'title',
                    'description:ntext',
                    // 'width',
                    // 'height',
                    // 'depth',
                    // 'weight',
                    // 'maxWeight',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete} {column} {slot}',
                        'buttons' => [
                            'column' => function($url, $model) {
                                if ($model->level == 1)
                                    return Html::a('<br><u>Column</u>', ['/store/store-slot', 'parentId' => $model->storeSlotId, 'level' => 2], [
                                                'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                                    'slot' => function($url, $model) {
                                if ($model->level == 2)
                                    return Html::a('<br><u>Slot</u>', ['/store/store-slot', 'parentId' => $model->storeSlotId, 'level' => 3], [
                                                'title' => Yii::t('app', 'Change today\'s lists'),]);
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
