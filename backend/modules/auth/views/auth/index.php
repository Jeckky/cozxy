<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title; // auth/index

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$logo = common\models\costfit\ContentGroup::find()->where("lower(title)='logoimage'")->one();
?>
<div class="theme-default page-signin">
    <!-- $DEMO ==== Remove this section on production ======= -->
    <style>
        #signin-demo {
            position: fixed;
            right: 0;
            bottom: 0;
            z-index: 10000;
            background: rgba(0,0,0,.6);
            padding: 6px;
            border-radius: 3px;
        }
        #signin-demo img { cursor: pointer; height: 40px; }
        #signin-demo img:hover { opacity: .5; }
        #signin-demo div {
            color: #fff;
            font-size: 10px;
            font-weight: 600;
            padding-bottom: 6px;
        }
    </style>
    <!-- / $DEMO -->

    <script>
        var init = [];
        init.push(function () {
            var $div = $('<div id="signin-demo" class="hidden-xs"><div>PAGE BACKGROUND</div></div>'),
                    bgs = ['<?php echo $directoryAsset; ?>/demo/signin-bg-1.jpg', '<?php echo $directoryAsset; ?>/demo/signin-bg-2.jpg', '<?php echo $directoryAsset; ?>/demo/signin-bg-3.jpg',
                        '<?php echo $directoryAsset; ?>/demo/signin-bg-4.jpg', '<?php echo $directoryAsset; ?>/demo/signin-bg-5.jpg', '<?php echo $directoryAsset; ?>/demo/signin-bg-6.jpg',
                        '<?php echo $directoryAsset; ?>/demo/signin-bg-7.jpg', '<?php echo $directoryAsset; ?>/demo/signin-bg-8.jpg', '<?php echo $directoryAsset; ?>/demo/signin-bg-9.jpg'];
            for (var i = 0, l = bgs.length; i < l; i++)
                $div.append($('<img src="' + bgs[i] + '">'));
            $div.find('img').click(function () {
                var img = new Image();
                img.onload = function () {
                    $('#page-signin-bg > img').attr('src', img.src);
                    $(window).resize();
                }
                img.src = $(this).attr('src');
            });
            $('body').append($div);
        });
    </script>
    <!-- Demo script --> <script src="<?php echo $directoryAsset; ?>/demo/demo.js"></script> <!-- / Demo script -->

    <!-- Page background -->
    <div id="page-signin-bg">
        <!-- Background overlay -->
        <div class="overlay"></div>
        <!-- Replace this with your bg image -->
        <img src="<?php echo $directoryAsset; ?>/demo/signin-bg-1.jpg" alt="">
    </div>
    <!-- / Page background -->

    <!-- Container -->
    <div class="signin-container">

        <!-- Left side -->
        <div class="signin-info">
            <a href="#" class="logo">
                <img src="<?php echo Yii::$app->homeUrl . $logo->image; ?>" alt=" " style="margin-top: -5px;" class="img-responsive"/> &nbsp;
                <!--DaiiBuy Admin-->
            </a> <!-- / .logo -->
            <div class="slogan">
                Simple. Flexible. Powerful.
            </div> <!-- / .slogan -->
            <ul>
                <li><i class="fa fa-sitemap signin-icon"></i> Flexible modular structure</li>
                <li><i class="fa fa-file-text-o signin-icon"></i> LESS &amp; SCSS source files</li>
                <li><i class="fa fa-outdent signin-icon"></i> RTL direction support</li>
                <li><i class="fa fa-heart signin-icon"></i> Crafted with love</li>
            </ul> <!-- / Info list -->
        </div>
        <!-- / Left side -->

        <!-- Right side -->
        <div class="signin-form">

            <!-- Form -->
            <?php $form = yii\bootstrap\ActiveForm::begin(['id' => 'signin-form_id', 'action' => $baseUrl . '/site/login', 'options' => ['class' => 'login-form']]); ?>

            <div class="signin-text">
                <span>Sign In to your account</span>
            </div> <!-- / .signin-text -->

            <div class="form-group w-icon">
                <input type="text" name="LoginForm[email]" id="username_id" class="form-control input-lg" placeholder="Username or email">
                <span class="fa fa-user signin-form-icon"></span>
            </div> <!-- / Username -->

            <div class="form-group w-icon">
                <input type="password" name="LoginForm[password]" id="password_id" class="form-control input-lg" placeholder="Password">
                <span class="fa fa-lock signin-form-icon"></span>
            </div> <!-- / Password -->

            <div class="form-actions">
                <input type="submit" value="SIGN IN" class="signin-btn bg-primary">
                <a href="#" class="forgot-password" id="forgot-password-link">Forgot your password?</a>
            </div> <!-- / .form-actions -->
            <?php yii\bootstrap\ActiveForm::end(); ?>
            <!-- / Form -->

            <!-- "Sign In with" block -->
            <div class="signin-with">
                <!-- Facebook -->
                <a href="#" class="signin-with-btn" style="background:#4f6faa;background:rgba(79, 111, 170, .8);">Sign In with <span>Facebook</span></a>
            </div>
            <!-- / "Sign In with" block -->

            <!-- Password reset form -->
            <div class="password-reset-form" id="password-reset-form">
                <div class="header">
                    <div class="signin-text">
                        <span>Password reset</span>
                        <div class="close">&times;</div>
                    </div> <!-- / .signin-text -->
                </div> <!-- / .header -->

                <!-- Form -->
                <form action="<?php echo $baseUrl; ?>/auth/auth/forgot" id="password-reset-form_id" method="post">
                    <div class="form-group w-icon">
                        <input type="text" name="password_reset_email" id="p_email_id" class="form-control input-lg" placeholder="Enter your email">
                        <span class="fa fa-envelope signin-form-icon"></span>
                    </div> <!-- / Email -->

                    <div class="form-actions">
                        <input type="submit" value="SEND PASSWORD RESET LINK" class="signin-btn bg-primary">
                    </div> <!-- / .form-actions -->
                </form>
                <!-- / Form -->
            </div>
            <!-- / Password reset form -->
        </div>
        <!-- Right side -->
    </div>
    <!-- / Container -->

    <div class="not-a-member">
        Not a member? <a href="<?php echo $baseUrl; ?>/auth/signup">Sign up now</a>
    </div>
</div>
<script type="text/javascript">
        // Resize BG
        init.push(function () {
            var $ph = $('#page-signin-bg'),
                    $img = $ph.find('> img');

            $(window).on('resize', function () {
                $img.attr('style', '');
                if ($img.height() < $ph.height()) {
                    $img.css({
                        height: '100%',
                        width: 'auto'
                    });
                }
            });
        });

        // Show/Hide password reset form on click
        init.push(function () {
            $('#forgot-password-link').click(function () {
                $('#password-reset-form').fadeIn(400);
                return false;
            });
            $('#password-reset-form .close').click(function () {
                $('#password-reset-form').fadeOut(400);
                return false;
            });
        });

        // Setup Sign In form validation
        init.push(function () {
            $("#signin-form_id").validate({focusInvalid: true, errorPlacement: function () {}});

            // Validate username
            $("#username_id").rules("add", {
                required: true,
                minlength: 3
            });

            // Validate password
            $("#password_id").rules("add", {
                required: true,
                minlength: 4
            });
        });

        // Setup Password Reset form validation
        init.push(function () {
            $("#password-reset-form_id").validate({focusInvalid: true, errorPlacement: function () {}});

            // Validate email
            $("#p_email_id").rules("add", {
                required: true,
                email: true
            });
        });

        window.PixelAdmin.start(init);
</script>