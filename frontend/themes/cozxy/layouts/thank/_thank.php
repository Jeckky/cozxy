<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">Signup Thank</p>
        </div>
        <div class="col-xs-12 bg-white size18 b" style="padding: 20px;">
            <?php
            //echo $_GET['status'];
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 1) {
                    echo '<span style="color: red">Email is already in the system </span> please again ';
                } else if ($_GET['status'] == 2) {
                    echo '<span style="color: red">Email is already in the system </span> please again ';
                } else if ($_GET['status'] == 3) {
                    echo ' Please check your email to confirm your registration.';
                } else {
                    echo ' Please check your email to confirm your registration.';
                }
            } elseif ($_GET['verification'] == 'complete') {
                echo 'Welcome to Cozxy.<br>We hope you enjoy our experience with us!';
            } else {
                echo ' Thank you for registering on Cozxy!';
            }
            ?>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>