<?php
if(!isset($_SESSION)) { session_start(); }

if(isAnyUserLoggedIn()) {
    $sessionActive = true;
} else if(strpos($_SERVER["SCRIPT_FILENAME"],'/claims/listing') !== false) {
    header("Location:/login/");
    exit();
}

?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title><?php echo $template['title'] ?></title>

        <meta name="description" content="<?php echo $template['description'] ?>">
        <meta name="author" content="<?php echo $template['author'] ?>">
        <meta name="robots" content="<?php echo $template['robots'] ?>">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="/favicon.png">
        <!--<link rel="apple-touch-icon" href="img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="img/icon180.png" sizes="180x180">-->
        <!-- END Icons -->

        <!-- Stylesheets -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/plugins.css">
        <link rel="stylesheet" href="/css/main.css?v=<?= microtime(true) ?>">
        <link rel="stylesheet" href="/css/themes.css">
        <link rel="stylesheet" href="/css/styles.css?v=<?= microtime(true) ?>">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="/js/vendor/modernizr.min.js"></script>
    </head>
    <body>