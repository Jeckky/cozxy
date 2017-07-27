<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title; // Profiel/index

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
?>

<div class="theme-default main-menu-animated page-profile">

    <script>var init = [];</script>
    <div id="content-wrapper">
        <!-- 5. $PROFILE ==========================  Profile =========================================  -->
        <div class="profile-full-name">
            <span class="text-semibold"><?php echo isset(Yii::$app->user->identity->firstname) ? Yii::$app->user->identity->firstname : 'ไม่ได้ระบุ'; ?>&nbsp;<?php echo isset(Yii::$app->user->identity->lastname) ? Yii::$app->user->identity->lastname : 'ไม่ได้ระบุ'; ?></span>'s profile
        </div>
        <div class="profile-row">
            <div class="left-col">
                <div class="profile-block">
                    <div class="panel profile-photo">
                        <?php
                        //echo 'gender :: ' . Yii::$app->user->identity->gender;
                        if (Yii::$app->user->identity->gender == 0) {
                            ?>
                            <img src="<?php echo $directoryAsset ?>/demo/avatars/female.jpg" alt="">
                        <?php } elseif (Yii::$app->user->identity->gender == 1) { ?>
                            <img src="<?php echo $directoryAsset ?>/demo/avatars/silhouette.jpg" alt="">
                        <?php } ?>
                    </div><br>
                    <a href="#" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Following</a>&nbsp;&nbsp;
                    <a href="#" class="btn"><i class="fa fa-comment"></i></a>
                </div>

                <div class="panel panel-transparent">
                    <div class="panel-heading">
                        <span class="panel-title">About me</span>
                    </div>
                    <div class="panel-body">
                        &nbsp;
                    </div>
                </div>

                <div class="panel panel-transparent">
                    <div class="panel-heading">
                        <span class="panel-title">Statistics</span>
                    </div>
                    <div class="list-group">
                        <!--
                        <a href="#" class="list-group-item"><strong>126</strong> Likes</a>
                        <a href="#" class="list-group-item"><strong>579</strong> Followers</a>
                        <a href="#" class="list-group-item"><strong>100</strong> Following</a>
                        -->
                    </div>
                </div>

                <div class="panel panel-transparent profile-skills">
                    <div class="panel-heading">
                        <span class="panel-title">Skills</span>
                    </div>
                    <div class="panel-body">
                        <!--
                        <span class="label label-primary">UI/UX</span>
                        <span class="label label-primary">Web design</span>
                        <span class="label label-primary">Photoshop</span>
                        <span class="label label-primary">HTML</span>
                        <span class="label label-primary">CSS</span>
                        -->
                    </div>
                </div>

                <div class="panel panel-transparent">
                    <div class="panel-heading">
                        <span class="panel-title">Social</span>
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item" ><i class="profile-list-icon fa fa-twitter" style="color: #4ab6d5"></i> &nbsp;</a>
                        <a href="#" class="list-group-item"><i class="profile-list-icon fa fa-facebook-square" style="color: #1a7ab9"></i> &nbsp;</a>
                        <a href="#" class="list-group-item"><i class="profile-list-icon fa fa-envelope" style="color: #888"></i> &nbsp;</a>
                    </div>
                </div>

            </div>
            <div class="right-col">

                <hr class="profile-content-hr no-grid-gutter-h">

                <div class="profile-content">

                    <ul id="profile-tabs" class="nav nav-tabs">
                        <li class="active">
                            <a href="#profile-tabs-board" data-toggle="tab">Board</a>
                        </li>
                        <li>
                            <a href="#profile-tabs-activity" data-toggle="tab">Timeline</a>
                        </li>
                        <li>
                            <a href="#profile-tabs-followers" data-toggle="tab">Followers</a>
                        </li>
                        <li>
                            <a href="#profile-tabs-following" data-toggle="tab">Following</a>
                        </li>
                    </ul>

                    <div class="tab-content tab-content-bordered panel-padding">
                        <div class="widget-article-comments tab-pane panel no-padding no-border fade in active" id="profile-tabs-board">
                            &nbsp;
                        </div> <!-- / .tab-pane -->
                        <div class="tab-pane fade" id="profile-tabs-activity">
                            &nbsp;
                        </div> <!-- / .tab-pane -->
                        <div class="tab-pane fade widget-followers" id="profile-tabs-followers">
                            &nbsp;
                        </div> <!-- / .tab-pane -->
                        <div class="tab-pane fade widget-followers" id="profile-tabs-following">
                            &nbsp;
                        </div>
                    </div> <!-- / .tab-pane -->
                </div> <!-- / .tab-content -->
            </div>
        </div>
    </div>
</div> <!-- / #content-wrapper -->
