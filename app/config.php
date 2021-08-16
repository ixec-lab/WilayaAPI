<?php

/* ONLY in dev mod */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* App path */
define("APP_PATH",realpath(dirname(__FILE__)));

/* Controllers path */
define("CONTROLLERS_NAMESPACE","WILAYAPI\\Controllers\\");

/* Views path */
define("VIEWS_PATH",APP_PATH . "/views/");

/* some constant strings*/
define("NOT_FOUND_CONTROLLER","NotFoundController");
define("NOT_FOUND_ACTION","notFoundAction");

define("ICONS_PATH","/app/views/static/");
define("CSS_PATH","/app/views/static/css/");
?>