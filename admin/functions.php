<?php
/**
 * These functions are needed to setup / manage FMGet.
 *
 * @package FMGet
 */


/**
 * Updates existing constants in the fmg-config.php file or adds new ones.
 *
 * @param array $updates An associative array of constants names and their values
 * @return boolean
 */
function config_update($updates)
{
    $configFile = FMGROOT . 'fmg-config.php';

    if (!file_exists($configFile)) {
        return false;
    }

    $configLines = file($configFile, FILE_IGNORE_NEW_LINES);
    $updatedLines = [];

    foreach ($configLines as $line) {

        foreach ($updates as $update) {
            $constantName = $update['name'];
            $newValue = var_export($update['value'], true); // Ensures proper escaping

            if (strpos($line, "define( '$constantName'") === 0) {
                $line = "define( '$constantName', $newValue );";
                break;
            }
        }

        $updatedLines[] = $line;
    }

    return file_put_contents($configFile, implode("\n", $updatedLines) . "\n") !== false;
}


/**
 * Generate a random string from letters and numbers.
 *
 * @param int $length The needed length of the random string
 * @return string
 */
function generate_random($length = 20)
{
    // Define the character set (letters and numbers)
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+-*()';
    $charactersLength = strlen($characters);
    $randomString = '';

    // Build the random string
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

/**
 * Generate the HTML header for the admin area
 *
 * @param string    $title      The page title that will appear on the browser windows/tabs.
 * @param boolean   $sidebar    Optional. Option to show/hide the side bar.
 *                              Default true.
 * @param boolean   $mainbar    Optional. Option to show/hide the main bar.
 *                              Default true.
 * @param boolean   $setup_css  Optional. Option to include the setup css file.
 *                              Default false.
 * @return void
 */
function page_admin_start($title = "", $sidebar = true, $mainbar = true, $setup_css = false)
{

    ?>
    <!DOCTYPE html>
    <html lang="<?php echo fmg_formated_language_code();?>">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noindex,nofollow" />
        <link rel="icon" href="data:," />
        <base href="<?php echo fmg_guess_url(); ?>/" target="_blank">
        <title>FMGet - <?php echo $title; ?></title>
        <link rel='stylesheet' href='admin/css/admin.css' type='text/css' />
        <?php if ($setup_css) { ?>
            <link rel='stylesheet' href='admin/css/setup.css' type='text/css' />
        <?php } ?>
        <link rel='stylesheet' href='includes/css/blocks.css' type='text/css' />
    </head>

    <body>
        <?php if ($mainbar) { ?>
            <div class="fmg-ui-header">
                <div class="fmg-ui-header-group">
                    <strong><?php echo $title; ?></strong>
                </div>
                <div class="fmg-ui-header-group">Powered by <a class="fmg-ui-link" target="_blank"
                        href="https://fmget.com">FMGet</a></div>
            </div>
        <?php } ?>

        <div class="fmg-ui-container">
            <?php

}

/**
 * Generate the HTML footer for the admin area
 *
 * @param boolean   $setup_js       Optional. Option to include the setup JS file.
 *                                  Default false.
 * 
 * @return void
 */
function page_admin_end($setup_js = false)
{

    ?>
        </div>
        <?php if ($setup_js) { ?>
            <script src="admin/js/setup.js"></script>
        <?php } ?>
        <script src="includes/js/blocks.js"></script>
        <script src="admin/js/admin.js"></script>
    </body>

    </html>
    <?php

}

/**
 * Attempts to connect to the FileMaker server and retrieve a list of available databases.
 * If the connection fails, times out, or returns an invalid response, it will return appropriate error codes.
 *
 * @param string $server    The clean address to the FileMaker server.
 * @param string $username  FileMaker database account name.
 * @param string $password  FileMaker database account password.
 * @return string|array     Returns an array of databases or an error code.
 */
function fms_get_database_list($server, $username, $password)
{
    $authUrl = "https://{$server}/fmi/data/vLatest/databases";
    $authHeaders = [
        "Authorization: Basic " . base64_encode("{$username}:{$password}"),
        "Content-Type: application/json"
    ];

    $ch = curl_init($authUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        curl_close($ch);
        return "error1"; // Server unreachable or request failed
    }

    curl_close($ch);

    // Decode JSON response
    $authData = json_decode($response, true);

    // Handle JSON parsing errors
    if (json_last_error() !== JSON_ERROR_NONE) {
        return "error1"; // Invalid JSON response
    }

    // Validate response structure
    if (!isset($authData['messages'][0]['message'])) {
        return "error1"; // Unexpected response format
    }

    if (!isset($authData['response']['databases']) || empty($authData['response']['databases'])) {
        return "error2"; // Server found but no databases available
    }

    return $authData['response']['databases'];
}

/**
 * Attempts to connect to the FileMaker server and receives an access token that defines your connection to the database.
 *
 * If an access token is already available it will try to validate it before requiring a new one.
 * 
 * @param string $server    The clean address to the FileMaker server.
 * @param string $database  FileMaker database name.
 * @param string $username  FileMaker database account name.
 * @param string $password  FileMaker database account password.
 * @return string           Returns OK or an error code.
 */
function fms_refresh_auth_key($server, $database, $username, $password)
{
    if (isset($_SESSION['fmauth']) && !empty($_SESSION['fmauth'])) {
        $authUrl = "https://{$server}/fmi/data/vLatest/validateSession";
        $authHeaders = [
            "Authorization: Bearer " . $_SESSION['fmauth'],
            "Content-Type: application/json"
        ];

        $ch = curl_init($authUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout after 10 seconds

        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            curl_close($ch);
            return "error1"; // Server unreachable or request failed
        }

        curl_close($ch);

        // Decode JSON response
        $authData = json_decode($response, true);

        // Handle JSON parsing errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            return "error1"; // Invalid JSON response
        }

        // Validate response structure
        if (!isset($authData['messages'][0]['message'])) {
            return "error1"; // Unexpected response format
        }

        $responseFlag = $authData['messages'][0]['message'];

        // Validate response structure
        if ($responseFlag === "OK") {
            return "ok";
        }
    }

    $database_clean = urlencode($database);
    $authUrl = "https://{$server}/fmi/data/vLatest/databases/{$database_clean}/sessions";
    $authHeaders = [
        "Authorization: Basic " . base64_encode("{$username}:{$password}"),
        "Content-Type: application/json"
    ];

    $emptyPayload = '{}';

    $ch = curl_init($authUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $emptyPayload);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout after 10 seconds

    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        curl_close($ch);
        return "error1"; // Server unreachable or request failed
    }

    curl_close($ch);

    // Decode JSON response
    $authData = json_decode($response, true);

    // Handle JSON parsing errors
    if (json_last_error() !== JSON_ERROR_NONE) {
        return "error1"; // Invalid JSON response
    }

    // Validate response structure
    if (!isset($authData['response']['token'])) {
        return "error2"; // No authentication token received
        // return $authData; // No authentication token received
    }

    // Store token in session and return success
    $_SESSION['fmauth'] = $authData['response']['token'];
    return "ok";

}

/**
 * Check if the current user has the right to access the admin area
 * 
 * If the PHP version is older than 7 then it wont start the session
 * and the loader will die on error later on.
 * 
 * It uses a compination of session variables, cookies and usid.
 * 
 * There are plans to improve it while keeping it simple on the next version.
 * 
 * @return void
 */
function admin_auth_check()
{
    $login_path = fmg_guess_url() . '/admin/login.php';
    if (PHP_VERSION_ID > 70300) {
        // Check if the user is an admin
        if (!isset($_SESSION['fmgadmin']) || !$_SESSION['fmgadmin']) {
            header('Location: ' . $login_path);
            exit;
        }

        // Check FMG_AUTH_KEY1 against session variable
        if (!defined('FMG_AUTH_KEY1') || FMG_AUTH_KEY1 !== $_SESSION['fmgssk'] ?? null) {
            header('Location: ' . $login_path);
            exit;
        }

        // Check if the user's IP matches the stored session IP
        if ($_SERVER['REMOTE_ADDR'] !== ($_SESSION['fmguip'] ?? null)) {
            header('Location: ' . $login_path);
            exit;
        }

        // Check FMG_AUTH_KEY2 against cookie variable
        if (!defined('FMG_AUTH_KEY2') || FMG_AUTH_KEY2 !== ($_COOKIE['fmgpsk'] ?? null)) {
            header('Location: ' . $login_path);
            exit;
        }
    }
}

/**
 * Grants the current user the right to access the admin area
 * 
 * This function includes validating the user's raw input
 * 
 * @param string $username  FMGet admin account name.
 * @param string $password  FMGet admin account password.
 * @return boolean          Returns true if the admins right were granted to the user .
 */
function admin_auth_grant($username = "", $password = "")
{
    // Validate user input
    if (empty($username) || empty($password)) {
        return false;
    }

    // Validate username
    if (!defined('FMG_USER') || FMG_USER !== $username) {
        return false;
    }

    // Validate password
    if (!defined('FMG_PASSWORD') || !defined('FMG_AUTH_SALT')) {
        return false;
    }
    $saltedPassword = FMG_AUTH_SALT . $password;
    if (!password_verify($saltedPassword, FMG_PASSWORD)) {
        return false;
    }
    // We are ready to grant the access to the admin dashboard.
    // Send cookie variables
    $cookie_name = "fmgpsk";
    $cookie_value = FMG_AUTH_KEY2;
    setcookie($cookie_name, $cookie_value, [
        'expires' => time() + (86400 * 30),
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    

    // Declare the session variables
    $_SESSION['fmgssk'] = FMG_AUTH_KEY1;
    $_SESSION['fmguip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['fmgadmin'] = true;

    return true;
}

/**
 * Admin authentication guard.
 * 
 * Save guard the system against direct CSRF or brute force attacks
 * 
 * This function checks whether the current server time is within the allowed session window.
 * It also verifies that specific session values are set, not empty, and match each other.
 * 
 * @return boolean      Returns true if no condition failed.
 */
function admin_auth_guard()
{
    // Get the current server time
    $currentTime = time();

    // Validate session time constraints
    if (
        !isset($_SESSION['fmgatws'], $_SESSION['fmgatwe']) ||
        $currentTime <= $_SESSION['fmgatws'] || $currentTime > $_SESSION['fmgatwe']
    ) {
        return false;
    }

    // Validate CSRF token
    if (!isset($_SESSION['fmgcsrf'], $_POST['fmg_csrf']) || empty($_SESSION['fmgcsrf']) || empty($_POST['fmg_csrf']) || $_SESSION['fmgcsrf'] !== $_POST['fmg_csrf']) {
        return false;
    }

    return true;
}


/**
 * Makes it easier to manage the side menu for the admin area by highlighting
 * the current section for the admin.
 *
 * @param string $query_item The item name to check if it's the current active section
 * @return void
 */
function sidemenu_active_tag($query_item)
{
    if ($query_item == FMG_ACTIVE_SIDEMENU) {
        echo ' class="active"';
    }
}