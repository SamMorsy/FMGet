<?php
/**
 * These functions are needed to load FMGet.
 *
 * @package FMGet
 */

if (!defined('FMGROOT')) {
    exit();
}

 /**
 * Polyfill the function str_contains if not available.
 * The function is available natively with PHP 8, it is wrapped in a function_exists() check.
 * 
 * 
 * @param string $haystack		The string to search in.
 * @param string $needle        The substring to search for in the haystack.
 * 
 * @return bool True if the substring is found, otherwise false.
 */
if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

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

	if ( version_compare( $required_php_version, $php_version, '>=' ) ) {

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
 * Will remove admin links to retrieve only return URLs not in the admin
 * directory.
 * Updated to work with defined url and with localhost
 *
 * @return string The guessed URL.
 */
function fmg_guess_url() {
	if ( defined( 'FMG_SITEURL' ) && '' !== FMG_SITEURL ) {
		$url = FMG_SITEURL;
	} else {
		$FMGROOT_fix         = str_replace( '\\', '/', FMGROOT );
		$script_filename_dir = dirname( $_SERVER['SCRIPT_FILENAME'] );

		// The request is for the admin.
		if ( str_contains( $_SERVER['REQUEST_URI'], 'admin' ) || str_contains( $_SERVER['REQUEST_URI'], 'admin.php' ) ) {
			$path = preg_replace( '#/(admin/?.*|admin\.php.*)#i', '', $_SERVER['REQUEST_URI'] );
		} else {
			if ( str_contains( $_SERVER['SCRIPT_FILENAME'], $FMGROOT_fix ) ) {
				// Request is hitting a file inside FMGROOT.
				$directory = str_replace( FMGROOT, '', $script_filename_dir );
				// Strip off the subdirectory, and any file/query params.
				$path = preg_replace( '#/' . preg_quote( $directory, '#' ) . '/[^/]*$#i', '', $_SERVER['REQUEST_URI'] );
			} elseif ( str_contains( $FMGROOT_fix, $script_filename_dir ) ) {
				// Request is hitting a file above FMGROOT.
				$subdirectory = substr( $FMGROOT_fix, strpos( $FMGROOT_fix, $script_filename_dir ) + strlen( $script_filename_dir ) );
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

/**
 * Retrieve the value of a setting by its name.
 *
 * @param string $name The name of the setting to look for.
 * @return string The value of the setting or 'unknown' if not found.
 */
function get_setting(string $name): string
{
    $pdo = new PDO('sqlite:' . FMGROOT . FMGINC . '/data/' . FMG_SQLITE_NAME);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('SELECT value FROM settings WHERE name = :name');
    $stmt->bindParam(':name', $name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['value'] : 'unknown';
}

/**
 * Set or update the value of a setting by its name.
 *
 * @param string $name The name of the setting.
 * @param string $value The value to set.
 * @return void
 */
function set_setting(string $name, string $value): void
{
    $pdo = new PDO('sqlite:' . FMGROOT . FMGINC . '/data/' . FMG_SQLITE_NAME);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the setting already exists
    $stmt = $pdo->prepare('SELECT COUNT(*) as count FROM settings WHERE name = :name');
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    $exists = $stmt->fetch(PDO::FETCH_ASSOC)['count'] > 0;

    if ($exists) {
        // Update existing setting
        $stmt = $pdo->prepare('UPDATE settings SET value = :value WHERE name = :name');
    } else {
        // Insert new setting
        $stmt = $pdo->prepare('INSERT INTO settings (name, value) VALUES (:name, :value)');
    }

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':value', $value);
    $stmt->execute();
}

/**
 * Retrieve the 20 most recent log entries from the logs table.
 *
 * @return array An array of the 20 most recent log entries.
 */
function get_recent_logs(): array
{
    $pdo = new PDO('sqlite:' . FMGROOT . FMGINC . '/data/' . FMG_SQLITE_NAME);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT * FROM logs ORDER BY ROWID DESC LIMIT 20');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}