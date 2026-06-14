<?php

/**
 */

$PATH_TO_BASE = "../../";

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";
require_once $ABS_PATH_TO_BASE . "src/articles/articles_env.php";

/* * *****************************************************************************
 * FS
 * **************************************************************************** */

function get_articles_filenames()
{
    $ret = array();
    if (!file_exists(PATH_DATA_ARTICLES))
        return $ret;
    $scan_array = scandir(PATH_DATA_ARTICLES);
    if (!$scan_array)
        return $ret;
    $ret = preg_grep("/^" . ARTICLES_FILE_SUF . "(\d)+\.xml$/", $scan_array);
    if (!$ret)
        return array();
    return $ret;
}

function article_filename_to_id($filename)
{
    $tmp = explode(".", basename($filename));
    $tmp2 = explode("_", $tmp[0]);
    return $tmp2[1];
}

function get_articles_ids()
{
    $ret = array();
    $filenames = get_articles_filenames();
    foreach ($filenames as $file) {
        $tmp = explode(".", $file);
        $tmp2 = explode("_", $tmp[0]);
        $ret[] = $tmp2[1];
    }
    return $ret;
}

function count_articles()
{
    return count(get_articles_filenames());
}

function article_id_to_filepath($id)
{
    return PATH_DATA_ARTICLES . "/" . ARTICLES_FILE_SUF . $id . ARTICLES_FILE_EXT;
}

/* * *****************************************************************************
 * xPath
 * **************************************************************************** */
function parse_article_xml($filename)
{
    $xml = new SimpleXMLElement(file_get_contents($filename));

    $blog_article = array();
    global $ARTICLES_XML_TAGS;
    foreach ($ARTICLES_XML_TAGS as $tag) {
        $xml_xpath = $xml->xpath('/' . ARTICLES_MAIN_TAG . "/" . $tag);
        $blog_article[$tag] = preg_replace("/<\/?$tag>/", '', trim($xml_xpath[0]->asXML()));
    }
    $blog_article['id'] = article_filename_to_id($filename);

    // append paths with the assests base path :
    $blog_article['smallimg'] = PATH_IMG_ARTICLES . $blog_article['smallimg'];
    $blog_article['wideimg'] = PATH_IMG_ARTICLES . $blog_article['wideimg'];

    return $blog_article;
}

/* * *****************************************************************************
 * Utils
 * **************************************************************************** */
function article_id_to_URL($id)
{
    return URL_BLOG . "?article=$id";
}

/* * *****************************************************************************
 * xPath to HTML
 * **************************************************************************** */
/**
 * Wide HTML is the one view with the big picture
 *
 * @param $article_xpath array xpath with the parsed XML info
 * @param bool $full_text set to true to have the full text displayed
 * @return string
 */
function article_xpath_to_wide_html($article_xpath, $full_text = false)
{
    ob_start();
?>
    <!-- _________________ <?php echo $article_xpath['name']; ?> ________________ -->
    <div class="item featured text-center">
        <h3 class="title">
            <a href="<?php echo article_id_to_URL($article_xpath['id']); ?>" target="_blank">
                <?php echo $article_xpath['etitle']; ?>
            </a>
        </h3>
        <?php
        if ($article_xpath['esummary'] != "null") {
        ?>
            <p class="summary">
                <?php echo $article_xpath['esummary']; ?>
            </p>
        <?php
        }
        ?>
        <div class="featured-image">
            <a href="<?php echo article_id_to_URL($article_xpath['id']); ?>" target="_blank">
                <img class="img-responsive project-image" src="<?php echo $article_xpath['wideimg']; ?>" alt="<?php echo $article_xpath['name']; ?>" />
            </a>
            <div class="ribbon">
                <?php
                // TODO convert date to region format
                ?>
                <div class="text"><?php echo $article_xpath['date']; ?></div>
            </div>
        </div>

        <div class="desc text-left">
            <?php
            if ($full_text)
                echo $article_xpath['fulltext'];
            else
                echo $article_xpath['shorttext'];
            ?>
        </div>
        <!--//desc-->
        <?php
        if ($article_xpath['githublink'] != "null") {
        ?>
            <a class="btn btn-cta-secondary" href="<?php echo $article_xpath['githublink']; ?>" target="_blank">
                <i class="fa-brands fa-github"></i>
                View on Github
            </a>
        <?php
        }
        if ($article_xpath['externallink'] != "null") {
        ?>
            <a class="btn btn-cta-secondary" href="<?php echo $article_xpath['externallink']; ?>" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                More details
            </a>
        <?php
        }
        if (
            $article_xpath['githublink'] == "null"
            && $article_xpath['externallink'] == "null"
            && !$full_text
        ) {
        ?>
            <a class="btn btn-cta-secondary" href="<?php echo article_id_to_URL($article_xpath['id']); ?>" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                More details
            </a>
        <?php
        }
        ?>
    </div>
    <!--//item-->
    <!-- _________________ END <?php echo $article_xpath['name']; ?> ________________ -->
<?php
    return ob_get_clean();
}

/**
 * Small image with shorttext and links
 *
 * @param $article_xpath
 * @return string
 */
function article_xpath_to_small_html($article_xpath)
{
    ob_start();
?>
    <!-- _________________ <?php echo $article_xpath['name']; ?> ________________ -->
    <div class="item row">
        <a class="col-md-4 col-sm-4 col-xs-12" href="<?php echo article_id_to_URL($article_xpath['id']); ?>" target="_blank">
            <img class="img-responsive project-image" src="<?php echo $article_xpath['smallimg']; ?>" alt="<?php echo $article_xpath['name']; ?>" />
        </a>
        <div class="desc col-md-8 col-sm-8 col-xs-12">
            <h3 class="title">
                <a href="<?php echo article_id_to_URL($article_xpath['id']); ?>" target="_blank">
                    <?php echo $article_xpath['etitle']; ?>
                </a>
            </h3>
            <?php echo $article_xpath['shorttext']; ?>
            <?php
            if ($article_xpath["githublink"] != null) {
            ?>
                <p><a class="more-link" href="<?php echo $article_xpath['githublink']; ?>" target="_blank"><i class="fa-brands fa-github">
                        </i> View on github</a>
                </p>
            <?php
            }
            if ($article_xpath["externallink"] != null) {
            ?>
                <p><a class="more-link" href="<?php echo $article_xpath['externallink']; ?>" target="_blank"><i class="fas fa-external-link-alt">
                        </i> External link</a>
                </p>
            <?php
            }

            ?>
            <p><a class="more-link" href="<?php echo article_id_to_URL($article_xpath['id']); ?>"><i class="fas fa-external-link-alt">
                    </i> More details ...</a>
            </p>
        </div>
        <!--//desc-->
    </div>
    <!--//item-->
    <!-- _________________ END <?php echo $article_xpath['name']; ?> ________________ -->
<?php
    return ob_get_clean();
}


/* * *****************************************************************************
 * ids to HTML
 * **************************************************************************** */
function ids_to_wide_HTML($ids)
{
    $ret = "";
    $i = 0;
    foreach ($ids as $id) {
        $ret .= article_xpath_to_wide_html(parse_article_xml(article_id_to_filepath($id)));
        if (++$i != count($ids))
            $ret .= "\n\n<hr class='divider' />\n\n";
    }
    return $ret;
}

function ids_to_small_HTML($ids)
{
    $ret = "";
    $i = 0;
    foreach ($ids as $id) {
        $ret .= article_xpath_to_small_html(parse_article_xml(article_id_to_filepath($id)));
        if (++$i != count($ids))
            $ret .= "\n\n<hr class='divider' />\n\n";
    }
    return $ret;
}

/* * *****************************************************************************
 * no article HTML
 * **************************************************************************** */
function no_article_html()
{
    ob_start();
?>
    <!-- _________________ NO ARTICLE ________________ -->
    <div class="item featured text-center">
        No article ... Stay tuned !
    </div>
    <!--//item-->
    <!-- _________________ END NO ARTICLE ________________ -->
<?php
    return ob_get_clean();
}

/* * *****************************************************************************
 * Pages navigation
 * **************************************************************************** */
function articles_pages_nav($page, $nb_pages)
{
    ob_start();
?>
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-lg">
            <li <?php echo ($page == 1) ? "class='disabled'" : ""; ?>>
                <a href="<?php echo URL_BLOG . "?np=1"; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for ($i = 1; $i <= $nb_pages; $i++) {
            ?>
                <li class="<?php echo ($page == $i) ? "active" : ""; ?>">
                    <a href="<?php echo URL_BLOG . "?np=" . $i; ?>">
                        <?php echo $i; ?>
                        <?php if ($page == $i) {
                        ?>
                            <span class="sr-only">(current)</span>
                        <?php
                        }
                        ?>
                    </a>
                </li>
            <?php
            }
            ?>
            <li <?php echo ($page == $nb_pages) ? "class='disabled'" : ""; ?>>
                <a href="<?php echo URL_BLOG . "?np=" . $nb_pages; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
<?php
    return ob_get_clean();
}
