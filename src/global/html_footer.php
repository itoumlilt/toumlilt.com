<?php
/**
 * User: itoumlilt
 * Date: 25/04/2018
 * Version: 1.1
 *
 * This file contains the default HTML footer part
 * for all websites www
 * to be included everywhere
 */
$PATH_TO_BASE = "../../";

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";

function get_html_footer() {
    ob_start();
    ?>
    <!-- ******FOOTER****** -->
    <footer class="footer">
        <div class="container text-center">
            <small class="copyright">Handcrafted with <span class="doc-heart"><i class="fa fa-heart"></i></span> and a lot of <i class="fa fa-coffee"></i> by Ilyas Toumlilt</small>
        </div><!--//container-->
    </footer><!--//footer-->

    <!-- main js -->
    <script
        type="text/javascript"
        src="<?php echo URL_JS . "/main.js"; ?>">
    </script>
    <!-- topnav js -->
    <script
        type="text/javascript"
        src="<?php echo URL_JS . "/topnav.js"; ?>">
    </script>

    </body>

    </html>

    <?php
    return ob_get_clean();
}