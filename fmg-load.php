<?php
/**
 * Loading file for setting the ABSPATH constant
 * and loading the fmg-config.php file. The fmg-config.php
 * file will then load the FileMaker server details and other global constants
 * which will then set up the FMGet environment.
 *
 * If the fmg-config.php file is not found then an error
 * will be displayed asking the visitor to set up the
 * fmg-config.php file.
 *
 * @package FMGet
 */

/** Define ABSPATH as this file's directory */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/*
 * The error_reporting() function can be disabled in php.ini
 * Initialize error reporting to a known set of levels, it is wrapped in a function_exists() check.
 */
if (function_exists('error_reporting')) {
    error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR);
}

// Define the include folder.
define('FMGINC', 'fmg-includes');


/**
 * Declare the global array for holding the translations
 * @global string $fmg_translations loaded language package.
 */
$fmg_translations = [];

/*
 * If fmg-config.php exists in the FMGet root, load fmg-config.php.
 * If the condition is true, initiate loading the setup process.
 */
if (file_exists(ABSPATH . 'fmg-config.php')) {

    /** The config file exists */
    require_once ABSPATH . 'fmg-config.php';

    require_once ABSPATH . FMGINC . '/version.php';
    require_once ABSPATH . FMGINC . '/functions.php';

    // Check for the required PHP version.
    fmg_check_server();

    // Register the shutdown handler for fatal errors as soon as possible.
    //fmg_register_fatal_error_handler();

    // FMG calculates offsets from UTC.
    date_default_timezone_set('UTC');

    // Load language files.
    //fmg_load_lang();

} else {

    // A config file doesn't exist.
    require_once ABSPATH . FMGINC . '/version.php';
    require_once ABSPATH . FMGINC . '/functions.php';

    define('FMGADM', 'fmg-admin');
    // Check for the required PHP version.
    fmg_check_server();

    define('FMG_CONTENT_DIR', ABSPATH . 'fmg-content');

    $path = fmg_guess_url() . '/fmg-admin/setup-config.php';

    // Redirect to setup-config.php.
    if (!str_contains($_SERVER['REQUEST_URI'], 'setup-config')) {
        header('Location: ' . $path);
        exit;
    }
}