<?php
/**
 * User: itoumlilt
 * Date: 25/04/2018
 * Version: 1.1
 *
 * Page header components
 * To be included everywhere
 */
$PATH_TO_BASE = "../../";

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";


function get_topnav_html($current = 0) {
    ob_start();
    ?>
    <!-- *********** TOPNAV BAR ************** -->
    <div class="topnav" id="globalTopnav">
        <a <?php echo ($current == 1) ? "class='topnav-current'" : ""; ?>
                href="<?php echo URL_HOME; ?>">Home</a>
        <a <?php echo ($current == 2) ? "class='topnav-current'" : ""; ?>
                href="<?php echo URL_BLOG; ?>">Blog</a>
        <a <?php echo ($current == 3) ? "class='topnav-current'" : ""; ?>
                href="#" data-toggle="modal" data-target=".no-page-modal">Teaching</a>
        <a <?php echo ($current == 4) ? "class='topnav-current'" : ""; ?>
                href="<?php echo URL_ABOUT_ME; ?>">About Me</a>
        <a href="javascript:void(0);" class="icon" onclick="topnavFunction()">&#9776;</a>
    </div>
    <div class="modal fade no-page-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Oups!</h4>
                </div>
                <div class="modal-body">
                    This page is currently unavailable.
                </div>
            </div>
        </div>
    </div>
    <div class="topnav-bg-block" id="globalTopnavBgBlock"></div>
    <!-- *********** END TOPNAV BAR ************** -->
    <?php
    return ob_get_clean();
}

function get_header_banner_html()
{
    ob_start();
    ?>
    <!-- *********** HEADER BANNER ************** -->
    <header class="header">
        <div class="container">
            <a href="<?php echo BASE_URL; ?>">
            <img class="profile-image img-responsive pull-left"
                 src="<?php echo URL_IMAGES . "/profile.png"; ?>"
                 alt="Profile Photo" height="200" width="200"/>
            </a>
            <div class="profile-content pull-left">
                <h1 class="name">Ilyas Toumlilt</h1>
                <h2 class="desc">Distributed and Operating Systems PhD Student</h2>
                <ul class="social list-inline">
                    <li><a href="<?php echo URL_LINKEDIN;?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="<?php echo URL_TWITTER;?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="<?php echo URL_G_SCHOLAR;?>" target="_blank"><i class="fab fa-google"></i></a></li>
                    <li><a href="<?php echo URL_GITHUB;?>" target="_blank"><i class="fab fa-github"></i></a></li>
                    <li><a href="<?php echo URL_GITLAB;?>" target="_blank"><i class="fab fa-gitlab"></i></a></li>
                    <li><a href="<?php echo URL_CODERWALL;?>" target="_blank"><i class="fas fa-code"></i></a></li>
                    <li class="last-item"><a href="<?php echo URL_INSTAGRAM;?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div><!--//profile-->
            <a class="btn btn-cta-primary pull-right"
               href="mailto:<?php echo EMAIL_DEFAULT; ?>" target="_blank"><i
                    class="fas fa-paper-plane"></i> Contact Me</a>
        </div><!--//container-->
    </header><!--//header-->
    <!-- *********** END HEADER BANNER ************** -->
    <?php
    return ob_get_clean();
}