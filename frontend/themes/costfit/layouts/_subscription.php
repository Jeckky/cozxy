<section class="subscr-widget gray-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 col-md-8 col-sm-8">
                <h2><?php echo $lastIndexContent->title; ?></h2>
                <form class="subscr-form" role="form" autocomplete="off">
                    <div class="form-group">
                        <label class="sr-only" for="subscr-name">Enter name</label>
                        <input type="text" class="form-control" name="subscr-name" id="subscr-name" placeholder="Enter name" required>
                        <button class="subscr-next"><i class="icon-arrow-right"></i></button>
                    </div>
                    <div class="form-group fff" style="display: none">
                        <label class="sr-only" for="subscr-email">Enter email</label>
                        <input type="email" class="form-control" name="subscr-email" id="subscr-email" placeholder="Enter email" required>
                        <button type="submit" id="subscr-submit"><i class="icon-check"></i></button>
                    </div>
                </form>
                <p class="p-style2">Please fill the field before continuing</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1">
                <p class="p-style3"><?php echo $lastIndexContent->description; ?></p>
            </div>
        </div>
    </div>
</section><!--Subscription Widget Close-->