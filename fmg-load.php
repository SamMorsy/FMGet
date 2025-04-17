<?php
/**
 * Loading file for setting the FMGROOT constant, Start / resume the session
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


/*
 * Start / resume the session
 * 
 * We don't use the option cookie_lifetime because we wont include remember me feature with this version.
 * If it's an old version fmg_check_server(); will exit.
 * 
 */
if (PHP_VERSION_ID > 70300) {
    session_start([
        'use_strict_mode' => true,      // Enforce strict mode to prevent session fixation
        'use_cookies' => true,          // Ensure sessions use cookies
        'use_only_cookies' => true,     // Disable session ID passing via URL
        'cookie_httponly' => true,      // Prevent JavaScript access to session cookie
        'cookie_secure' => true,        // Use secure cookies only over HTTPS
        'cookie_samesite' => 'Strict',  // Prevent CSRF attacks by restricting cross-site cookies
        'gc_maxlifetime' => 86400,      // Set garbage collection max lifetime
        'sid_length' => 96,             // Increase session ID entropy
        'sid_bits_per_character' => 6,  // Improve session ID complexity
    ]);
}



/** Define FMGROOT as this file's directory */
if (!defined('FMGROOT')) {
    define('FMGROOT', __DIR__ . '/');
}




/*
 * The error_reporting() function can be disabled in php.ini
 * Initialize error reporting to a known set of levels, it is wrapped in a function_exists() check.
 * 
 * This one has 2 option, for production error_reporting(0); is recommended 
 */
if (function_exists('error_reporting')) {
    //error_reporting(0);
    error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR);
}



// Define the include / admin folders.
define('FMGINC', 'includes');
define('FMGADM', 'admin');


require_once FMGROOT . FMGINC . '/version.php';
require_once FMGROOT . FMGINC . '/functions.php';



// Check for the required PHP version.
fmg_check_server();




/**
 * Declare the global array for holding the translations
 * @global string $fmg_translations loaded language package.
 */
$fmg_translations = [];




/*
 * If fmg-config.php exists in the FMGet root, load fmg-config.php.
 * If the condition is true, initiate loading the setup process.
 */
if (file_exists(FMGROOT . 'fmg-config.php')) {

    /** The config file exists */
    require_once FMGROOT . 'fmg-config.php';

    // Update the time zone.
    date_default_timezone_set(FMG_TIMEZONE);

    // Load language files.
    require_once FMGROOT . FMGINC . '/languages/translations.php';

} else {
    
    // A config file doesn't exist.
    $path = fmg_guess_url() . '/admin/setup-config.php';

    // Redirect to setup-config.php.
    if (!str_contains($_SERVER['REQUEST_URI'], 'setup-config')) {
        header('Location: ' . $path);
        exit;
    }
}