<?php

defined('DS') ? null : define("DS", DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'var' . DS . 'www' . DS . 'html' . DS . 'gallery');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'icludes');

require_once("/var/www/html/gallery/admin/includes/functions.php");
require_once("/var/www/html/gallery/admin/includes/new_config.php");
require_once("/var/www/html/gallery/admin/includes/database.php");
require_once("/var/www/html/gallery/admin/includes/user.php");
require_once("/var/www/html/gallery/admin/includes/photo.php");
require_once("/var/www/html/gallery/admin/includes/session.php");
require_once("/var/www/html/gallery/admin/includes/db_object.php");
require_once("/var/www/html/gallery/admin/includes/comment.php");
require_once("/var/www/html/gallery/admin/includes/paginate.php");


?>