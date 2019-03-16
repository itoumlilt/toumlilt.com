<?php
/**
 * This file contains the default HTML header part
 * for all websites www
 * to be included everywhere
 */

$PATH_TO_BASE = "../../";

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";

/**
 * @param $page_title String to append the HTML title.
 * @return string
 */
function get_global_html_header($page_title) {
    ob_start();
    ?>
    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
    <!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <title>
            IT
            <?php
            if (!empty($page_title)) {
                echo " | " . $page_title;
            }
            ?>
        </title>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Ilyas Toumlilt personal website">
        <meta name="author" content="itoumlilt">
        <link rel="shortcut icon" href="<?php echo URL_IMAGES . "/favicon.ico";?>">
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <!-- Global CSS -->
        <link rel="stylesheet" href="<?php echo URL_LIBS . "/bootstrap/css/bootstrap.css";?>">
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="<?php echo URL_LIBS . "/font-awesome/css/all.css";?>">
        <!-- github acitivity css -->
        <link rel="stylesheet" href="<?php echo URL_LIBS . "/github-activity/github-activity.css";?>">
        <!-- Theme CSS -->
        <link id="theme-style" rel="stylesheet" href="<?php echo URL_CSS . "/theme-style.css";?>">
        <!-- Topnav CSS -->
        <link rel="stylesheet" href="<?php echo PATH_CSS . "/topnav.css";?>">
        <!-- JQuery -->
        <script
            type="text/javascript"
            src="<?php echo URL_LIBS . "/jquery-1.11.1.min.js"; ?>">
        </script>
        <script
            type="text/javascript"
            src="<?php echo URL_LIBS . "/jquery-migrate-1.2.1.min.js"; ?>">
        </script>
        <!-- Bootstrap -->
        <script
            type="text/javascript"
            src="<?php echo URL_LIBS . "/bootstrap/js/bootstrap.min.js"; ?>">
        </script>
        <!-- JQuery RSS -->
        <script
            type="text/javascript"
            src="<?php echo URL_LIBS . "/jquery-rss/dist/jquery.rss.min.js"; ?>">
        </script>
        <!-- Font Awesome SVG -->
        <?php // --- DISABLED
        /*
        <script
                type="text/javascript"
                src="<?php echo URL_LIBS . "/font-awesome/js/all.js"; ?>">
        </script>
        */
        ?>
        <!-- Github Activity JS -->
        <script
                type="text/javascript"
                src="<?php echo URL_LIBS . "/mustache.js/0.7.2/mustache.min.js"; ?>">
        </script>
        <script
            type="text/javascript"
            src="<?php echo URL_LIBS . "/github-activity/github-activity.js"; ?>">
        </script>
    </head>
    <?php
    return ob_get_clean();
}