<?php

defined('DS') ? null : define("DS", DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'var' . DS . 'www' . DS . 'html' . DS . 'gallery');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'icludes');

require_once("functions.php");
require_once("new_config.php");
require_once("database.php");
require_once("user.php");
require_once("photo.php");
require_once("session.php");
require_once("db_object.php");

?>