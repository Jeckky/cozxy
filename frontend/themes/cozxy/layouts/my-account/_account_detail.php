<div class="row">
    <div class="col-md-12">
        Personal Details<a href="javascript:edit_profile(1);" class="pull-right btn-g999 p-edit">Edit</a>
    </div>
    <div class="col-xs-12 size6">&nbsp;</div>
</div>
<div class="row fc-g999">
    <div class="col-sm-12 col-md-2">Name:</div>
    <div class="col-sm-12 col-md-10">Inthanon Panyasopa</div>
    <div class="col-sm-12 col-md-2">E-mail:</div>
    <div class="col-sm-12 col-md-10">playmak3r.design@gmail.com</div>
    <div class="col-sm-12 col-md-2">Birthday:</div>
    <div class="col-sm-12 col-md-10">1991-05-03</div>
    <div class="col-sm-12 col-md-2">Password:</div>
    <div class="col-sm-12 col-md-10"><a href="#" class="fc-g999"><u>Change Password</u></a></div>
    <div class="size12">&nbsp;</div>
    <div class="size32 hr-margin">&nbsp;</div>
</div>

<div class="row">
    <div class="col-md-12">
        CozxyCoin
        <a href="javascript:edit_profile(1);" class="pull-right btn-g999 p-edit btn-yellow"><i class="fa fa-circle-thin"></i> Top Up</a>
        <a href="javascript:edit_profile(1);" class="pull-right btn-g999 p-edit" style="margin-right: 8px;"><i class="fa fa-history"></i> History</a>
    </div>
    <div class="col-xs-12 size6">&nbsp;</div>
</div>
<div class="row fc-g999">
    <div class="col-sm-12 col-md-2">Your Balance:</div>
    <div class="col-sm-12 col-md-10">8,888</div>
    <div class="col-sm-12 col-md-2">Last update:</div>
    <div class="col-sm-12 col-md-10"><?=date('Y-m-d H:i:s')?></div>
    <div class="col-sm-12 col-md-2">Method:</div>
    <div class="col-sm-12 col-md-10">Credit Card</div>
    <div class="size12">&nbsp;</div>
    <div class="size32 hr-margin">&nbsp;</div>
</div>

<?php
/*
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6">Shipping
        Address<a href="javascript:edit_profile(2);" class="pull-right btn-g999 p-edit">Edit</a></div>
    <div class="col-xs-12 size6">&nbsp;</div>
</div>
<div class="row fc-g999">
    <div class="col-sm-12 col-md-2">Name:</div>
    <div class="col-sm-12 col-md-10">Inthanon Panyasopa</div>
    <div class="col-sm-12 col-md-2">Address:</div>
    <div class="col-sm-12 col-md-10">123 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
        eiusmod tempor incididunt ut labore et dolore magna aliqua 50000
    </div>
    <div class="size12">&nbsp;</div>
    <div class="size32 hr-margin">&nbsp;</div>
</div>
*/
?>

<div class="row">
    <div class="col-md-12">
        Billing Address
        <a href="#" class="pull-right btn-g999 p-edit" data-toggle="modal" data-target=".bs-example-modal-lg">+ New Billing Address</a>
    </div>
    <div class="col-xs-12 size6">&nbsp;</div>
</div>

<div class="row fc-g999">
    <div class="col-xs-12">
        <div class="row">
            <?for ($i=0;$i<8;$i++):?>
            <div class="col-xs-12 col-md-3">
                <div class="panel panel-default">

                    <div class="size8" style="background-color:rgb(254, 230, 10);">&nbsp;</div>
                    <div class="panel-body">
                        <div class="row size14">
                            <div class="col-md-3 col-sm-3">Name:</div>
                            <div class="col-md-9 col-sm-9">Inthanon Panyasopa</div>
                            <div class="col-md-3 col-sm-3">Address:</div>
                            <div class="col-md-9 col-sm-9">123 Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit, sed
                                do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua 50000
                            </div>
                            <div class="col-md-12 text-right">
                                <div class="size10">&nbsp;</div>
                                <a href="#" class="text-warning"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>
                                <a href="#" class="text-danger"><i class="fa fa-trash-o"></i>&nbsp;Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor;?>
        </div>
    </div>
    <div class="size12">&nbsp;</div>
    <div class="size32 hr-margin">&nbsp;</div>
</div>