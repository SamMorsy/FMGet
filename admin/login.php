<?php
/**
 * FMGet Admin Login Page
 *
 * Handles authentication.
 * 
 * Plans to add resetting password, forgot password and other auth handling.
 *
 * @package FMGet
 */

/** Make sure that the FMGet enviroment has run before continuing. */
if (!defined('FMGROOT')) {
    define('FMGROOT', dirname(__DIR__) . '/');
}

require FMGROOT . 'fmg-load.php';
require_once FMGROOT . FMGADM . '/functions.php';
require_once FMGROOT . FMGINC . '/blocks.php';

//  Force redirect to HTTPS login.
if (!fmg_is_ssl()) {
    $login_path = fmg_guess_url() . '/admin/login.php';
    header('Location: ' . $login_path);
    exit;
}


$step = isset($_GET['step']) ? (int) $_GET['step'] : 1;
$auth_error = isset($_GET['auth_error']) ? (int) $_GET['auth_error'] : 0;

switch ($step) {
    case 1:
        /**
         * Showing admin login area form!
         * 
         * Create CSRF token and cancel the current one if is set.
         * Create session timer to make it harder to brute force,
         * when loading the login form, the user needs to wait 5 seconds before trying to log in.
         * 
         * We assume that timezone is already set by fmg-load.php
         */

        $_SESSION['fmgcsrf'] = generate_random(50);
        $_SESSION['fmgatws'] = time() + 5; // Host time + 5 seconds
        $_SESSION['fmgatwe'] = time() + 600; // Host time + 10 minutes

        page_admin_start(txt('admin_area'), false);

        block_row_open([
            'align' => 'center',
        ]);
        block_column_open([
            'size' => 4,
        ]);

        block_title([
            'text' => txt('login_title'),
            'size' => 3,
        ]);
        block_separator([
            'visible' => true,
            'mb' => 3,
        ]);

        block_form_open([
            'action' => 'admin/login.php?step=2'
        ]);

        if ($auth_error == 1) {
            block_note([
                'text' => txt('login_error1'),
                'type' => 'danger',
            ]);
        }
        if ($auth_error == 2) {
            block_note([
                'text' => txt('login_error2'),
                'type' => 'danger',
            ]);
        }
        if ($auth_error == 3) {
            block_note([
                'text' => txt('login_error3'),
                'type' => 'warning',
            ]);
        }
        block_field([
            'label' => txt('login_username_label'),
            'name' => 'fmg_username',
            'type' => 'text',
            'attributes' => ' autocomplete="username"',
            'nospellcheck' => true,
            'mt' => '4',
            'mb' => '3',
        ]);
        block_field([
            'label' => txt('login_password_label'),
            'name' => 'fmg_password',
            'type' => 'password',
            'attributes' => ' autocomplete="current-password"',
            'nospellcheck' => true,
            'mt' => '4',
            'mb' => '3',
        ]);
        block_hidden_field([
            'name' => 'fmg_csrf',
            'value' => $_SESSION['fmgcsrf']
        ]);

        echo '<div class="fmg-ui-block" id="ui-preload">Loading...</div>';

        block_form_close();

        ?>
        <script>
            // Show the login button after page loads.
            document.addEventListener("DOMContentLoaded", function () {
                setTimeout(function () {
                    const preloadElement = document.getElementById("ui-preload");
                    if (preloadElement) {
                        preloadElement.innerHTML = '<div class="fmg-ui-block mt4 mb1"><button type="submit" class="fmg-ui-button-basic" id="fmg_login_button">Log In</button></div>';
                    }
                }, 8000);
            });
        </script>
        <?php

        block_column_close();
        block_row_close();
        page_admin_end();
        break;

    case 2:
        $login_path = fmg_guess_url() . '/admin/login.php';
        $admin_path = fmg_guess_url() . '/admin/index.php';

        // Check the input
        if (!isset($_POST['fmg_username']) || !isset($_POST['fmg_password'])) {
            header('Location: ' . $login_path . '?auth_error=1');
            exit();
        }

        // Guard against CSRF and brute force attacks 
        if (!admin_auth_guard()) {
            header('Location: ' . $login_path . '?auth_error=3');
            exit();
        }

        // Verify username and password
        if (admin_auth_grant($_POST['fmg_username'], $_POST['fmg_password'])) {
            header('Location: ' . $admin_path);
            exit();
        } else {
            header('Location: ' . $login_path . '?auth_error=2');
            exit();
        }
        
        // Break just in case we added more handles to this file
        break;
}