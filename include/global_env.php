<?php

/**
 * Global Env set
 * Must be included in all php files
 *
 * Created By: itoumlilt
 * Date: 25/04/2018
 * Version: 1.1
 */
$PATH_TO_BASE="../"; // must end with "/"

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;

require_once $ABS_PATH_TO_BASE . 'config.php';

/* DEBUG MODE, do not uncomment if pushed to the server ! */
if(CONFIG_DEBUG_MODE == 1) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

// session_start();

/************** Base URL **************/
define("SERV_ADDR", CONFIG_SERV_ADDR);
define("ABS_PATH", CONFIG_ABS_PATH);
define("BASE_URL", SERV_ADDR . ABS_PATH);

/************** Specific internal URLs ***************/
define("URL_ASSETS", BASE_URL . "/assets");
define("URL_IMAGES", URL_ASSETS . "/images");
define("URL_LIBS", URL_ASSETS . "/libs");
define("URL_CSS", URL_ASSETS . "/css");
define("URL_JS", URL_ASSETS. "/js");

define("URL_HOME", BASE_URL . "/index");
define("URL_BLOG", BASE_URL . "/blog");

/************** Specific internal PATHs ***************/
define("PATH_ASSETS", ABS_PATH . "/assets");
define("PATH_IMAGES", PATH_ASSETS . "/images");
define("PATH_LIBS", PATH_ASSETS . "/libs");
define("PATH_CSS", PATH_ASSETS . "/css");

/************** Specific external URLs ***************/
define("URL_TWITTER", "http://twitter.com/ilyasToumlilt");
define("URL_GPLUS", "http://plus.google.com/111233966230992994575");
define("URL_LINKEDIN", "http://fr.linkedin.com/in/ilyastoumlilt");
define("URL_GITHUB", "https://github.com/ilyasToumlilt");
define("URL_CODERWALL", "https://coderwall.com/ilyastoumlilt");

/************** EMAILs ***************/
define("EMAIL_DEFAULT", "ilyas@toumlilt.com");
define("EMAIL_LIP6", "ilyas.toumlilt@lip6.fr");