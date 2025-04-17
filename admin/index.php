<?php
/**
 * Front to the FMGet admin dashboard. This file loads
 * fmg-load.php and admin tools or start the setup script.
 *
 * Protected by the auth modal.
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

// We are online

page_admin_start(txt('admin_area'));
block_row_open([
    'align' => 'center',
]);


block_column_open([
    'size' => 3,
]);
block_note([
    'text' => "Sidebar",
    'type' => 'success',
]);
block_column_close();



block_column_open([
    'size' => 9,
]);
block_note([
    'text' => "Welcome to FMGet!",
    'type' => 'success',
]);
block_column_close();



block_row_close();
page_admin_end();