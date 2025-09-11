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
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+-';
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
    <html lang="<?php echo fmg_formated_language_code(); ?>">

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


/**
 * Checks the external version from fmget.com and compares it to the local version.
 *
 * Sends a GET request to https://fmget.com/prj1/api-version.php and validates the response.
 * Returns the local version if it matches the remote one, otherwise returns "hide".
 * If the request fails or the response format is invalid, also returns "hide".
 *
 * @global string $fmg_version The local version to compare against.
 * @return string The local version if valid and matched, otherwise "hide".
 */
function fmg_version_external_check()
{
    global $fmg_version;

    $url = 'https://fmget.com/prj1/api-version.php';

    // Send GET request
    //$response = @file_get_contents($url);
    $response = "1.0.4";
    // Check if request failed
    if ($response === false) {
        return 'hide';
    }

    // Trim and validate the response (only digits and dots, max length 10)
    $response = trim($response);
    if (!preg_match('/^[0-9.]+$/', $response) || strlen($response) >= 10) {
        return 'hide';
    }

    // Compare with local version
    if ($response === $fmg_version) {

        return 'hide';
    }

    return htmlspecialchars($response);
}


/**
 * Revokes the current user the right to access the admin area.
 * 
 * This function includes redirecting the user to the login page.
 * 
 * @return void
 */
function admin_auth_revoke()
{
    $cookie_name = "fmgpsk";
    $login_path = fmg_guess_url() . '/admin/login.php';

    // Start the session if it's not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Clear all session variables
    $_SESSION = [];

    // Destroy the session cookie if it exists
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            $cookie_name,
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    // Destroy the session
    session_destroy();

    // Redirect
    header('Location: ' . $login_path . '?auth_error=4');
    exit;
}


/**
 * Formats the layouts list array so it's a single level and doesn't include separators.
 * 
 * @return array       The list of all the valid layouts names
 */
function browse_format_layout_list($layouts)
{
    $names = [];

    foreach ($layouts as $layout) {
        if (isset($layout['isFolder']) && $layout['isFolder'] === true) {
            // Recursively process folder contents
            $names = array_merge($names, browse_format_layout_list($layout['folderLayoutNames']));
        } else {
            // Add regular layout name if it's not "-"
            $layoutName = $layout['name'];
            if ($layoutName !== "-") {
                $names[] = $layoutName;
            }
        }
    }

    return $names;
}

/**
 * Returns an array of all the layouts that are found inside FileMaker.
 *
 * @return string|array           Returns layout names array or an error code.
 */
function fms_get_layout_list()
{
    $authUrl = "https://" . FMG_DB_HOST . "/fmi/data/vLatest/databases/" . FMG_DB_NAME . "/layouts";
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
    if ($responseFlag !== "OK") {
        return "error2"; // Unexpected response Code
    }

    // Validate response structure
    if (!isset($authData['response']['layouts'])) {
        return "error2"; // Unexpected response format
    }

    $layouts = $authData['response']['layouts'];
    //$layouttable = $layouts;
    $layouttable = browse_format_layout_list($layouts);

    return $layouttable;
}

/**
 * Returns an array of all the records that are found using the selected layout and 
 * the given offset and limits.
 *
 * @param string $records_layout    The layout
 * @param int $records_offset       The offset for the query
 * @param int $records_limit        The limit of the query
 * @return string|array             Returns layout names array or an error code.
 */
function fms_get_records_list($records_layout, $records_offset = 1, $records_limit = 50, $sort_field = "", $sort_type = "", $search_field = "", $search_value = "")
{
    if (!empty($search_field)) {
        $authUrl = "https://" . FMG_DB_HOST . "/fmi/data/vLatest/databases/" . FMG_DB_NAME . "/layouts/" . $records_layout . "/_find";

        //Sorting query
        if (!empty($sort_field)) {
            $data = [
                'query' => [
                    [
                        $search_field => $search_value
                    ]
                ],
                'sort' => [
                    [
                        'fieldName' => $sort_field,
                        'sortOrder' => strtolower($sort_type)
                    ]
                ],
                'offset' => $records_offset,
                'limit' => $records_limit
            ];
        } else {
            $data = [
                'query' => [
                    [
                        $search_field => $search_value
                    ]
                ],
                'offset' => $records_offset,
                'limit' => $records_limit
            ];
        }

        // echo json_encode($data);
        // exit();

        $ch = curl_init($authUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                "Authorization: Bearer " . $_SESSION['fmauth']
            ],
            CURLOPT_POSTFIELDS => json_encode($data)
        ]);

    } else {
        $authUrl = "https://" . FMG_DB_HOST . "/fmi/data/vLatest/databases/" . FMG_DB_NAME . "/layouts/" . $records_layout . "/records?_offset=" . $records_offset . "&_limit=" . $records_limit;

        //Sorting query
        if (!empty($sort_field)) {
            $sort_array = [
                [
                    'fieldName' => $sort_field,
                    'sortOrder' => strtolower($sort_type)
                ]
            ];
            $sort_param = urlencode(json_encode($sort_array));
            $authUrl .= "&_sort={$sort_param}";
        }
        $authHeaders = [
            "Authorization: Bearer " . $_SESSION['fmauth'],
            "Content-Type: application/json"
        ];


        $ch = curl_init($authUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout after 10 seconds
    }


    $response = curl_exec($ch);

    // echo $response;
    // exit();

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
    if ($responseFlag !== "OK") {
        return "error2"; // Unexpected response Code
    }

    // Validate response structure
    if (!isset($authData['response']['data'])) {
        return "error2"; // Unexpected response format
    }

    // Get layout scheme
    $authUrl = "https://" . FMG_DB_HOST . "/fmi/data/vLatest/databases/" . FMG_DB_NAME . "/layouts/" . $records_layout;

    $authHeaders = [
        "Authorization: Bearer " . $_SESSION['fmauth'],
        "Content-Type: application/json"
    ];


    $ch = curl_init($authUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout after 10 seconds

    $responseScheme = curl_exec($ch);

    // echo $response;
    // exit();

    // Check for cURL errors
    if (curl_errno($ch)) {
        curl_close($ch);
        return "error1"; // Server unreachable or request failed
    }

    curl_close($ch);

    // Decode JSON response
    $rawScheme = json_decode($responseScheme, true);

    // Keys you want to keep
    $allowedKeys = ['name', 'type', 'result', 'global'];

    // Filter each item in the array
    $indexedScheme = [];
    foreach ($rawScheme['response']['fieldMetaData'] as $item) {
        // keep only allowed keys
        $filtered = array_intersect_key($item, array_flip($allowedKeys));

        // use "name" as the index
        $name = $filtered['name'];
        unset($filtered['name']); // remove name from inside if you don’t want it duplicated

        $indexedScheme[$name] = $filtered;
    }

    $authData['response']['scheme'] = $indexedScheme;

    return $authData;
}

/**
 * Escapes JSON control characters in string values within an array and then encodes the array to a JSON string.
 *
 * This function iterates through the input array (and any nested arrays) and applies custom escaping
 * to all string values. The characters targeted for escaping are backslash, double quote, forward slash,
 * and control characters (U+0000 to U+001F).
 *
 * Modifed to also HTML encode the array
 * 
 * @param mixed $data The array to process. If any other type is provided, the function returns false.
 * @return string|false The JSON encoded string if successful, or false if the input is not an array
 * or if json_encode() fails.
 */
function fms_escapeEncodeToJson($data)
{
    // Check if the input is a valid array
    if (!is_array($data)) {
        return false;
    }

    // For simplicity and directness as per typical array_walk_recursive usage, we'll modify $data directly.
    array_walk_recursive($data['response']['data'], function (&$value) {
        if (is_string($value)) {
            // Apply escaping using preg_replace_callback for robustness
            // This will match backslash, double quote, forward slash, and all C0 control characters (0x00-0x1F)
            $value = htmlspecialchars(preg_replace_callback(
                '/[\\\\\"\/\\x00-\\x1F]/', // Pattern to find characters to escape
                function ($matches) {
                    $char = $matches[0]; // The matched character
                    switch ($char) {
                        case '\\':
                            return '\\\\'; // Escape backslash
                        case '"':
                            return '\\"';  // Escape double quote
                        case '/':
                            return '/';  // Escape forward slash (Disabled)
                        case "\x08": // ASCII 8 -> BS (Backspace)
                            return '\\b';
                        case "\x0c": // ASCII 12 -> FF (Form Feed)
                            return '\\f';
                        case "\n":   // ASCII 10 -> LF (Newline)
                            return '\\n';
                        case "\r":   // ASCII 13 -> CR (Carriage Return)
                            return '\\r';
                        case "\t":   // ASCII 9 -> HT (Horizontal Tab)
                            return '\\t';
                        default:
                            // For any other control character (U+0000-U+0007, U+000B, U+000E-U+001F)
                            // escape as \uXXXX
                            return sprintf('\\u%04x', ord($char));
                    }
                },
                $value
            ));
        }
    });

    // Encode the modified array to JSON
    $jsonOutput = json_encode($data, JSON_UNESCAPED_SLASHES);

    // json_encode can return false on failure
    if ($jsonOutput === false) {
        return false;
    }

    return $jsonOutput;
}


/**
 * Update a single field in the FM database 
 *
 * @param string $records_layout    The layout
 * @param string $records_layout    The field name
 * @param string $records_layout    The field value
 * @param int $records_limit        The record id
 * @return string|array             Returns layout names array or an error code.
 */
function fms_set_field($records_layout, $edit_id = "", $edit_name = "", $edit_value = "")
{
    $authUrl = "https://" . FMG_DB_HOST . "/fmi/data/vLatest/databases/" . FMG_DB_NAME . "/layouts/" . $records_layout . "/records/" . rawurlencode($edit_id);

    // Prepare payload
    $payload = json_encode([
        'fieldData' => [
            $edit_name => $edit_value
        ]
    ]);

    // echo json_encode($payload);
    // exit();

    // Init cURL
    $ch = curl_init($authUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $_SESSION['fmauth'],
        'Content-Length: ' . strlen($payload)
    ]);


    $response = curl_exec($ch);

    // echo $response;
    // exit();

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
    if ($responseFlag !== "OK") {
        return "error2"; // Unexpected response Code
    }

    return "OK";
}


/**
 * Delete a single record in the FM database 
 *
 * @param string $records_layout    The layout
 * @param int $records_limit        The record id
 * @return string|array             Returns layout names array or an error code.
 */
function fms_delete_record($records_layout, $delete_id = "")
{
    $authUrl = "https://" . FMG_DB_HOST . "/fmi/data/vLatest/databases/" . FMG_DB_NAME . "/layouts/" . $records_layout . "/records/" . rawurlencode($delete_id);



    // Init cURL
    $ch = curl_init($authUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $_SESSION['fmauth']
    ]);


    $response = curl_exec($ch);

    // echo $response;
    // exit();

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
    if ($responseFlag !== "OK") {
        return "error2"; // Unexpected response Code
    }

    return "OK";
}