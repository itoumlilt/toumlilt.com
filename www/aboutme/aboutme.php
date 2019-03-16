<?php

$PATH_TO_BASE = "../../"; // must end with "/"
$PAGE_TITLE = "Blog"; // set this var if you wan't to append the page nav title

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";
require_once $ABS_PATH_TO_BASE . "src/global/html_header.php";
require_once $ABS_PATH_TO_BASE . "src/global/html_footer.php";
require_once $ABS_PATH_TO_BASE . "src/global/header.php";
require_once $ABS_PATH_TO_BASE . "src/global/secondary_layer.php";
require_once $ABS_PATH_TO_BASE . "src/aboutme/primary_layer.php";

echo get_global_html_header($PAGE_TITLE);

?>

    <body>
<?php
echo get_topnav_html(4);
echo get_header_banner_html();
?>

    <div class="container sections-wrapper">
        <div class="row">
            <?php
            echo HV_aboutme_primary_layer();
            echo htmlview_default_secondary_layer();
            ?>
        </div><!--//row-->
    </div><!--//container sections-wrapper-->

<?php
echo get_html_footer();