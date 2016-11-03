<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use leandrogehlen\treegrid\TreeGrid;
?>
<h1>settings/index</h1>
<div id="content-wrapper">
    <div class="row">
        <div class="panel ">
            <div class="panel-heading ">
                <span class="panel-title">Default ตั้งค่าเมนู</span>
            </div>
            <div class="panel-body">
                <div class="col-md-3">

                    <div class="panel panel-default panel-dark panel-body-colorful widget-profile widget-profile-centered">
                        <div class="panel-heading">
                            <div class="widget-profile-header">
                                <a href="<?php echo Yii::$app->homeUrl; ?>management/user" class="btn" style="color: #000;"> <i class="fa fa-tasks list-group-icon text-danger"></i> Settings User </a><br>
                            </div>
                        </div> <!-- / .panel-heading -->
                        <div class="panel-body text-left">
                            <div class="widget-profile-text" style="padding: 0;">
                                <p class="text-success">อธิบาย</p>
                                - ตั้งค่า การใช้งานของ สมาชิก
                            </div>
                        </div>
                    </div> <!-- / .panel -->
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default panel-dark panel-body-colorful widget-profile widget-profile-centered">
                        <div class="panel-heading">
                            <!--<img src="assets/demo/avatars/1.jpg" alt="" class="widget-profile-avatar">-->
                            <div class="widget-profile-header">
                                <a href="<?php echo Yii::$app->homeUrl; ?>management/user-groups"  class="btn"  style="color: #000;"> <i class="fa fa-tasks list-group-icon text-danger"></i> Settings User Groups </a><br>
                            </div>
                        </div> <!-- / .panel-heading -->
                        <div class="panel-body text-left">
                            <div class="widget-profile-text" style="padding: 0;">
                                <p class="text-success">อธิบาย</p>
                                - ตั้งค่า การใช้งานของ กลุ่ม
                                <?//=
                                TreeGrid::widget([
                                'dataProvider' => $listUserGroups,
                                'keyColumnName' => 'user_group_Id',
                                'parentColumnName' => 'parent_id',
                                'parentRootValue' => '0', //first parentId value
                                'pluginOptions' => [
                                //'initialState' => 'collapsed',
                                ],
                                'columns' => [
                                [
                                'attribute' => 'name',
                                'format' => 'raw',
                                'value' => function($data) {
                                return '<span class="text-muted">' . $data->name . '</span>';
                                },
                                ],
                                ]
                                ]);
                                ?>
                            </div>
                        </div>
                    </div> <!-- / .panel -->
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default panel-dark panel-body-colorful widget-profile widget-profile-centered">
                        <div class="panel-heading">
                            <!--<img src="assets/demo/avatars/1.jpg" alt="" class="widget-profile-avatar">-->
                            <div class="widget-profile-header">
                                <a href="<?php echo Yii::$app->homeUrl; ?>management/view-levels"  class="btn"  style="color: #000;"> <i class="fa fa-tasks list-group-icon text-danger"></i> Settings Viewing Access Levels </a><br>

                            </div>
                        </div> <!-- / .panel-heading -->
                        <div class="panel-body text-left">
                            <div class="widget-profile-text" style="padding: 0;">
                                <p class="text-success">อธิบาย</p>
                                - ตั้งค่า ระดับการเข้าถึง
                                <?//=
                                GridView::widget([
                                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                                'dataProvider' => $listViewLevels,
                                'pager' => [
                                //'options' => ['class' => 'pagination pagination-xs']
                                ],
                                'options' => [
                                'class' => 'table-light'
                                ],
                                'columns' => [
                                [
                                'attribute' => 'title',
                                'format' => 'raw',
                                'value' => function($data) {
                                return '<span class="text-muted">' . $data->title . '</span>';
                                },
                                ],
                                ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div> <!-- / .panel -->
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default panel-dark panel-body-colorful widget-profile widget-profile-centered">
                        <div class="panel-heading">

                            <div class="widget-profile-header ">
                                <a href="<?php echo Yii::$app->homeUrl; ?>management/menu"  class="btn"  style="color: #000;"> <i class="fa fa-tasks list-group-icon text-danger"></i> Settings Viewing Menu Backend   </a><br>

                            </div>
                        </div> <!-- / .panel-heading -->
                        <div class="panel-body text-left">
                            <div class="widget-profile-text" style="padding: 0;">
                                <p class="text-success">อธิบาย</p>
                                - ตั้งค่า การใช้งานของ Menu Backend
                            </div>
                        </div>
                    </div> <!-- / .panel -->
                </div>

            </div>
        </div>



    </div> <!-- / .row -->
</div> <!-- / #content-wrapper -->