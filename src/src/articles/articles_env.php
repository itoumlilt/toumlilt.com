<?php
/**
 */

$PATH_TO_BASE = "../../"; // must end with "/"

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";

// PATHs
define("PATH_DATA_ARTICLES", $ABS_PATH_TO_BASE . "./data/articles");
define("PATH_IMG_ARTICLES", PATH_IMAGES . "/blogarticles");

// Articles file format (SUF_<number>EXT)
define("ARTICLES_FILE_SUF", "blogarticle_");
define("ARTICLES_FILE_EXT", ".xml");

// LIMITS
define("ARTICLES_PAGE_LIMIT", 5);

// MAIN XML DICTIONNARY
define("ARTICLES_MAIN_TAG", "blogarticle");
$ARTICLES_XML_TAGS = array( // IMPORTANT : all must be filled
    "name", // An string identifier
    "date", // dd/mm/yyyy
    "etitle", // Printed title
    "esummary", // string | null
    "externallink", // url | null
    "githublink", // url | null
    "smallimg", // path (relative from PATH_IMG_ARTICLES)
    "wideimg", // path (relative from PATH_IMG_ARTICLES)
    "fulltext", // string
    "shorttext", // string
    "veryshorttext" // string
);
