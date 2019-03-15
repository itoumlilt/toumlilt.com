<?php
/**
 * User: itoumlilt
 * Date: 27/04/2018
 * Version: 1.1
 */

$PATH_TO_BASE = "../../";

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";
require_once $ABS_PATH_TO_BASE . "src/articles/articles_env.php";
require_once $ABS_PATH_TO_BASE . "src/articles/articles_api.php";

function HV_articles_pl_browse() {
    ob_start();
    ?>
    <!-- ******************* PL ARTICLES BROWSE ******************** -->
    <section class="latest section">
        <div class="section-inner">
            <h2 class="heading">ARTICLES & PROJECTS</h2>
            <div class="content">
                <?php
                $all_ids = get_articles_ids();
                $nb_ids = count($all_ids);
                $nb_pages = ceil($nb_ids / ARTICLES_PAGE_LIMIT);

                if (isset($_GET['article']) && ctype_digit($_GET['article'])) {
                    echo article_xpath_to_wide_html(parse_article_xml(article_id_to_filepath($_GET['article'])), true);
                } else {
                    // check np (nb page) value
                    if (isset($_GET['np'])
                        && ctype_digit($_GET['np'])
                        && 0 < $_GET['np']
                        && $_GET['np'] <= $nb_pages
                    ) {
                        $page = $_GET['np'];
                    } else {
                        $page = 1;
                    }

                    if ($nb_ids == 0) {
                        echo no_article_html();
                    } else {
                        // print articles
                        rsort($all_ids, SORT_NUMERIC);
                        $ids = array_chunk($all_ids, ARTICLES_PAGE_LIMIT);
                        echo ids_to_wide_HTML($ids[$page - 1]);

                        // www
                        echo "\n\n<hr class='divider' />\n\n";
                        echo articles_pages_nav($page, $nb_pages);
                    }

                }
                ?>
            </div><!--//content-->
        </div><!--//section-inner-->
    </section><!--//section-->
    <!-- ******************* END PL ARTICLES BROWSE ******************** -->
    <?php
    return ob_get_clean();
}

function HV_articles_pl_back_home() {
    ob_start();
    ?>
    <!-- ******************* PL BACK HOME ******************** -->
    <section class="about section">
        <div class="section-inner">
            <h2 class="heading">
                <a href="<?php echo URL_HOME; ?>">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Home Page
                </a>
            </h2>
        </div><!--//section-inner-->
    </section><!--//section-->
    <!-- ******************* END PL BACK HOME ******************** -->
    <?php
    return ob_get_clean();
}

function HV_articles_primary_layer() {
    ob_start();
    ?>
    <!-- ====================== MAIN PRIMARY LAYER ====================== -->
    <div class="primary col-md-8 col-sm-12 col-xs-12">
        <?php
        echo HV_articles_pl_browse();
        echo HV_articles_pl_back_home();
        ?>
    </div><!--//primary-->
    <!-- ====================== END MAIN PRIMARY LAYER ====================== -->
    <?php
    return ob_get_clean();
}