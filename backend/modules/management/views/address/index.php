<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Addresses';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="address-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Address', ['create?userId=' . $_GET["userId"]], ['class' => 'btn btn-success btn-xs']) ?>
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
                    'addressId',
                    //'userId',
                    //'firstname',
                    //'lastname',
                    'company',
                    'tax',
                    //'address:ntext',
                    [ // รวมคอลัมน์
                        'label' => 'address',
                        'format' => 'html',
                        'value' => function($model, $key, $index, $column) {
                            $address = $model->address;
                            $countryId = isset($model->countryId) ? $model->countries->localName : NULL;
                            $province = isset($model->state) ? $model->state->localName : NULL;
                            $amphur = isset($model->citie) ? $model->citie->localName : NULL;
                            $districtId = isset($model->district) ? $model->district->localName : NULL;
                            return '<i class="fa fa-home"></i> ' . $address . '<br>'
                            . '&nbsp;<i class="fa fa-dot-circle-o"></i> ประเทศ' . $countryId . '<br>'
                            . '&nbsp;<i class="fa fa-dot-circle-o"></i>  ' . $province . '<br>'
                            . '&nbsp;<i class="fa fa-dot-circle-o"></i>  ' . $amphur . '<br>'
                            . '&nbsp;<i class="fa fa-dot-circle-o"></i>  ' . $districtId . '<br>'
                            . '&nbsp;<i class="fa fa-dot-circle-o"></i>  รหัสไปรษณีย์ ' . $model->zipcode . '<br>';
                        }
                    ],
                    //'zipcode',
                    // 'tel',
                    // 'type',
                    // 'isDefault',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    // 'longitude',
                    // 'latitude',
                    // 'email:email',
                    'fax',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', $url, [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                    'title' => Yii::t('yii', 'update'),
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                    'data-method' => 'post',
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
