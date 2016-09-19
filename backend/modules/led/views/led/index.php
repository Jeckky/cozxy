<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="led-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <?php
                $form = ActiveForm::begin(['method' => 'GET']);
                ?>
                <div class="col-lg-2"><h3><?= $this->title ?></h3></div>
                <div class="col-lg-1 text-right" style="margin-top: 5px;">Led Start </div>
                <div class="col-lg-1"><?=
                    $form->field($model, 'start')->textInput([
                        'value' => isset($_GET['start']) ? $_GET['start'] : NULL])->label(false)
                    ?></div>
                <div class="col-lg-1 text-right" style="margin-top: 5px;">Led End </div>
                <div class="col-lg-1"><?= $form->field($model, 'end')->textInput([
                        'value' => isset($_GET['end']) ? $_GET['end'] : NULL])->label(false)
                    ?></div>
                <div class="col-lg-1 text-right" style="margin-top: 5px;">Start Ip :
                </div><div class="col-lg-3"><?= $form->field($model, 'ip')->textInput([
                        'value' => isset($_GET['ip']) ? $_GET['ip'] : NULL])->label(false)
                    ?></div>
                <div class="col-lg-2">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"> Create</i></button>

                        <?//= Html::a('Create Led', ['create'], ['class' => 'btn btn-success']) ?>                    </div>
                </div>
<?php ActiveForm::end(); ?>
            </div>  <?php if (isset($_GET['msg']) && $_GET['msg'] != '') { ?>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">

                        <code><?= $_GET['msg'] ?></code>

                    </div>
                </div><?php }
?>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'ledId',
                    'code',
                    'ip',
                    'slot',
                    'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{led}{update}{delete}',
                        'buttons' => [

                            'led' => function ($url, $model) {

                                return Html::a('<span class="btn btn-xs btn-warning " style="margin-left: 5px;
            ">LED</span>', '../led/led-item?id=' . $model->ledId);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<span class="btn btn-xs btn-success" style="margin-left: 5px;
            " >Edit</span>', 'led/update?id=' . $model->ledId);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="btn btn-xs btn-danger" style="margin-left: 5px;
            " >Delete</span>', 'led/delete?id=' . $model->ledId, ['data-confirm' => 'Are you sure?']);
                            },
                                ],
                            ],
                        ],
                    ]);
                    ?>
        </div>
    </div>
</div>
