<?php
if (!file_exists("config.php")) {
    header("Location: install/");
}

require_once 'db.php';
$helper = new DB();
if (session_id() == '') {
    session_start();
}


if ($helper->Is_logged()) {

    header("Location: dashbord.php");
} else {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if ($helper->LoginUser($_POST['username'], $_POST['password'])) {
            header("Location: dashbord.php");
        } else {
            echo 'Wrong Username / Password !';
        }
    }
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8"> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
    <head>
        <title>GCM Implemantation Admin Panel</title>

        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

        <!-- Bootstrap -->
        <link href="common/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link href="common/bootstrap/css/responsive.css" rel="stylesheet" />

        <!-- Glyphicons Font Icons -->
        <link href="common/theme/css/glyphicons.css" rel="stylesheet" />

        <!-- Uniform Pretty Checkboxes -->
        <link href="common/theme/scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" rel="stylesheet" />

        <!-- PrettyPhoto -->
        <link href="common/theme/scripts/plugins/gallery/prettyphoto/css/prettyPhoto.css" rel="stylesheet" />

        <!-- Main Theme Stylesheet :: CSS -->
        <link href="common/theme/css/style-light.css?1369414386" rel="stylesheet" />


    </head>
    <body class="login">

        <!-- Wrapper -->
        <div id="login">

            <!-- Box -->
            <div class="form-signin">
                <h3>Sign in to Your Account</h3>

                <!-- Row -->
                <div class="row-fluid row-merge">

                    <!-- Column -->
                    <div class="span12">
                        <div class="inner">

                            <!-- Form -->
                            <form method="post" action="">
                                <label class="strong">Username or Email</label>
                                <input type="text" name="username" class="input-block-level span6" placeholder="Your Username or Email address"/> 
                               
                                <input type="password" name="password" class="input-block-level span6" placeholder="Your Password"/> 

                                <div class="row-fluid">
                                    <div class="span5 center">
                                        <button class="btn btn-block btn-primary" type="submit">Sign in</button>
                                    </div>

                                </div>
                            </form>
                            <!-- // Form END -->

                        </div>
                    </div>
                    <!-- // Column END -->

                    <!-- Column -->

                    <!-- // Column END -->

                </div>
                <!-- // Row END -->

                <div class="ribbon-wrapper"><div class="ribbon primary">members</div></div>
            </div>
            <!-- // Box END -->

        </div>
        <!-- // Wrapper END -->	


</html>