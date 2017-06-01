<div class="row">
    <div class="col-xs-12 bg-white">
        <ul class="nav nav-pills size18 size14-xs b">
            <li class="active"><a data-toggle="pill" href="#menu1">DETAIL</a></li>
            <li><a data-toggle="pill" href="#menu2">SPEC</a></li>
            <li><a data-toggle="pill" href="#menu3">BRAND CONTENT</a></li>
            <li><a data-toggle="pill" href="#menu4">ETC.</a></li>
        </ul>
        <div class="size18 size14-xs">&nbsp;</div>
        <div class="tab-content">
            <div id="menu1" class="tab-pane fade in active">
                <p><?php echo $model['description'] ?></p>
                <h3>&nbsp;</h3>
            </div>
            <div id="menu2" class="tab-pane fade">
                <p><?php echo $model['specification'] ?></p>
                <h3>&nbsp;</h3>
            </div>
            <div id="menu3" class="tab-pane fade">
                <p>&nbsp;</p>
                <h3>&nbsp;</h3>
            </div>
            <div id="menu4" class="tab-pane fade">
                <p>&nbsp;</p>
                <h3>&nbsp;</h3>
            </div>
        </div>
    </div>
</div>