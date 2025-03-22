<?php
/**
 * Retrieves and creates the fmg-config.php file.
 *
 * The permissions for the base directory must allow for writing files in order
 * for the fmg-config.php to be created using this page.
 *
 * @package FMGet
 */

/**
 * We are installing, Godspeed!
 */
define('FMG_INSTALLING', true);

if (!defined('FMGROOT')) {
    define('FMGROOT', dirname(__DIR__) . '/');
}

require FMGROOT . 'fmg-load.php';
require_once FMGROOT . 'admin/functions.php';
require_once FMGROOT . FMGINC . '/blocks.php';

// Find fmg-config-sample.php
if (file_exists(FMGROOT . 'fmg-config-sample.php')) {
    $config_file = file(FMGROOT . 'fmg-config-sample.php');
} else {
    fmg_die('<p>Some needed files can\'t be found. Please re-upload the files for your FMGet installation.</p>', 'FMGet Setup');
}

// Check if fmg-config.php has been created.
if (file_exists(FMGROOT . 'fmg-config.php')) {
    fmg_die('<p>The configuration file (fmg-config.php) already exists. If you need to reset any of the configuration items in this file, please delete it first.</p>', 'FMGet Setup');
}

$step = isset($_GET['step']) ? (int) $_GET['step'] : -1;

// Find the main language file and load it.
if (file_exists(FMGROOT . FMGINC . '/languages/translations.php')) {
    require_once FMGROOT . FMGINC . '/languages/translations.php';
} else {
    fmg_die('<p>Some needed files can\'t be found. Please re-upload the files for your FMGet installation.</p>', 'FMGet Setup');
}

switch ($step) {
    case -1:
        page_admin_start('Setup', false, true, true);

        $html = "";
        $chunkSize = 8;
        $languageChunks = array_chunk($fmg_languages, $chunkSize, true);

        foreach ($languageChunks as $chunk) {
            $html .= "<div class=\"widget-language-select\">\n";
            $html .= "<ul class=\"language-list\">\n";

            foreach ($chunk as $langCode => $langName) {
                $html .= "    <li><a target=\"_self\" class=\"fmg-ui-link\" href=\"admin/setup-config.php?step=0&lang={$langCode}\">{$langName}</a></li>\n";
            }

            $html .= "</ul>\n";
            $html .= "</div>\n";
        }
        block_row_open([
            'align' => 'center',
        ]);
        block_column_open([
            'size' => 8,
        ]);
        echo $html;
        block_column_close();
        block_row_close();
        page_admin_end(true);
        break;



    case 0:
        // Check if language is selected and is available then load the language admin file
        $language_code = isset($_GET['lang']) ? $_GET['lang'] : '';
        fmg_load_language($language_code, 'admin');

        page_admin_start('Setup', false, true, true);
        block_row_open([
            'align' => 'center',
        ]);
        block_column_open([
            'size' => 8,
        ]);
        // 1-welcome message
        block_title([
            'text' => txt('setup_welcome'),
            'size' => 3,
        ]);
        block_separator([
            'visible' => true,
            'mb' => 3,
        ]);
        block_text([
            'text' => txt('setup_req_ssl'),
            'size' => 2,
        ]);
        block_text([
            'text' => txt('setup_req_php'),
            'size' => 2,
        ]);
        block_text([
            'text' => txt('setup_req_fms'),
            'size' => 2,
        ]);
        block_text([
            'text' => txt('setup_req_api'),
            'size' => 2,
        ]);
        block_text([
            'text' => txt('setup_req_acc'),
            'size' => 2,
        ]);
        block_separator([
            'mt' => 4,
            'mb' => 4,
        ]);
        block_text([
            'text' => txt('setup_intro1'),
            'size' => 3,
        ]);
        block_link([
            'text' => txt('setup_intro2'),
            'external' => true,
            'url' => 'https://fmget.com/getting-started.html'
        ]);
        block_separator([
            'mt' => 4,
            'mb' => 4,
        ]);

        block_buttonbasic([
            'text' => txt('setup_button_install'),
            'type' => 'link',
            'target' => 'admin/setup-config.php?step=1&lang=' . $language_code,
            'mb' => 3
        ]);
        block_link([
            'text' => txt('setup_back1'),
            'url' => 'admin/setup-config.php'
        ]);

        block_column_close();
        block_row_close();
        page_admin_end(true);
        break;



    case 1:
        // Check if language is selected and is available then load the language admin file
        $language_code = isset($_GET['lang']) ? $_GET['lang'] : '';
        fmg_load_language($language_code, 'admin');

        // Check for SSL on web server
        if (!fmg_is_ssl()) {
            fmg_die('<p>' . txt('setup_error_ssl') . '</p>' . "<a href=\"setup-config.php?step=0&lang={$language_code}\">" . txt('setup_back2') . "</a>", 'FMGet Setup');
        }

        // Check if cURL is enabled
        if (!function_exists('curl_version')) {
            fmg_die('<p>' . txt('setup_error_curl1') . '</p>' . "<a href=\"setup-config.php?step=0&lang={$language_code}\">" . txt('setup_back2') . "</a>", 'FMGet Setup');
        }

        // Get list of the available timezones
        $timezones = timezone_identifiers_list();

        page_admin_start('Setup', false, true, true);
        block_row_open([
            'align' => 'center',
        ]);
        block_column_open([
            'size' => 8,
        ]);

        block_title([
            'text' => txt('setup_config_title'),
            'size' => 3,
        ]);
        block_separator([
            'visible' => true,
            'mb' => 3,
        ]);
        block_text([
            'text' => txt('setup_config_details1'),
            'size' => 2,
        ]);
        block_form_open([
            'action' => 'admin/setup-config.php?step=2'
        ]);
        block_field([
            'label' => txt('setup_config_sitename_label'),
            'name' => 'fmg_sitename',
            'type' => 'text',
            'mt' => '4',
            'mb' => '3',
        ]);
        block_menufield([
            'label' => txt('setup_config_timezone_label'),
            'text' => '',
            'name' => 'fmg_timezone',
            'hint' => txt('example') . ': UTC, America/Sao_Paulo, America/New_York, Europe/Lisbon.',
            'mt' => '4',
            'mb' => '3',
        ], $timezones);
        block_menufield([
            'label' => txt('setup_config_dateformat_label'),
            'text' => '',
            'name' => 'fmg_dateformat',
            'hint' => txt('example') . ': MM/DD/YYYY',
            'mt' => '4',
            'mb' => '3',
        ], [
            'MM/DD/YYYY',
            'DD/MM/YYYY',
            'YYYY/MM/DD'
        ]);
        block_field([
            'label' => txt('setup_config_fmserver_label'),
            'name' => 'fm_server',
            'hint' => txt('example') . ': fms.example.com<br>' . txt('setup_config_fmserver_hint'),
            'type' => 'text',
            'mt' => '4',
            'mb' => '4',
        ]);

        block_title([
            'text' => txt('setup_config_dbaccess'),
            'size' => 2,
        ]);
        block_field([
            'label' => txt('setup_config_fmusername_label'),
            'name' => 'fm_username',
            'type' => 'text',
            'mt' => '4',
            'mb' => '3',
        ]);
        block_field([
            'label' => txt('setup_config_fmpassword_label'),
            'name' => 'fm_password',
            'type' => 'text',
            'mt' => '4',
            'mb' => '3',
        ]);
        block_note([
            'text' => txt('setup_fmcloud_notice'),
            'mb' => 3,
            'mt' => 3,
        ]);
        block_note([
            'text' => txt('setup_alert_username_colon'),
            'type' => 'warning',
        ]);
        block_hidden_field([
            'name' => 'local',
            'value' => $language_code
        ]);
        block_buttonbasic([
            'text' => txt('continue'),
            'mt' => 4
        ]);
        block_form_close();
        block_column_close();
        block_row_close();
        page_admin_end(true);
        break;



    case 2:
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Store POST data in session
            $_SESSION['post_data'] = $_POST;

            // Redirect to the same page to prevent resubmission
            $queryString = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
            header("Location: " . $_SERVER['PHP_SELF'] . $queryString);
            exit();
        }

        // Retrieve stored data after redirection
        if (isset($_SESSION['post_data'])) {
            $postData = $_SESSION['post_data'];
        } else {
            $postData = [];
        }

        $language_code = isset($postData['local']) ? $postData['local'] : '';
        $fm_password = isset($postData['fm_password']) ? $postData['fm_password'] : '';
        $fm_username = isset($postData['fm_username']) ? $postData['fm_username'] : '';
        fmg_load_language($language_code, 'admin');

        $form_errors = "";
        if (!isset($postData['fmg_sitename']) || empty($postData['fmg_sitename'])) {
            $form_errors .= txt("setup_error_sitename_required") . "<br>";
        }
        if (isset($postData['fm_server']) && !empty($postData['fm_server'])) {
            // Ensure input is a string and trim any surrounding whitespace
            $fm_server = trim($postData['fm_server']);

            // Regular expression to match a valid domain name
            $fms_pattern = '/^(?!www\.)(?!http:\/\/)(?!https:\/\/)(?!\/)([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/';
            if (!preg_match($fms_pattern, $fm_server)) {
                $form_errors .= txt("setup_error_fmserver_error") . "<br>";
            }

        } else {
            $form_errors .= txt("setup_error_fmserver_required") . "<br>";
        }
        if (!isset($postData['fmg_timezone']) || empty($postData['fmg_timezone'])) {
            $form_errors .= txt("setup_error_timezone_required") . "<br>";
        } elseif (!in_array($postData['fmg_timezone'], timezone_identifiers_list())) {
            $form_errors .= txt("setup_error_timezone_error") . "<br>";
        }
        if (!isset($postData['fmg_dateformat']) || empty($postData['fmg_dateformat'])) {
            $form_errors .= txt("setup_error_dateformat_required") . "<br>";
        } elseif (!in_array($postData['fmg_dateformat'], ['MM/DD/YYYY', 'DD/MM/YYYY', 'YYYY/MM/DD'])) {
            $form_errors .= txt("setup_error_dateformat_error") . "<br>";
        }
        if (!isset($postData['fm_username']) || empty($fm_username)) {
            $form_errors .= txt("setup_error_fmusername_required") . "<br>";
        } elseif (str_contains($fm_username,":")) {
            $form_errors .= txt("setup_error_fmusername_colon") . "<br>";
        }
        if (!isset($postData['fm_password']) || empty($fm_password)) {
            $form_errors .= txt("setup_error_fmpassword_required") . "<br>";
        }

        if (empty($form_errors)) {
            $fmserver_check = fms_get_database_list($fm_server, $fm_username, $fm_password);

            if ($fmserver_check == "error1") {
                $form_errors .= txt("setup_error_fmserver_invalid") . "<br>";
            }

        }

        page_admin_start('Setup', false, true, true);
        block_row_open([
            'align' => 'center',
        ]);
        block_column_open([
            'size' => 8,
        ]);

        if (!empty($form_errors)) {

            block_title([
                'text' => txt('setup_error_title'),
                'size' => 3,
            ]);
            block_separator([
                'visible' => true,
                'mb' => 3,
            ]);
            block_text([
                'text' => $form_errors,
                'size' => 2,
            ]);
            block_buttonbasic([
                'text' => txt('try_again'),
                'type' => 'js',
                'target' => 'javascript:history.go(-1);return false;',
                'mt' => 4
            ]);

        } else {

            block_title([
                'text' => txt('setup_config_title2'),
                'size' => 3,
            ]);
            block_separator([
                'visible' => true,
                'mb' => 3,
            ]);
            block_text([
                'text' => txt('setup_config_details2'),
                'size' => 2,
            ]);

            block_form_open([
                'action' => 'admin/setup-config.php?step=3'
            ]);

            block_row_open([
                'mt' => 3,
            ]);
            block_column_open([
                'size' => 6,
            ]);

            block_title([
                'text' => txt('setup_config_selectdb'),
                'size' => 2,
                'mb' => '4',
            ]);

            if ($fmserver_check == "error2") {
                block_text([
                    'text' => txt('setup_error_fmserver_nodatabase'),
                    'size' => 2,
                ]);
            } else {
                foreach ($fmserver_check as $entry) {
                    $dbname = $entry['name'];

                    block_radio([
                        'label' => $dbname,
                        'name' => 'fm_database',
                        'value' => $dbname,
                        'mt' => '1',
                        'mb' => '2',
                    ]);

                }
            }
            block_note([
                'text' => txt('setup_fmserver_otherdatabase'),
                'type' => 'warning',
            ]);
            block_field([
                'label' => txt('setup_config_named_fmdatabase_label'),
                'name' => 'fm_named_database',
                'hint' => txt('setup_config_named_fmdatabase_hint'),
                'type' => 'text',
                'mt' => '4',
                'mb' => '3',
            ]);

            block_column_close();
            block_column_open([
                'size' => 6,
            ]);

            block_field([
                'label' => txt('setup_config_username_label'),
                'name' => 'fmg_username',
                'hint' => txt('setup_config_username_hint'),
                'type' => 'text',
                'mt' => '4',
                'mb' => '3',
            ]);
            block_field([
                'label' => txt('setup_config_password_label'),
                'name' => 'fmg_password',
                'hint' => txt('setup_config_password_hint'),
                'type' => 'text',
                'mt' => '4',
                'mb' => '3',
            ]);
            block_field([
                'label' => txt('setup_config_email_label'),
                'name' => 'fmg_email',
                'hint' => txt('setup_config_email_hint'),
                'type' => 'text',
                'mt' => '4',
                'mb' => '3',
            ]);

            block_hidden_field([
                'name' => 'local',
                'value' => $language_code
            ]);
            block_hidden_field([
                'name' => 'fmg_sitename',
                'value' => $postData['fmg_sitename']
            ]);
            block_hidden_field([
                'name' => 'fm_server',
                'value' => $postData['fm_server']
            ]);
            block_hidden_field([
                'name' => 'fmg_timezone',
                'value' => $postData['fmg_timezone']
            ]);
            block_hidden_field([
                'name' => 'fmg_dateformat',
                'value' => $postData['fmg_dateformat']
            ]);
            block_hidden_field([
                'name' => 'fm_username',
                'value' => $fm_username
            ]);
            block_hidden_field([
                'name' => 'fm_password',
                'value' => $fm_password
            ]);

            block_buttonbasic([
                'text' => txt('continue'),
                'mt' => 4
            ]);

            block_form_close();
            block_column_close();
            block_row_close();
        }

        block_column_close();
        block_row_close();
        page_admin_end(true);
        break;



    case 3:
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Store POST data in session
            $_SESSION['post_data'] = $_POST;

            // Redirect to the same page to prevent resubmission
            $queryString = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
            header("Location: " . $_SERVER['PHP_SELF'] . $queryString);
            exit();
        }

        // Retrieve stored data after redirection
        if (isset($_SESSION['post_data'])) {
            $postData = $_SESSION['post_data'];
        } else {
            $postData = [];
        }

        $language_code = isset($postData['local']) ? $postData['local'] : '';
        fmg_load_language($language_code, 'admin');

        $form_errors = "";
        if (!isset($postData['fmg_username']) || empty($postData['fmg_username'])) {
            $form_errors .= txt("setup_error_fmgusername_required") . "<br>";
        }
        if (!isset($postData['fmg_password']) || empty($postData['fmg_password'])) {
            $form_errors .= txt("setup_error_fmgpassword_required") . "<br>";
        }
        if (!isset($postData['fmg_email']) || empty($postData['fmg_email'])) {
            $form_errors .= txt("setup_error_email_required") . "<br>";
        } elseif (!filter_var($postData['fmg_email'], FILTER_VALIDATE_EMAIL)) {
            $form_errors .= txt("setup_error_email_error") . "<br>";
        }
        if (!isset($postData['fm_database']) || empty($postData['fm_database'])) {
            if (!isset($postData['fm_named_database']) || empty($postData['fm_named_database'])) {
                $form_errors .= txt("setup_error_fmdatabase_required") . "<br>";
            } else {
                $fm_database = $postData['fm_named_database'];
            }
        } else {
            $fm_database = $postData['fm_database'];
        }


        if (empty($form_errors)) {
            
            $fmserver_check = fms_refresh_auth_key($postData['fm_server'], $fm_database, $postData['fm_username'], $postData['fm_password']);

            if ($fmserver_check == "error1") {
                $form_errors .= txt("setup_error_fmserver_invalid") . "<br>";
            }
            if ($fmserver_check == "error2") {
                $form_errors .= txt("setup_error_database_noaccess") . "<br>";
            }
        }

        
        if (empty($form_errors)) {
            // Create the auth keys
            $authKey1 = generate_random(40);
            $authKey2 = generate_random(40);
            $authKey3 = generate_random(40);
            $authsalt = generate_random(40);
            $root_domain = fmg_guess_url();

            // Hash admin password using bcrypt
            $saltedPassword = $authsalt . $postData['fmg_password'];
            $ready_password = password_hash($saltedPassword, PASSWORD_BCRYPT);

            // Duplicate the config file and save the setup configurations to the new file named 'fmg-config.php'
            $config_content = implode("", $config_file);
            if (file_put_contents(FMGROOT . 'fmg-config.php', $config_content) === false) {
                $form_errors .= txt('setup_error_config') . "<br>";
            } else {
                $updates_for_config = [
                    ['name' => 'FMG_DB_NAME', 'value' => $fm_database],
                    ['name' => 'FMG_DB_USER', 'value' => $postData['fm_username']],
                    ['name' => 'FMG_DB_PASSWORD', 'value' => $postData['fm_password']],
                    ['name' => 'FMG_DB_HOST', 'value' => $postData['fm_server']],

                    ['name' => 'FMG_SITEURL', 'value' => $root_domain],
                    ['name' => 'FMG_SITENAME', 'value' => $postData['fmg_sitename']],
                    ['name' => 'FMG_LANG', 'value' => $language_code],
                    ['name' => 'FMG_TIMEZONE', 'value' => $postData['fmg_timezone']],
                    ['name' => 'FMG_DATEFORMAT', 'value' => $postData['fmg_email']],

                    ['name' => 'FMG_USER', 'value' => $postData['fmg_username']],
                    ['name' => 'FMG_PASSWORD', 'value' => $ready_password],
                    ['name' => 'FMG_EMAIL', 'value' => $postData['fmg_email']],

                    ['name' => 'FMG_AUTH_KEY1', 'value' => $authKey1],
                    ['name' => 'FMG_AUTH_KEY2', 'value' => $authKey2],
                    ['name' => 'FMG_AUTH_KEY3', 'value' => $authKey3],
                    ['name' => 'FMG_AUTH_SALT', 'value' => $authsalt]
                ];
                config_update($updates_for_config);

                // Clear setup session data
                unset($_SESSION['post_data']);
            }
        }


        //Show results
        page_admin_start('Setup', false, true, true);
        block_row_open([
            'align' => 'center',
        ]);
        block_column_open([
            'size' => 8,
        ]);

        if (!empty($form_errors)) {

            block_title([
                'text' => txt('setup_error_title'),
                'size' => 3,
            ]);
            block_separator([
                'visible' => true,
                'mb' => 3,
            ]);
            block_text([
                'text' => $form_errors,
                'size' => 2,
            ]);
            
            block_buttonbasic([
                'text' => txt('try_again'),
                'type' => 'js',
                'target' => 'javascript:history.go(-1);return false;',
                'mt' => 4
            ]);

        } else {

            block_title([
                'text' => txt('setup_welcome_title'),
                'size' => 3,
            ]);
            block_separator([
                'visible' => true,
                'mb' => 3,
            ]);
            block_text([
                'text' => txt('setup_welcome_details'),
                'size' => 2,
            ]);
            block_buttonbasic([
                'text' => txt('setup_button_login'),
                'type' => 'link',
                'target' => 'admin/index.php',
                'mt' => 4
            ]);
        }

        block_column_close();
        block_row_close();
        page_admin_end(true);
        break;
}