<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;
?>
<style type="text/css">
    img{max-width:100%;}
    *{transition: all .5s ease;-moz-transition: all .5s ease;-webkit-transition: all .5s ease}
    .my-list {
        width: 100%;
        padding: 10px;
        border: 1px solid #f5efef;
        float: left;
        margin: 15px 0;
        border-radius: 5px;
        box-shadow: 2px 3px 0px #e4d8d8;
        position:relative;
        overflow:hidden;
    }
    .my-list h3{
        text-align: left;
        font-size: 14px;
        font-weight: 500;
        line-height: 21px;
        margin: 0px;
        padding: 0px;
        border-bottom: 1px solid #ccc4c4;
        margin-bottom: 5px;
        padding-bottom: 5px;
    }
    .my-list span{float:left;font-weight: bold;}
    .my-list span:last-child{float:right;}
    .my-list .offer{
        width: 100%;
        float: left;
        margin: 5px 0;
        border-top: 1px solid #ccc4c4;
        margin-top: 5px;
        padding-top: 5px;
        color: #afadad;
    }
    .detail {
        position: absolute;
        top: -107%;
        left: 0;
        text-align: center;
        background: #fff;height: 100%;width:100%;

    }

    .my-list:hover .detail{top:0;}
</style>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><h1>Local/index</h1></span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h1 for="">Countries</h1>
                    <div class="col-lg-12 col-md-12col-sm-12 col-xs-12">
                        <div class="my-list text-center">
                            <!--<img src="http://hpservicecenterschennai.in/images/hp_laptop_service_centers_in_guindy.png" alt="dsadas" />-->
                            <div style="width: 100%; height: 200px; background-color: #f5efef;">&nbsp;</div>
                            <h2>ประเทศ</h2>
                            <p>จำนวน: </p>
                            <span class="pull-right">&nbsp;</span>
                            <div class="offer">&nbsp;</div>
                            <div class="detail">
                                <h2>ประเทศ</h2>
                                 <!--<img src="http://hpservicecenterschennai.in/images/hp_laptop_service_centers_in_guindy.png" alt="dsadas" />-->
                                <div style="width: 100%;  height: 200px; background-color: #fee60a; vertical-align: middle; line-height: 200px;"><p>จำนวน:45K</p></div>
                                <br>
                                <a href="countries" class="btn btn-success">Add New</a>
                                <a href="#" class="btn btn-info">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h1 for="">Province</h1>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="my-list text-center">
                            <!--<img src="http://hpservicecenterschennai.in/images/hp_laptop_service_centers_in_guindy.png" alt="dsadas" />-->
                            <div style="width: 100%; height: 200px; background-color: #f5efef;">&nbsp;</div>
                            <h2>จังหวัด</h2>
                            <p>จำนวน: </p>
                            <span class="pull-right">&nbsp;</span>
                            <div class="offer">&nbsp;</div>
                            <div class="detail">
                                <h2>จังหวัด</h2>
                                 <!--<img src="http://hpservicecenterschennai.in/images/hp_laptop_service_centers_in_guindy.png" alt="dsadas" />-->
                                <div style="width: 100%;  height: 200px; background-color: #fee60a; vertical-align: middle; line-height: 200px;"><p>จำนวน:45K</p></div>
                                <br>
                                <a href="states" class="btn btn-success">Add New</a>
                                <a href="#" class="btn btn-info">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h1 for="">City</h1>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="my-list text-center">
                            <!--<img src="http://hpservicecenterschennai.in/images/hp_laptop_service_centers_in_guindy.png" alt="dsadas" />-->
                            <div style="width: 100%; height: 200px; background-color: #f5efef;">&nbsp;</div>
                            <h2>เขต/อำเภอ</h2>
                            <p>จำนวน: </p>
                            <span class="pull-right">&nbsp;</span>
                            <div class="offer">&nbsp;</div>
                            <div class="detail">
                                <h2>เขต/อำเภอ</h2>
                                 <!--<img src="http://hpservicecenterschennai.in/images/hp_laptop_service_centers_in_guindy.png" alt="dsadas" />-->
                                <div style="width: 100%;  height: 200px; background-color: #fee60a; vertical-align: middle; line-height: 200px;"><p>จำนวน:45K</p></div>
                                <br>
                                <a href="cities" class="btn btn-success">Add New</a>
                                <a href="#" class="btn btn-info">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h1 for="">District</h1>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="my-list text-center">
                            <!--<img src="http://hpservicecenterschennai.in/images/hp_laptop_service_centers_in_guindy.png" alt="dsadas" />-->
                            <div style="width: 100%; height: 200px; background-color: #f5efef;">&nbsp;</div>
                            <h2>แขวง/ตำบล</h2>
                            <p>จำนวน: </p>
                            <span class="pull-right">&nbsp;</span>
                            <div class="offer">&nbsp;</div>
                            <div class="detail">
                                <h2>แขวง/ตำบล</h2>
                                 <!--<img src="http://hpservicecenterschennai.in/images/hp_laptop_service_centers_in_guindy.png" alt="dsadas" />-->
                                <div style="width: 100%;  height: 200px; background-color: #fee60a; vertical-align: middle; line-height: 200px;"><p>จำนวน:45K</p></div>
                                <br>
                                <a href="district" class="btn btn-success">Add New</a>
                                <a href="#" class="btn btn-info">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h1 for="">Zipcode</h1>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="my-list text-center">
                            <!--<img src="http://hpservicecenterschennai.in/images/hp_laptop_service_centers_in_guindy.png" alt="dsadas" />-->
                            <div style="width: 100%; height: 200px; background-color: #f5efef;">&nbsp;</div>
                            <h2>รหัสไปรษณีย์</h2>
                            <p>จำนวน: </p>
                            <span class="pull-right">&nbsp;</span>
                            <div class="offer">&nbsp;</div>
                            <div class="detail">
                                <h2>รหัสไปรษณีย์</h2>
                                 <!--<img src="http://hpservicecenterschennai.in/images/hp_laptop_service_centers_in_guindy.png" alt="dsadas" />-->
                                <div style="width: 100%;  height: 200px; background-color: #fee60a; vertical-align: middle; line-height: 200px;"><p>จำนวน:45K</p></div>
                                <br>
                                <a href="zipcodes" class="btn btn-success">Add New</a>
                                <a href="#" class="btn btn-info">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
