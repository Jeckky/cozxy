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
            } else {
                if (isset($_GET['verification'])) {
                    echo 'Welcome to Cozxy.<br>We hope you enjoy our experience with us!<br>';
                    echo "We are fully committed in becoming the most efficient logistic network, Thai bred E-commerce startup in Thailand and throughout Asia."
                    . " We are working hard with partners, traditional shops and SMEs to provide you with the best experience possible.";
                } else {
                    //echo ' Thank you for registering on Cozxy!';
                    echo 'Verify your email to complete your registration<br>';
                    echo "Thank you for registering. Please check your email to verify your account before you can enjoy your experience at Cozxy.com.";
                }
            }
            ?>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>