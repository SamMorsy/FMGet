<?php
/**
 * FMGet settings API. This file loads
 * fmg-load.php and admin tools or start the setup script.
 *
 * Protected by the auth module.
 *
 * @package FMGet
 */

if (!defined('FMGROOT')) {
    define('FMGROOT', dirname(__DIR__) . '/');
}

require FMGROOT . 'fmg-load.php';
require_once FMGROOT . FMGADM . '/functions.php';
require_once FMGROOT . FMGINC . '/blocks.php';
fmg_load_language(FMG_LANG, 'admin');

/**
 * Auth check
 */
admin_auth_check();

// Get list of the available timezones
$timezones = timezone_identifiers_list();


// Actions handlers
$form_errors = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store POST data in session
    $_SESSION['post_data'] = $_POST;

    // Redirect to the same page to prevent resubmission
    $queryString = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
    header("Location: " . $_SERVER['PHP_SELF'] . $queryString);
    exit();
}
if (isset($_GET["action"]) && $_GET["action"] == "update" && isset($_SESSION['post_data'])) {

    // Retrieve stored data after redirection
    $postData = $_SESSION['post_data'];

    $language_code = isset($postData['local']) ? $postData['local'] : '';
    $fm_password = isset($postData['fm_password']) ? $postData['fm_password'] : '';
    $fm_username = isset($postData['fm_username']) ? $postData['fm_username'] : '';

    if (!isset($postData['fmg_language_value']) || empty($postData['fmg_language_value'])) {
        $form_errors .= txt("error_language_required") . "<br>";
    } else {
        $language_clean_code = preg_replace('/[^a-z-]/', '', strtolower($postData['fmg_language_value']));
        if (!preg_match('/^[a-z]{2}(-[a-z]{2})?$/', $language_clean_code) || !array_key_exists($language_clean_code, $fmg_languages)) {
            $language_clean_code = 'en-us';
        }
    }

    if (!isset($postData['fmg_sitename']) || empty($postData['fmg_sitename'])) {
        $form_errors .= txt("error_sitename_required") . "<br>";
    }
    if (isset($postData['fm_server']) && !empty($postData['fm_server'])) {
        // Ensure input is a string and trim any surrounding whitespace
        $fm_server = trim($postData['fm_server']);

        // Regular expression to match a valid domain name
        $fms_pattern = '/^(?!www\.)(?!http:\/\/)(?!https:\/\/)(?!\/)([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/';
        if (!preg_match($fms_pattern, $fm_server)) {
            $form_errors .= txt("error_fmserver_error") . "<br>";
        }

    } else {
        $form_errors .= txt("error_fmserver_required") . "<br>";
    }
    if (!isset($postData['fmg_timezone']) || empty($postData['fmg_timezone'])) {
        $form_errors .= txt("error_timezone_required") . "<br>";
    } elseif (!in_array($postData['fmg_timezone'], timezone_identifiers_list())) {
        $form_errors .= txt("error_timezone_error") . "<br>";
    }
    if (!isset($postData['fmg_dateformat']) || empty($postData['fmg_dateformat'])) {
        $form_errors .= txt("error_dateformat_required") . "<br>";
    } elseif (!in_array($postData['fmg_dateformat'], ['MM/DD/YYYY', 'DD/MM/YYYY', 'YYYY/MM/DD'])) {
        $form_errors .= txt("error_dateformat_error") . "<br>";
    }
    if (!isset($postData['fm_username']) || empty($fm_username)) {
        $form_errors .= txt("error_fmusername_required") . "<br>";
    } elseif (str_contains($fm_username, ":")) {
        $form_errors .= txt("error_fmusername_colon") . "<br>";
    }
    if (!isset($postData['fm_password']) || empty($fm_password)) {
        $form_errors .= txt("error_fmpassword_required") . "<br>";
    }

    if (!isset($postData['fmg_email']) || empty($postData['fmg_email'])) {
        $form_errors .= txt("error_email_required") . "<br>";
    } elseif (!filter_var($postData['fmg_email'], FILTER_VALIDATE_EMAIL)) {
        $form_errors .= txt("error_email_error") . "<br>";
    }
    if (!isset($postData['fm_database']) || empty($postData['fm_database'])) {
        if (!isset($postData['fm_named_database']) || empty($postData['fm_named_database'])) {
            $form_errors .= txt("error_fmdatabase_required") . "<br>";
        } else {
            $fm_database = $postData['fm_named_database'];
        }
    } else {
        $fm_database = $postData['fm_database'];
    }

    $updates_for_config = [
        ['name' => 'FMG_DB_NAME', 'value' => $fm_database],
        ['name' => 'FMG_DB_USER', 'value' => $postData['fm_username']],
        ['name' => 'FMG_DB_PASSWORD', 'value' => $postData['fm_password']],
        ['name' => 'FMG_DB_HOST', 'value' => $postData['fm_server']],

        ['name' => 'FMG_SITENAME', 'value' => $postData['fmg_sitename']],
        ['name' => 'FMG_LANG', 'value' => $language_clean_code],
        ['name' => 'FMG_TIMEZONE', 'value' => $postData['fmg_timezone']],
        ['name' => 'FMG_DATEFORMAT', 'value' => $postData['fmg_dateformat']],

        ['name' => 'FMG_EMAIL', 'value' => $postData['fmg_email']],
    ];
    config_update($updates_for_config);
}


page_admin_start(txt('admin_area'));
block_row_open([
    'align' => 'center',
]);


block_column_open([
    'size' => 2,
]);

define("FMG_ACTIVE_SIDEMENU", "general_settings");
require_once FMGROOT . FMGADM . '/menu.php';

block_column_close();



block_column_open([
    'size' => 10,
]);

block_title([
    'text' => txt('dashboard_title_settings'),
    'size' => 3,
]);
block_separator([
    'visible' => true,
    'mb' => 3,
]);

block_form_open([
    'action' => 'admin/settings.php?action=update'
]);
block_row_open([
    'align' => 'center',
]);
block_column_open([
    'size' => 9,
]);

if (!empty($form_errors)) {
    block_note([
        'text' => $form_errors,
        'type' => 'danger',
    ]);
} else {
    if (isset($postData['fmg_sitename'])) {
        block_message([
            'text' => txt("settings_updated"),
            'type' => 'success',
        ]);
    }
}
if (isset($postData['fmg_language_value']) && $postData['fmg_language_value'] !== FMG_LANG) {
    block_note([
        'text' => txt('settings_language_updated'),
        'type' => 'success',
    ]);
}

block_row_open([
    'align' => 'center',
]);

block_column_open([
    'size' => 6,
]);
block_menufield([
    'label' => txt('config_language_label'),
    'text' => FMG_LANG,
    'value_list' => true,
    'name' => 'fmg_language',
    'hint' => txt('example') . ': English',
    'mt' => '4',
    'mb' => '3',
], $fmg_languages);
block_field([
    'label' => txt('config_sitename_label'),
    'name' => 'fmg_sitename',
    'type' => 'text',
    'text' => FMG_SITENAME,
    'mt' => '4',
    'mb' => '3',
]);
block_field([
    'label' => txt('config_email_label'),
    'name' => 'fmg_email',
    'hint' => txt('config_email_hint'),
    'type' => 'text',
    'text' => FMG_EMAIL,
    'mt' => '4',
    'mb' => '3',
]);
block_column_close();
block_column_open([
    'size' => 6,
]);
block_menufield([
    'label' => txt('config_timezone_label'),
    'text' => FMG_TIMEZONE,
    'name' => 'fmg_timezone',
    'hint' => txt('example') . ': UTC, America/Sao_Paulo, America/New_York, Europe/Lisbon.',
    'mt' => '4',
    'mb' => '3',
], $timezones);
block_menufield([
    'label' => txt('config_dateformat_label'),
    'text' => FMG_DATEFORMAT,
    'name' => 'fmg_dateformat',
    'hint' => txt('example') . ': MM/DD/YYYY',
    'mt' => '4',
    'mb' => '3',
], [
    'MM/DD/YYYY',
    'DD/MM/YYYY',
    'YYYY/MM/DD'
]);
block_column_close();
block_row_close();
block_row_open([
    'align' => 'center',
]);
block_column_open([
    'size' => 6,
]);
block_field([
    'label' => txt('config_fmserver_label'),
    'name' => 'fm_server',
    'hint' => txt('example') . ': fms.example.com<br>' . txt('config_fmserver_hint'),
    'type' => 'text',
    'text' => FMG_DB_HOST,
    'mt' => '4',
    'mb' => '4',
]);

block_title([
    'text' => txt('config_dbaccess'),
    'size' => 2,
]);
block_field([
    'label' => txt('config_fmusername_label'),
    'name' => 'fm_username',
    'type' => 'text',
    'text' => FMG_DB_USER,
    'mt' => '4',
    'mb' => '3',
]);
block_field([
    'label' => txt('config_fmpassword_label'),
    'name' => 'fm_password',
    'type' => 'text',
    'text' => FMG_DB_PASSWORD,
    'mt' => '4',
    'mb' => '3',
]);
block_note([
    'text' => txt('fmcloud_notice'),
    'mb' => 3,
    'mt' => 3,
]);
block_note([
    'text' => txt('alert_username_colon'),
    'type' => 'warning',
]);


block_column_close();
block_column_open([
    'size' => 6,
]);

$fmserver_check = fms_get_database_list(FMG_DB_HOST, FMG_DB_USER, FMG_DB_PASSWORD);
block_title([
    'text' => txt('config_selectdb'),
    'size' => 2,
    'mb' => '4',
]);
if ($fmserver_check == "error1") {
    block_note([
        'text' => txt('error_fmserver_invalid'),
        'type' => 'danger',
    ]);
} elseif ($fmserver_check == "error2") {
    block_text([
        'text' => txt('error_fmserver_nodatabase'),
        'size' => 2,
    ]);
} else {
    foreach ($fmserver_check as $entry) {
        $dbname = $entry['name'];

        $selected_db_option = (FMG_DB_NAME == $dbname) ? true : false;

        block_radio([
            'label' => $dbname,
            'name' => 'fm_database',
            'value' => $dbname,
            'checked' => $selected_db_option,
            'mt' => '1',
            'mb' => '2',
        ]);

    }
}

block_text([
    'text' => txt('fmserver_otherdatabase'),
    'size' => 2,
    'mt' => '4',
]);
block_field([
    'label' => txt('config_named_fmdatabase_label'),
    'name' => 'fm_named_database',
    'text' => FMG_DB_NAME,
    'hint' => txt('config_named_fmdatabase_hint'),
    'type' => 'text',
    'mt' => '4',
    'mb' => '3',
]);
block_column_close();
block_row_close();


block_buttonbasic([
    'text' => txt('update'),
    'mt' => 4
]);

block_column_close();
block_row_close();
block_form_close();





block_column_close();



block_row_close();
page_admin_end();

// Clear setup session data
unset($_SESSION['post_data']);