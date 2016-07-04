<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

define('REQUEST_MICROTIME', microtime(true));


//$_SERVER['APPLICATION_ENV']

//if ('development' === 'development') {
    /** @FIXME */
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
//} else {
////    error_reporting(false);
////    ini_set("display_errors", 0);
//}

// Define file upload properties
ini_set('post_max_size', '1536M');
ini_set('upload_max_filesize', '1536M');
ini_set('memory_limit', '1536M');

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
