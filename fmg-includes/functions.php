<?php
/**
 * These functions are needed to load FMGet.
 *
 * @package FMGet
 */


 /**
 * Checks for the required PHP version.
 * ---- Add a full test for CURL in next update
 * ---- Add a SSL check in next update
 * Dies if requirements are not met.
 *
 * @global string $required_php_version The required PHP version string.
 * @global string $fmg_version           The FMGet version string.
 */
function fmg_check_server() {
	global $required_php_version, $fmg_version;

	$php_version = PHP_VERSION;

	if ( version_compare( $required_php_version, $php_version, '>' ) ) {

        fmg_die('<p>Your server is running PHP version ' . $php_version . ' but FMGet ' . $fmg_version . ' requires at least ' . $required_php_version .'.</p>');

	}

}

/**
 * Kills FMGet execution and displays HTML page with an error message.
 *
 * This function complements the `die()` PHP function. The difference is that
 * HTML will be displayed to the user. It is recommended to use this function
 * only when the execution should not continue any further.
 * 
 * Future update, Add a log functions
 *
 * @param string    $message        Optional. Error message. If this is empty, the error's messages are used.
 *                                  Default empty string.
 * @param string    $title          Optional. Error title. If `$message` is empty,
 *                                  error data with the key 'title' may be used to specify the title.
 *                                  Default FMGet.
 * @param string    $type           Optional. Error type. If this is not html, then exit without sending anything.
 *                                  Default html.
 */
function fmg_die( $message = '', $title = 'FMGet', $type = 'html' ) {

	if ( $type == 'html' && ! empty($message)) {
        require_once __DIR__ . '/error-message.php';
	}
    
    exit();
}

/**
 * Determines if SSL is used.
 *
 * @return bool True if SSL, otherwise false.
 */
function fmg_is_ssl() {
	if ( isset( $_SERVER['HTTPS'] ) ) {
		if ( 'on' === strtolower( $_SERVER['HTTPS'] ) ) {
			return true;
		}

		if ( '1' === (string) $_SERVER['HTTPS'] ) {
			return true;
		}
	} elseif ( isset( $_SERVER['SERVER_PORT'] ) && ( '443' === (string) $_SERVER['SERVER_PORT'] ) ) {
		return true;
	}

	return false;
}

/**
 * Guesses the URL for the site.
 *
 * Will remove fmg-admin links to retrieve only return URLs not in the fmg-admin
 * directory.
 * Updated to work with defined url and with localhost
 *
 * @return string The guessed URL.
 */
function fmg_guess_url() {
	if ( defined( 'FMG_SITEURL' ) && '' !== FMG_SITEURL ) {
		$url = FMG_SITEURL;
	} else {
		$abspath_fix         = str_replace( '\\', '/', ABSPATH );
		$script_filename_dir = dirname( $_SERVER['SCRIPT_FILENAME'] );

		// The request is for the admin.
		if ( str_contains( $_SERVER['REQUEST_URI'], 'fmg-admin' ) || str_contains( $_SERVER['REQUEST_URI'], 'fmg-admin.php' ) ) {
			$path = preg_replace( '#/(fmg-admin/?.*|fmg-admin\.php.*)#i', '', $_SERVER['REQUEST_URI'] );
		} else {
			if ( str_contains( $_SERVER['SCRIPT_FILENAME'], $abspath_fix ) ) {
				// Request is hitting a file inside ABSPATH.
				$directory = str_replace( ABSPATH, '', $script_filename_dir );
				// Strip off the subdirectory, and any file/query params.
				$path = preg_replace( '#/' . preg_quote( $directory, '#' ) . '/[^/]*$#i', '', $_SERVER['REQUEST_URI'] );
			} elseif ( str_contains( $abspath_fix, $script_filename_dir ) ) {
				// Request is hitting a file above ABSPATH.
				$subdirectory = substr( $abspath_fix, strpos( $abspath_fix, $script_filename_dir ) + strlen( $script_filename_dir ) );
				// Strip off any file/query params from the path, appending the subdirectory to the installation.
				$path = preg_replace( '#/[^/]*$#i', '', $_SERVER['REQUEST_URI'] ) . $subdirectory;
			} else {
				$path = $_SERVER['REQUEST_URI'];
			}
		}

		// Force https protocol if not localhost
		$schema = 'https://';
		$url    = $schema . $_SERVER['HTTP_HOST'] . $path;
	}

	return rtrim( $url, '/' );
}

