<style>
    .navbar {
        position: relative;
        min-height: 50px;
        margin-bottom: 0px;
        border: 1px solid transparent;
    }

    .navbar-default {
        background-color: #fff;/*rgba(0,0,0,.0001);
        border-color: #e7e7e7;*/
        border-color: #fff;
    }
    .dropdown {
        /* width: 130.9px; */
        display: inline-block;
        padding: 0px 15px 0px;
        /* padding: 40px 10px 35px; */
        /* border: 1px solid #f5f3ef; */
        font-size: 18px;
        text-align: center;
    }
    .dropdown-menu{
        margin-top: -0px !important;
        border: 0px !important;
        width: 300px !important;

    }
    .dropdown-menu > li.kopie > a {
        padding-left:5px;
        top: 0px;
    }

    .dropdown-submenu {
        position:relative;
    }
    .dropdown-submenu>.dropdown-menu {
        top:0;left:100%;
        margin-top:-6px;margin-left:-1px;
        -webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;
    }

    .dropdown-submenu > a:after {
        border-color: transparent transparent transparent #333;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        content: " ";
        display: block;
        float: right;
        height: 0;
        margin-right: -10px;
        margin-top: 5px;
        width: 0;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color:#555;
    }

    .dropdown-menu > li > a:hover, .dropdown-menu > .active > a:hover {
        text-decoration: none;
    }

    @media (max-width: 767px) {

        .navbar-nav  {
            display: inline;
            font-size: 18px;
        }
        .navbar-default .navbar-brand {
            display: inline;
        }
        .navbar-default .navbar-toggle .icon-bar {
            background-color: #fff;
        }
        .navbar-default .navbar-nav .dropdown-menu > li > a {
            color: red;
            background-color: #ccc;
            border-radius: 4px;
            margin-top: 2px;
        }
        .navbar-default .navbar-nav .open .dropdown-menu > li > a {
            color: #333;
        }
        .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
        .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
            background-color: #ccc;
        }

        .navbar-nav .open .dropdown-menu {
            border-bottom: 1px solid white;
            border-radius: 0;
        }
        .dropdown-menu {
            padding-left: 10px;
        }
        .dropdown-menu .dropdown-menu {
            padding-left: 20px;
        }
        .dropdown-menu .dropdown-menu .dropdown-menu {
            padding-left: 30px;
        }
        li.dropdown.open {
            border: 0px solid red;
        }

    }

    @media (min-width: 768px) {
        ul.nav li:hover > ul.dropdown-menu {
            display: block;
        }
        #navbar {
            text-align: center;
        }
    }

</style>
<div class="bg-white">
    <div class="container">
        <div id="navbar">
            <nav class="navbar navbar-default navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="#">CATEGORIES</a>-->
                </div>

                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <!--<li class="active"><a href="#">CLEARANCE</a></li>
                        <li><a href="#">POMOTION</a></li>-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown">CATEGORIES <!--<b class="caret"></b>--></a>
                            <ul class="dropdown-menu">
                                <li class="kopie"><a href="#">Dropdown</a></li>
                                <li><a href="#">Dropdown Link 1</a></li>
                                <li class="active"><a href="#">Dropdown Link 2</a></li>
                                <li><a href="#">Dropdown Link 3</a></li>

                                <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Link 4</a>
                                    <ul class="dropdown-menu">
                                        <li class="kopie"><a href="#">Dropdown Link 4</a></li>
                                        <li><a href="#">Dropdown Submenu Link 4.1</a></li>
                                        <li><a href="#">Dropdown Submenu Link 4.2</a></li>
                                        <li><a href="#">Dropdown Submenu Link 4.3</a></li>
                                        <li><a href="#">Dropdown Submenu Link 4.4</a></li>

                                    </ul>
                                </li>

                                <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Link 5</a>
                                    <ul class="dropdown-menu">
                                        <li class="kopie"><a href="#">Dropdown Link 5</a></li>
                                        <li><a href="#">Dropdown Submenu Link 5.1</a></li>
                                        <li><a href="#">Dropdown Submenu Link 5.2</a></li>
                                        <li><a href="#">Dropdown Submenu Link 5.3</a></li>

                                        <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Submenu Link 5.4</a>
                                            <ul class="dropdown-menu">
                                                <li class="kopie"><a href="#">Dropdown Submenu Link 5.4</a></li>
                                                <li><a href="#">Dropdown Submenu Link 5.4.1</a></li>
                                                <li><a href="#">Dropdown Submenu Link 5.4.2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">CLEARANCE <!--<b class="caret"></b>--></a>
                            <ul class="dropdown-menu">
                                <li class="kopie"><a href="#">Dropdown2</a></li>
                                <li><a href="#">Dropdown2 Link 1</a></li>
                                <li><a href="#">Dropdown2 Link 2</a></li>
                                <li><a href="#">Dropdown2 Link 3</a></li>

                                <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown2 Link 4</a>
                                    <ul class="dropdown-menu">
                                        <li class="kopie"><a href="#">Dropdown2 Link 4</a></li>
                                        <li><a href="#">Dropdown2 Submenu Link 4.1</a></li>
                                        <li><a href="#">Dropdown2 Submenu Link 4.2</a></li>
                                        <li><a href="#">Dropdown2 Submenu Link 4.3</a></li>
                                        <li><a href="#">Dropdown2 Submenu Link 4.4</a></li>

                                    </ul>
                                </li>
                                <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown2 Link 5</a>
                                    <ul class="dropdown-menu">
                                        <li class="kopie"><a href="#">Dropdown Link 5</a></li>
                                        <li><a href="#">Dropdown2 Submenu Link 5.1</a></li>
                                        <li><a href="#">Dropdown2 Submenu Link 5.2</a></li>
                                        <li><a href="#">Dropdown2 Submenu Link 5.3</a></li>
                                        <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Submenu Link 5.4</a>
                                            <ul class="dropdown-menu">
                                                <li class="kopie"><a href="#">Dropdown2 Submenu Link 5.4</a></li>
                                                <li><a href="#">Dropdown2 Submenu Link 5.4.1</a></li>
                                                <li><a href="#">Dropdown2 Submenu Link 5.4.2</a></li>

                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#" style="font-size: 18px;">POMOTION</a></li>
                        <li><a href="<?= Yii::$app->homeUrl ?>brands" style="font-size: 18px;">BRANDS</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>
</div>



