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

            </div>
            <div id="menu2" class="tab-pane fade">
                <p><?php echo $model['specification'] ?></p>

            </div>
            <div id="menu3" class="tab-pane fade">
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                    laudantium, totam rem aperiam.</p>
                <h3>Menu 3</h3>
            </div>
            <div id="menu4" class="tab-pane fade">
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                    explicabo.</p>
                <h3>Menu 4</h3>
            </div>
        </div>
    </div>
</div>