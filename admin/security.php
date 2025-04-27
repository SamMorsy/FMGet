<?php
/**
 * FMGet security API. This file loads
 * fmg-load.php and admin tools or start the setup script.
 *
 * Front end for updating the access details for the admins area. 
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

    if (!isset($postData['fmg_username']) || empty($postData['fmg_username'])) {
        $form_errors .= txt("error_fmgusername_required") . "<br>";
    }
    if (!isset($postData['fmg_password']) || empty($postData['fmg_password'])) {
        $form_errors .= txt("error_fmgpassword_required") . "<br>";
    } elseif (!isset($postData['fmg_password_confirm']) || $postData['fmg_password'] !== $postData['fmg_password_confirm']) {
        $form_errors .= txt("error_fmgpassword_match") . "<br>";
    }

    if (empty($form_errors)) {
        // Create new auth keys
        $authKey1 = generate_random(40);
        $authKey2 = generate_random(40);
        $authKey3 = generate_random(40);
        $authsalt = generate_random(40);

        // Hash admin password using bcrypt
        $saltedPassword = $authsalt . $postData['fmg_password'];
        $ready_password = password_hash($saltedPassword, PASSWORD_BCRYPT);


        $updates_for_config = [
            ['name' => 'FMG_USER', 'value' => $postData['fmg_username']],
            ['name' => 'FMG_PASSWORD', 'value' => $ready_password],

            ['name' => 'FMG_AUTH_KEY1', 'value' => $authKey1],
            ['name' => 'FMG_AUTH_KEY2', 'value' => $authKey2],
            ['name' => 'FMG_AUTH_KEY3', 'value' => $authKey3],
            ['name' => 'FMG_AUTH_SALT', 'value' => $authsalt]
        ];
        config_update($updates_for_config);
        admin_auth_revoke();
    }
}


page_admin_start(txt('admin_area'));
block_row_open([
    'align' => 'center',
]);


block_column_open([
    'size' => 2,
]);

define("FMG_ACTIVE_SIDEMENU", "security");
require_once FMGROOT . FMGADM . '/menu.php';

block_column_close();



block_column_open([
    'size' => 10,
]);

block_title([
    'text' => txt('title_security'),
    'size' => 3,
]);
block_separator([
    'visible' => true,
    'mb' => 3,
]);

block_form_open([
    'action' => 'admin/security.php?action=update'
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
}

block_title([
    'text' => txt('details_security'),
    'size' => 2,
]);
block_field([
    'label' => txt('security_username_label'),
    'name' => 'fmg_username',
    'type' => 'text',
    'text' => FMG_USER,
    'mt' => '4',
    'mb' => '3',
]);
block_field([
    'label' => txt('security_password_label'),
    'name' => 'fmg_password',
    'type' => 'text',
    'text' => '',
    'mt' => '4',
    'mb' => '3',
]);
block_field([
    'label' => txt('security_confirm_label'),
    'name' => 'fmg_password_confirm',
    'type' => 'text',
    'text' => '',
    'mt' => '4',
    'mb' => '3',
]);


block_note([
    'text' => txt('details_security2'),
    'mb' => 3,
    'mt' => 3,
]);

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