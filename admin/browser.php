<?php
/**
 * FMGet database browser API. This file loads
 * fmg-load.php and admin tools or start the setup script.
 *
 * Front end for browsing the database.
 * 
 * Plans to include searchig, sorting, adding, deleting and updating records
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
fms_refresh_auth_key(FMG_DB_HOST, FMG_DB_NAME, FMG_DB_USER, FMG_DB_PASSWORD);

/**
 * Auth check
 */
admin_auth_check();


// Actions handlers
$selected_layout = "";
$records_dataset = "";
$layout_list = fms_get_layout_list();
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

    if (!isset($postData['fmg_brwose_layout']) || empty($postData['fmg_brwose_layout'])) {
        $form_errors .= txt("error_fmgusername_required") . "<br>";
    }

    $selected_layout = $postData['fmg_brwose_layout'];
    $layout_name_url = urldecode($selected_layout);

    $records_dataset = fms_get_records_list($layout_name_url);
}

page_admin_start(txt('admin_area'));
block_row_open([
    'align' => 'center',
]);


block_column_open([
    'size' => 2,
]);

define("FMG_ACTIVE_SIDEMENU", "browse");
require_once FMGROOT . FMGADM . '/menu.php';

block_column_close();



block_column_open([
    'size' => 10,
]);

block_title([
    'text' => txt('title_browse'),
    'size' => 3,
]);
block_separator([
    'visible' => true,
    'mb' => 3,
]);

block_form_open([
    'action' => 'admin/browser.php?action=update'
]);
block_row_open([]);
block_column_open([
    'size' => 6,
]);


if ($layout_list == "error1" || $layout_list == "error2") {
    block_note([
        'text' => txt("browse_layoutselect_error"),
        'type' => 'danger',
    ]);
    $layout_list = [];
} else {
    block_menufield([
        'label' => txt('browse_layoutselect_placeholder'),
        'text' => $selected_layout,
        'name' => 'fmg_brwose_layout',
        'hint' => txt('browse_layoutselect_note'),
        'mt' => '4',
        'mb' => '3',
    ], $layout_list);

    block_column_close();

    block_column_open([
        'size' => 3,
    ]);

    block_buttonbasic([
        'text' => txt('go'),
        'mt' => 4,
        'style' => 'padding: 11px;',
    ]);
}

block_column_close();
block_row_close();

block_form_close();

?>

<div class="browser-container">
    <table id="dynamicTable">
        <thead>
            <tr id="tableHeader">
            </tr>
        </thead>
        <tbody id="tableBody">
        </tbody>
    </table>
</div>

<script>
    // JSON array with the data
    const jsonString2 = `
    <?php
    echo fms_escapeEncodeToJson($records_dataset);
    ?>
`;

    // First call
    window.onload = function () {
        fmg_refreshBrowserTable(jsonString2);
    };

</script>

<?php

block_column_close();
block_row_close();
page_admin_end();

// Clear setup session data
unset($_SESSION['post_data']);