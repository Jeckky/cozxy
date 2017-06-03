<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Cart -->
        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="col-xs-12 bg-white">
                    <h1 class="page-header"><?= $productPost->title ?> </h1>
                    <p>
                        <?= $productPost->description ?>
                    </p>
                    <div class="size12">&nbsp;</div>

                </div>
            </div>

            <div class="size20">&nbsp;</div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <h1 class="page-header">Compare Price</h1>

                            <div class="row">
                                <div class="col-md-2 text-center">
                                    Price Filter
                                </div>
                                <div class="col-md-3">
                                    <select name="" id="" class="fullwidth">
                                        <option value="">Filter 1</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="" id="" class="fullwidth">
                                        <option value="">Filter 1</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="" id="" class="fullwidth">
                                        <option value="">Currency</option>
                                    </select>
                                </div>
                            </div>

                            <div class="size20">&nbsp;</div>

                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <table class="table table-responsive table-hover">
                                        <tr style="border-bottom: double 1px #999;">
                                            <th class="col-md-2">Country</th>
                                            <th class="col-md-6">Place</th>
                                            <th class="col-md-2">Price</th>
                                            <th class="col-md-2">Local Price</th>
                                        </tr>
                                        <?php for ($i = 0; $i < 8; $i++): ?>
                                            <tr style="border-bottom: dotted 1px #999;">
                                                <td>
                                                    <img src="/images/flags/flags/flat/24/United-States.png" alt=""> USA
                                                </td>
                                                <td>Nordstorm</td>
                                                <td>USD231,400.00</td>
                                                <td>
                                                    THB1,149,000.00
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>


        <!-- Total -->
        <div class="col-lg-3 col-md-4">
            <?= $this->render('_stars', ['productPost' => $productPost]) ?>
            <?= $this->render('_authors') ?>
            <?= $this->render('_about_this_story', ['productPost' => $productPost]) ?>
            <?= $this->render('_popular_stories') ?>
        </div>

    </div>
</div>