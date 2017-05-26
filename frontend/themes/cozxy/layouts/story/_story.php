<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Cart -->
        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="col-xs-12 bg-white">
                    <h1 class="page-header">Lorem ipsum dolor sit amet</h1>
                    <img src="/images/content/freitag1.jpg" alt="" class="col-md-4 pull-left">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempor mauris vel dui dapibus,
                        eu dapibus nulla ultricies. Vivamus non lectus pulvinar, aliquet neque vitae, lacinia urna. In
                        iaculis massa ac ipsum sodales interdum. Etiam pellentesque mauris enim, vel dapibus velit
                        sollicitudin ac. Duis ligula lacus, feugiat nec magna in, rutrum vestibulum elit. Morbi pretium,
                        turpis at pulvinar tincidunt, diam felis commodo lectus, sed tempor odio turpis non est.
                        Praesent venenatis augue nec mattis aliquet. Aliquam luctus, nisi at aliquam bibendum, orci
                        massa tincidunt mi, eu volutpat ipsum eros in lectus.
                    </p>
                    <div class="size12">&nbsp;</div>
                    <p>
                        Ut euismod rhoncus neque non rhoncus. Proin ornare dapibus nibh, sit amet accumsan ante suscipit
                        et. Nulla ut arcu mi. Curabitur semper, nulla non rutrum pellentesque, erat turpis semper dui,
                        non ultrices enim nibh ut justo. Pellentesque eu libero commodo, sagittis diam ac, eleifend
                        sapien. Nullam ut mattis magna. Quisque vel eros vitae nunc facilisis tristique sit amet eget
                        libero.
                    </p>
                    <div class="size12">&nbsp;</div>
                    <p>
                        Phasellus mollis neque massa. Vivamus mattis vel arcu id facilisis. Curabitur convallis maximus
                        sagittis. Donec commodo enim ligula, quis vestibulum tellus pellentesque sed. Vestibulum ut
                        magna lectus. Maecenas fermentum convallis ligula ultricies mattis. Phasellus mauris quam,
                        lacinia nec massa non, commodo lacinia leo.
                    </p>
                    <div class="size12">&nbsp;</div>
                    <img src="/images/content/freitag1.jpg" alt="" class="col-md-6 pull-right">
                    <p>
                        Donec eget scelerisque justo, scelerisque efficitur dui. Cras tincidunt cursus mattis. Quisque
                        vitae cursus massa, ut porta nibh. Proin mattis arcu eu nisl bibendum, at scelerisque elit
                        ornare. Nulla at lectus blandit, facilisis lectus ac, ultrices augue. Mauris faucibus euismod mi
                        quis ultricies. Vestibulum auctor eros sed mi sagittis, eu pretium dolor cursus. Maecenas
                        ornare, purus non fringilla sagittis, risus mauris pretium elit, imperdiet blandit eros tortor
                        sit amet nibh. Aliquam erat volutpat. Vivamus nec augue nunc. Cras suscipit rhoncus sapien.
                        Curabitur vestibulum egestas dictum. Integer a felis sagittis, hendrerit dui a, tincidunt lorem.
                    </p>
                    <div class="size12">&nbsp;</div>
                    <p>
                        Ut vehicula dignissim dolor, quis volutpat augue vestibulum vitae. Aenean interdum libero in
                        sapien lacinia, vitae consectetur libero volutpat. Nullam condimentum, ipsum eget laoreet
                        aliquet, sapien felis lobortis eros, eget aliquet nibh justo id diam. Ut euismod arcu vitae
                        porta tempus. Pellentesque laoreet elit et elit tincidunt pretium. Fusce eu faucibus est. Proin
                        tincidunt lacus at justo ornare pulvinar.
                    </p>

                    <div class="size12 size10-xs">&nbsp;</div>
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
            <?= $this->render('_stars') ?>
            <?= $this->render('_authors') ?>
            <?= $this->render('_about_this_story') ?>
            <?= $this->render('_popular_stories') ?>
        </div>

    </div>
</div>