<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use leandrogehlen\treegrid\TreeGrid;

//http://www.pcnott.com/Joomla/Basic/ว่าด้วยเรื่อง-Group-ของ-Joomla.html
//https://sites.google.com/site/gaiusjustthink/thitikorn-on-joomla/kar-srang-laea-cadkar-rabb-smachik/karbaengradabkhxngsmachikkhxngjoomla
?>
<h1>Settings/index</h1>
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
                                <a href="<?php echo Yii::$app->homeUrl; ?>management/user-groups"  class="btn"  style="color: #000;">
                                    <i class="fa fa-tasks list-group-icon text-danger"></i> Settings Groups </a><br>
                            </div>
                        </div> <!-- / .panel-heading -->
                        <div class="panel-body text-left">
                            <div class="widget-profile-text" style="padding: 0;">
                                <p class="text-success">อธิบาย</p>
                                - ตั้งค่า การใช้งานของ กลุ่ม
                            </div>
                        </div>
                    </div> <!-- / .panel -->
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default panel-dark panel-body-colorful widget-profile widget-profile-centered">
                        <div class="panel-heading">
                            <!--<img src="assets/demo/avatars/1.jpg" alt="" class="widget-profile-avatar">-->
                            <div class="widget-profile-header">
                                <a href="<?php echo Yii::$app->homeUrl; ?>management/view-levels"  class="btn"  style="color: #000;">
                                    <i class="fa fa-tasks list-group-icon text-danger"></i> Settings Levels </a><br>

                            </div>
                        </div> <!-- / .panel-heading -->
                        <div class="panel-body text-left">
                            <div class="widget-profile-text" style="padding: 0;">
                                <p class="text-success">อธิบาย</p>
                                - ตั้งค่า ระดับการเข้าถึง
                            </div>
                        </div>
                    </div> <!-- / .panel -->
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default panel-dark panel-body-colorful widget-profile widget-profile-centered">
                        <div class="panel-heading">

                            <div class="widget-profile-header ">
                                <a href="<?php echo Yii::$app->homeUrl; ?>management/menu"  class="btn"  style="color: #000;">
                                    <i class="fa fa-tasks list-group-icon text-danger"></i> Settings Menu</a><br>

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
                <code>
                    *** การกำหนด Group และ Level นั้น จะทำให้เราสามารถควบคุมการใช้งานของสมาชิกในการเข้าถึงบทความ หรือลิ้งค์ต่าง ๆ ได้
                </code>
            </div>
        </div>

        <div class="note note-info padding-xs-vr">
            <!--
            <strong>การแบ่งระดับของสมาชิกของ Cozxy.com!</strong><br>

            ก่อนจะทำการจัดการระบบสมาชิกได้ จะต้องรู้ถึงการแบ่งระดับของสมาชิกใน Cozxy.com! กันก่อนครับ Cozxy.com!
            แบ่งระดับของสมาชิกออกเป็น 2 กลุ่ม 7 ระดับ (กลุ่มผู้ใช้งานระบบ 4 ระดับ กลุ่มผู้ดูแลระบบ 3 ระดับ) ดังนี้
            .<br><br>
            1.กลุ่มผู้ใช้งานระบบ (Public Frontend)<br><br>

            &nbsp;Registered สามารถเข้าถึงข้อมูลข่าวสารระดับ Registered ได้<br>
            &nbsp;Author สามารถเขียนบทความได้ สามารถแก้ไขบทความที่ตัวเองเขียนได้ แต่ไม่สามารถแก้ไข/เผยแพร่บทความที่คนอื่นเขียน<br>
            &nbsp;Editor สามารถเขียน/แก้ไขบทความที่ตัวเองเขียนได้ สามารถแก้ไขบทความที่คนอื่นเขียนได้ แต่ไม่สามารถอนุญาตให้บทความต่างๆ ถูกเผยแพร่หรือไม่เผยแพร่<br>
            &nbsp;Publisher สามารถเขียน/แก้ไข/เผยแพร่/ไม่เผยแพร่บทความทั้งหมดได้<br><br><br>

            2.กลุ่มผู้ดูแลระบบ (Public Backend)<br><br>

            &nbsp;Manager มีสิทธิ์การใช้งานระดับผู้ใช้งานระบบเทียบเท่ากับ Publisher และสามารถเข้าถึงหน้าผู้ดูแลระบบเพื่อจัดการกับบทความต่างๆ รวมทั้งแก้ไขคอมโพเนนท์หรือโมดูลบางตัวได้<br>
            &nbsp;Administrator มีสิทธิ์การใช้งานระดับผู้ใช้งานระบบเทียบเท่ากับ Publisher และสามารถเข้าถึงหน้าผู้ดูแลระบบเพื่อจัดการกับบทความต่างๆ รวมทั้งแก้ไขคอมโพเนนท์หรือโมดูลได้ทั้งหมด ยกเว้นค่าสำคัญบางประการที่อาจส่งผลต่อความเสถียรภาพของระบบ<br>
            &nbsp;Super Administrator มีสิทธิ์การใช้งานระดับผู้ใช้งานระบบเทียบเท่ากับ Publisher และสามารถเข้าถึงหน้าผู้ดูแลระบบเพื่อจัดการกับบทความต่างๆ รวมทั้งแก้ไขคอมโพเนนท์หรือโมดูล รวมทั้งค่าสำคัญทั้งหมดของระบบ<br>
            <br>
            <img src="<?php echo Yii::$app->homeUrl; ?>images/settings/CozxyUser.png" data-src="<?php echo Yii::$app->homeUrl; ?>/settings/CozxyUser.png"  class="img-responsive img-thumbnail"/>
            <br><br>
            <strong>NOTE:</strong> This examples uses utility classes defined in the utils.less file.<br><br>
            <button class="btn btn-xs" id="equal-height">Equalize heights</button>
            -->
        </div>
    </div> <!-- / .row -->
</div> <!-- / #content-wrapper -->