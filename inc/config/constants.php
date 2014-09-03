<?php

define("APP_DEFAULT_CONTROLLER", "main");
define('APP_BASE_URL', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('APP_BASE_PATH', realpath(__DIR__.DIRECTORY_SEPARATOR.'/../../'));
define('APP_DB_HOST', 'localhost');
define('APP_DB_DATABASE', 'shop_st');
define('APP_DB_USER', 'root');
define('APP_DB_PASS', '');
define('APP_DB_PREFIX', 'st_');
define('APP_DEBUG_MODE', TRUE);
define('APP_COUNT_PAGES', 10);
