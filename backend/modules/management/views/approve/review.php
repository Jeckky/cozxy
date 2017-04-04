<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Suppliers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<h1>approve/index</h1>
<style type="text/css">
    .switcher {
        margin-left: 12px;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-sm-12" style="margin-top: 20px;">
        <?php
        $form = ActiveForm::begin([
            //'action' => '#',
            'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-9">{input}</div>',
                'labelOptions' => [
                    'class' => 'col-sm-3 control-label  '
                ]
            ]
        ]);
        ?>
        <div class="row form-group" style="margin-top: 10px; padding: 10px;">
            <label class="col-sm-2 control-label text-right">ค้นหา Suppliers:</label>
            <div class="col-sm-10">
                <?php
                //echo '<label class="control-label">Provinces</label>';
                echo kartik\select2\Select2::widget([
                    'name' => 'userId',
                    // 'value' => ['THA'], // initial value
                    'data' => yii\helpers\ArrayHelper::map(common\models\costfit\User::find()->where('type =4')->all(), 'userId', 'username'),
                    'options' => ['placeholder' => 'Select or Search User Suppliers ...', 'id' => 'userSuppliers', 'onchange' => 'this.form.submit()'], //, 'onchange' => 'this.form.submit()'
                    'pluginOptions' => [
                        'tags' => true,
                        'placeholder' => 'Select or Search ...',
                        'loadingText' => 'Loading User Suppliers ...',
                        'initialize' => true,
                    ],
                ]);
                ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <hr>
    <div class="col-sm-12" style="margin-top:5px;">
        <!-- 5. $DEFAULT_TABS =============== Default tabs =============================  -->
        <div class="panel" style="border: 0px solid transparent;">
            <div class="panel-body" style="padding: 5px;">
                <ul id="uidemo-tabs-default-demo" class="nav nav-tabs">
                    <?= $this->render('menu', compact('pending', 'review', 'modify', 'approved', 'pending')) ?>
                </ul>

                <div class="tab-content tab-content-bordered">
                    <div class="tab-pane fade active in" id="uidemo-tabs-default-demo-modify">
                        coming soon ..
                    </div>
                </div> <!-- / .tab-content -->
            </div>
        </div>
        <!-- /5. $DEFAULT_TABS -->
    </div>
</div>


<!-- 5. $SWITCHERS =============== Switchers ===============-->
<!-- Javascript -->
<script>

    init.push(function () {
        $('#switchers-colors-square > input').switcher(function (e, data) {

        });
        //alert(switcherEl.switcher('setValue', true));
        //console.log($('#switchers-colors-square').switcher({}));
    });

</script>
<!-- / Javascript -->

<!-- 5. $DEFAULT_MODAL ===================Default modal============================= -->
<!-- Modal -->
<div id="myModal-investigate-approve" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal View Product</h4>
            </div>
            <div class="modal-body">
                <!--<h4>Text in a modal</h4>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                <hr>-->
                <table id="w0" class="table table-striped table-bordered detail-view">
                    <tbody>
                        <tr>
                            <th>Product ID</th>
                            <td class="view-product-id">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>User ID</th>
                            <td class="view-user-id">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Product Group ID</th>
                            <td class="view-product-group-id">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Brand ID</th>
                            <td class="view-brand-id">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Category ID</th>
                            <td class="view-category-id">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Isbn</th>
                            <td class="view-isbn">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Code</th>
                            <td class="view-code">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td class="view-title">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Option Name</th>
                            <td class="view-option-name">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td class="view-short-description">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td class="view-description">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Specification</th>
                            <td class="view-specification">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Width</th>
                            <td class="view-width">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Height</th>
                            <td class="view-height">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Depth</th>
                            <td class="view-depth">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Weight</th>
                            <td class="view-weight">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td class="view-price">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Unit</th>
                            <td class="view-unit">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Small Unit</th>
                            <td class="view-small-unit">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Tags</th>
                            <td class="view-tags">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Create Date Time</th>
                            <td class="view-create-date-time">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Update Date Time</th>
                            <td class="view-update-date-time">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12" ><h5><strong>1.Image( Size 553px X 484px)) </strong></h5>
                        <div class="view-image-s1" style="padding: 10px;">&nbsp;</div>
                    </div>
                    <br><br>
                    <div class="col-sm-12"><h5><strong>2.Image Thumbnail1( Size 356px X 390px)) </strong></h5>
                        <div class="view-thumbnail1-s1" style="padding: 10px;">&nbsp;</div>
                    </div>
                    <div class="col-sm-12"><h5><strong>3.Image Thumbnail2( Size 137px X 130px) </strong></h5>
                        <div class="view-thumbnail2-s1" style="padding: 10px;">&nbsp;</div>
                    </div>
                </div>

            </div> <!-- / .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- /.modal -->
<!-- / Modal -->
<script>
    /*
     init.push(function () {
     $('#jq-growl-default').click(function () {
     $.growl({title: "Growl", message: "The kitten is awake!"});
     });
     $('#jq-growl-error').click(function () {
     $.growl.error({message: "The kitten is attacking!"});
     });
     $('#jq-growl-notice').click(function () {
     $.growl.notice({message: "The kitten is cute!"});
     });
     $('#jq-growl-warning').click(function () {
     $.growl.warning({message: "The kitten is ugly!"});
     });
     $('#jq-growl-small').click(function () {
     $.growl({title: "Growl", message: "The kitten is awake!", size: 'small'});
     });
     $('#jq-growl-large').click(function () {
     $.growl({title: "Growl", message: "The kitten is awake!", size: 'large'});
     });
     $('#jq-growl-static').click(function () {
     $.growl({title: "Growl", message: "The kitten is awake!", duration: 9999 * 9999});
     });
     });*/
</script>
<!--
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">jQuery Growl notifications</span>
    </div>
    <div class="panel-body buttons-with-margins">
        <button id="jq-growl-default" class="btn">Default</button>&nbsp;&nbsp;&nbsp;
        <button id="jq-growl-error" class="btn btn-danger">Error</button>&nbsp;&nbsp;&nbsp;
        <button id="jq-growl-notice" class="btn btn-success">Notice</button>&nbsp;&nbsp;&nbsp;
        <button id="jq-growl-warning" class="btn btn-warning">Warning</button>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;

        <button id="jq-growl-small" class="btn">Small</button>&nbsp;&nbsp;&nbsp;
        <button id="jq-growl-large" class="btn">Large</button>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;

        <button id="jq-growl-static" class="btn">Static</button>&nbsp;&nbsp;&nbsp;
    </div>
</div>
-->