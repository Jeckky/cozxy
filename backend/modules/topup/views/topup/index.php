<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\costfit\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bill payment Top up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topup-index">
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
        </div>

        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
            ]);
            ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="vertical-align: middle;text-align: center;"><h4><b>Upload file .xls,csv : </b></h4></th>
                        <td>
                            <input class="btn btn-lg btn-warning" type="file" name="fileCsv[csv]" value="Upload" style="float: left;" required="true">
                            <input type="hidden" name="fileCsv[csv]" value="">
                            &nbsp;&nbsp;&nbsp;<button  class="btn btn-lg btn-primary" type="submit">Update</button>
                            <input type="hidden" name="check" value="update">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php ActiveForm::end(); ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                        'attribute' => 'User',
                        'format' => 'raw',
                        'value' => function($model) {
                            return User::userName($model->userId);
                        }
                    ],
                        [
                        'attribute' => 'Point',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $model->point;
                        }
                    ],
                        [
                        'attribute' => 'Money',
                        'format' => 'raw',
                        'value' => function($model) {
                            return number_format($model->money, 2);
                        }
                    ],
                        [
                        'attribute' => 'Date Time',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $this->context->dateThai($model->createDateTime, 2);
                        }
                    ],
                        [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function($model) {
                            return 'กำลังชำระเงิน';
                        }
                    ],
                // 'updateDateTime',
                //  ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
<?php
if (isset($data)) {
    ?>
    <table width="600" border="1">
        <tr>

            <th width="91"> <div align="center">CustomerID </div></th>

            <th width="98"> <div align="center">Name </div></th>

            <th width="198"> <div align="center">Email </div></th>

            <th width="97"> <div align="center">CountryCode </div></th>

            <th width="59"> <div align="center">Budget </div></th>

            <th width="71"> <div align="center">Used </div></th>

        </tr>
        <?php
        throw new \yii\base\Exception(print_r($data, true));
        foreach ($data as $a):
        ?>

        <?php endforeach;
        ?>
    </table>

<?php } ?>