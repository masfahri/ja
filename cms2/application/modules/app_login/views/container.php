<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?= base_url().getConfig()['favicon'] ?>" sizes="16x16">
    <link rel="icon" type="image/png" href="<?= base_url().getConfig()['favicon'] ?>" sizes="32x32">

    <title>Mini Inc - Login Page</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="<?= config_item('assets') ?>bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- admin login page -->
    <link rel="stylesheet" href="<?= config_item('assets_css') ?>login_page.min.css" />

</head>
<body class="login_page">
    <div class="container-fluid">
    <!-- contents put here --> 
    <?= $contents; ?>
    <!-- end content --->  
    </div>
    
    <!-- common functions -->
    <script src="<?= config_item('assets_js') ?>common.min.js"></script>
    <!-- uikit functions -->
    <script src="<?= config_item('assets_js') ?>uikit_custom.min.js"></script>
    <!-- altair core functions -->
    <script src="<?= config_item('assets_js') ?>altair_admin_common.min.js"></script>

    <!-- login page functions -->
    <script src="<?= config_item('assets_js') ?>pages/login.min.js"></script>

</body>
</html>