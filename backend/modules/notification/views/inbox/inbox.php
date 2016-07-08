<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Inbox';
$this->params['breadcrumbs'][] = $this->title; // inbox/index

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
?>
<style>
    .page-header .pull-right {
        padding-top: 5px;
    }
    .page-header .pull-right > * {
        display: inline-block;
        vertical-align:middle;
    }
</style>
<script>
    var init = [];
    init.push(function () {
        $('body').addClass('mmc');
    });
</script>
<div class="theme-default main-menu-animated page-mail">
    <div id="content-wrapper">
        <div class="mail-nav">
            <div class="compose-btn">
                <a href="pages-new-email.html" class="btn btn-primary btn-labeled btn-block"><i class="btn-label fa fa-pencil-square-o"></i>New Email</a>
            </div>
            <div class="navigation">
                <ul class="sections">
                    <li class="active"><a href="#"><i class="m-nav-icon fa fa-inbox"></i>Inbox <span class="label pull-right">20</span></a></li>
                    <li><a href="#"><i class="m-nav-icon fa fa-star"></i>Starred <span class="label pull-right">43</span></a></li>
                    <li><a href="#"><i class="m-nav-icon fa fa-envelope"></i>Sent mail</a></li>
                    <li><a href="#"><i class="m-nav-icon fa fa-exclamation"></i>Important</a></li>
                    <li><a href="#"><i class="m-nav-icon fa fa-file-text-o"></i>Drafts <span class="label pull-right">11</span></a></li>
                    <li><a href="#"><i class="m-nav-icon fa fa-trash-o"></i>Trash</a></li>
                    <li class="divider"></li>
                    <li class="add-more"><a href="#">+ Add More</a></li>
                </ul>

                <div class="mail-nav-header">LABELS</div>
                <ul class="sections">
                    <li><a href="#"><div class="mail-nav-lbl bg-success"></div>Client</a></li>
                    <li><a href="#"><div class="mail-nav-lbl bg-danger"></div>Social</a></li>
                    <li><a href="#"><div class="mail-nav-lbl bg-info"></div>Family</a></li>
                    <li><a href="#"><div class="mail-nav-lbl bg-warning"></div>Friends</a></li>
                    <li><a href="#"><div class="mail-nav-lbl bg-pa-purple"></div>Work</a></li>
                    <li class="divider"></li>
                    <li class="add-more"><a href="#">+ Add More</a></li>
                </ul>
            </div>
        </div>

        <div class="mail-container">
            <div class="mail-container-header">
                Inbox

                <form action="" class="pull-right" style="width: 200px;margin-top: 3px;">
                    <div class="form-group input-group-sm has-feedback no-margin">
                        <input type="text" placeholder="Search..." class="form-control">
                        <span class="fa fa-search form-control-feedback" style="top: -1px"></span>
                    </div>
                </form>
            </div>

            <div class="mail-controls clearfix">
                <div class="btn-toolbar wide-btns pull-left" role="toolbar">

                    <div class="btn-group">
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-check-square-o"></i>&nbsp;<i class="fa fa-caret-down"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Check all</a></li>
                                <li><a href="#">Check read</a></li>
                                <li><a href="#">Check unread</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Uncheck all</a></li>
                                <li><a href="#">Uncheck read</a></li>
                                <li><a href="#">Uncheck unread</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn"><i class="fa fa-repeat"></i></button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn"><i class="fa fa fa-file-text-o"></i></button>
                        <button type="button" class="btn"><i class="fa fa-exclamation-circle"></i></button>
                        <button type="button" class="btn"><i class="fa fa-trash-o"></i></button>
                    </div>

                </div>

                <div class="btn-toolbar pull-right" role="toolbar">
                    <div class="btn-group">
                        <button type="button" class="btn"><i class="fa fa-chevron-left"></i></button>
                        <button type="button" class="btn"><i class="fa fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="pages pull-right">
                    1-50 of 825
                </div>
            </div>


            <ul class="mail-list">
                <li class="mail-item unread">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Facebook</a></div>
                    <div class="m-subject"><span class="label label-danger">Social</span>&nbsp;&nbsp;<a href="pages-show-email.html">Reset your account password</a></div>
                    <div class="m-date">3:25 PM</div>
                </li>
                <li class="mail-item starred">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Dropbox</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">Complete your Dropbox setup!</a></div>
                    <div class="m-date">Yesterday, 1:15 PM</div>
                </li>
                <li class="mail-item unread">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Michelle Bortz</a></div>
                    <div class="m-subject"><span class="label label-pa-purple">Work</span>&nbsp;&nbsp;<a href="pages-show-email.html">New design concepts</a>&nbsp;&nbsp;<i class="fa fa-paperclip"></i></div>
                    <div class="m-date">Mar 28</div>
                </li>
                <li class="mail-item">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">TaskManager</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">You have 5 uncompleted tasks!</a></div>
                    <div class="m-date">Mar 27</div>
                </li>
                <li class="mail-item">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">GitHub</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">[GitHub] Your password has changed</a></div>
                    <div class="m-date">Mar 26</div>
                </li>
                <li class="mail-item starred">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Timothy Owens</a></div>
                    <div class="m-subject"><span class="label label-warning">Friends</span>&nbsp;&nbsp;<a href="pages-show-email.html">Hi John! How are you?</a></div>
                    <div class="m-date">Mar 25</div>
                </li>
                <li class="mail-item starred unread">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Master Yoda</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">You're ready, young padawan.</a></div>
                    <div class="m-date">Mar 24</div>
                </li>
                <li class="mail-item">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Facebook</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">Reset your account password</a></div>
                    <div class="m-date">Mar 23</div>
                </li>
                <li class="mail-item">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Dropbox</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">Complete your Dropbox setup!</a></div>
                    <div class="m-date">Mar 22</div>
                </li>
                <li class="mail-item unread">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Michelle Bortz</a></div>
                    <div class="m-subject"><span class="label label-pa-purple">Work</span>&nbsp;&nbsp;<a href="pages-show-email.html">New design concepts</a>&nbsp;&nbsp;<i class="fa fa-paperclip"></i></div>
                    <div class="m-date">Mar 21</div>
                </li>
                <li class="mail-item">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">TaskManager</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">You have 5 uncompleted tasks!</a></div>
                    <div class="m-date">Mar 20</div>
                </li>
                <li class="mail-item">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">GitHub</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">[GitHub] Your password has changed</a></div>
                    <div class="m-date">Mar 19</div>
                </li>
                <li class="mail-item">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Timothy Owens</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">Hi John! How are you?</a></div>
                    <div class="m-date">Mar 18</div>
                </li>
                <li class="mail-item starred">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Master Yoda</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">You're ready, young padawan.</a></div>
                    <div class="m-date">Mar 17</div>
                </li>
                <li class="mail-item">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Facebook</a></div>
                    <div class="m-subject"><span class="label label-danger">Social</span>&nbsp;&nbsp;<a href="pages-show-email.html">Reset your account password</a></div>
                    <div class="m-date">Mar 16</div>
                </li>
                <li class="mail-item starred">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Dropbox</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">Complete your Dropbox setup!</a></div>
                    <div class="m-date">Mar 15</div>
                </li>
                <li class="mail-item">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Michelle Bortz</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">New design concepts</a>&nbsp;&nbsp;<i class="fa fa-paperclip"></i></div>
                    <div class="m-date">Mar 14</div>
                </li>
                <li class="mail-item starred unread">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Master Yoda</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">You're ready, young padawan.</a></div>
                    <div class="m-date">Mar 13</div>
                </li>
                <li class="mail-item">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">TaskManager</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">You have 5 uncompleted tasks!</a></div>
                    <div class="m-date">Mar 11</div>
                </li>
                <li class="mail-item">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">GitHub</a></div>
                    <div class="m-subject"><a href="pages-show-email.html">[GitHub] Your password has changed</a></div>
                    <div class="m-date">Mar 10</div>
                </li>
                <li class="mail-item starred">
                    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
                    <div class="m-star"><a href="#"></a></div>
                    <div class="m-from"><a href="#">Timothy Owens</a></div>
                    <div class="m-subject"><span class="label label-warning">Friends</span>&nbsp;&nbsp;<a href="pages-show-email.html">Hi John! How are you?</a></div>
                    <div class="m-date">Mar 10</div>
                </li>
            </ul>

        </div>
    </div>
</div>
<script type="text/javascript">
    init.push(function () {
        // Open nav on mobile
        $('.mail-nav .navigation li.active a').click(function () {
            $('.mail-nav .navigation').toggleClass('open');
            return false;
        });

        // Make message starred/unstarred
        $('body').on('click', '.m-star', function () {
            $(this).parents('.mail-item').toggleClass('starred');
            return false;
        });

        // Fix navigation if main menu is fixed
        if ($('body').hasClass('main-menu-fixed')) {
            $('.mail-nav').addClass('fixed');
        }
    })
    window.PixelAdmin.start(init);
</script>