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

/**
 * Auth check
 */
admin_auth_check();


// Actions handlers
$page_index = 0;
$selected_layout = "";
$sort_field = "";
$sort_type = "ascend";
$records_dataset = "";
$records_offset = 1;
$records_limit = 50;
$layout_list = [];
$form_errors = "";

$search_field = "";
$search_value = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store POST data in session
    $_SESSION['post_data'] = $_POST;

    // Redirect to the same page to prevent resubmission
    $queryString = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
    header("Location: " . $_SERVER['PHP_SELF'] . $queryString);
    exit();
}

// Update table body and header
if (isset($_GET["action"]) && $_GET["action"] == "update" && isset($_SESSION['post_data'])) {
    fms_refresh_auth_key(FMG_DB_HOST, FMG_DB_NAME, FMG_DB_USER, FMG_DB_PASSWORD);

    // Retrieve stored data after redirection
    $postData = $_SESSION['post_data'];

    if (!isset($postData['fmg_browse_layout']) || empty($postData['fmg_browse_layout'])) {
        $form_errors .= txt("error_fmgusername_required") . "<br>";
    }

    $selected_layout = $postData['fmg_browse_layout'];
    $layout_name_url = rawurlencode($selected_layout);

    if (isset($postData['fmg_browse_sort_field']) && !empty($postData['fmg_browse_sort_field'])) {
        $sort_field = $postData['fmg_browse_sort_field'];
    }
    if (isset($postData['fmg_browse_sort_type']) && !empty($postData['fmg_browse_sort_type'])) {
        $sort_type = $postData['fmg_browse_sort_type'];
    }
    if (isset($postData['fmg_browse_records_limit']) && !empty($postData['fmg_browse_records_limit'])) {
        $records_limit = $postData['fmg_browse_records_limit'];
    }
    if (isset($postData['fmg_browse_records_offset']) && !empty($postData['fmg_browse_records_offset'])) {
        $records_offset = $postData['fmg_browse_records_offset'];
    }

    if (isset($postData['fmg_browse_records_searchField']) && !empty($postData['fmg_browse_records_searchField'])) {
        $search_field = $postData['fmg_browse_records_searchField'];
    }
    if (isset($postData['fmg_browse_records_searchValue']) && !empty($postData['fmg_browse_records_searchValue'])) {
        $search_value = $postData['fmg_browse_records_searchValue'];
    }

    $records_dataset = fms_get_records_list($layout_name_url, $records_offset, $records_limit, $sort_field, $sort_type, $search_field, $search_value);

    //echo $records_dataset;
    echo fms_escapeEncodeToJson($records_dataset);
    exit();
}


fms_refresh_auth_key(FMG_DB_HOST, FMG_DB_NAME, FMG_DB_USER, FMG_DB_PASSWORD);
$layout_list = fms_get_layout_list();

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
        'id' => 'fmg_browse_layout',
        'name' => 'fmg_browse_layout',
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
        'type' => 'js',
        'target' => 'fmg_changeBrowserState(\'layout\')',
        'mt' => 4,
        'style' => 'padding: 11px;',
    ]);
}

block_hidden_field([
    "value" => $records_limit,
    "id" => "fmg_browse_records_limit",
    "name" => "fmg_browse_records_limit"
]);

block_hidden_field([
    "value" => $records_offset,
    "id" => "fmg_browse_records_offset",
    "name" => "fmg_browse_records_offset"
]);

block_hidden_field([
    "value" => $sort_type,
    "id" => "fmg_browse_sort_type",
    "name" => "fmg_browse_sort_type"
]);

block_hidden_field([
    "value" => $sort_field,
    "id" => "fmg_browse_sort_field",
    "name" => "fmg_browse_sort_field"
]);

block_column_close();
block_row_close();

block_form_close();

?>

<div class="browser-nav" id="browserNav">

</div>

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


<div id="fmg_browse_modal_overlay" class="fmg_browse_modal_backdrop">
    <div id="fmg_browse_modal" class="fmg_browse_modal_content">
        <div class="fmg_browse_modal_header">
            <h2 class="fmg_browse_modal_title"><?php echo txt("browse_nav_options_sort"); ?></h2>
            <button id="fmg_browse_close_modal_button_header" class="fmg_browse_modal_close_button"
                onclick="fmg_browse_closeModal()">&times;</button>
        </div>
        <div class="fmg_browse_modal_body">
            <?php

            block_menufield([
                'label' => txt('browse_sort_field_placeholder'),
                'text' => '',
                'name' => 'fmg_browse_option_sort_field',
                'mt' => '4',
                'mb' => '3',
            ], []);

            block_menufield([
                'label' => txt('browse_sort_type_placeholder'),
                'text' => $sort_type,
                'value_list' => true,
                'name' => 'fmg_browse_option_sort_type',
                'mt' => '4',
                'mb' => '4',
            ], [
                "ascend" => txt("browse_sort_type_ascend"),
                "descend" => txt("browse_sort_type_descend"),
            ]);

            block_menufield([
                'label' => txt('browse_limit_placeholder'),
                'text' => $records_limit,
                'name' => 'fmg_browse_option_limit',
                'mt' => '4',
                'mb' => '4',
            ], [
                "20",
                "50",
                "100",
            ]);

            block_field([
                'label' => txt('browse_offset_placeholder'),
                'text' => $records_offset,
                'name' => 'fmg_browse_option_offset',
            ]);

            ?>
        </div>
        <div class="fmg_browse_modal_footer">
            <button id="fmg_browse_submit_modal_button" class="fmg_browse_modal_submit_button"
                onclick="fmg_browse_handleSubmit()"><?php echo txt("update"); ?></button>
        </div>
    </div>
</div>

<div id="fmg_browse_filter_overlay" class="fmg_browse_filter_backdrop">
    <div id="fmg_browse_modal" class="fmg_browse_filter_content">
        <div class="fmg_browse_filter_header">
            <h2 class="fmg_browse_filter_title"><?php echo txt("browse_nav_options_filter"); ?></h2>
            <button id="fmg_browse_close_filter_button_header" class="fmg_browse_filter_close_button"
                onclick="fmg_browse_closeFilter()">&times;</button>
        </div>
        <div class="fmg_browse_filter_body">
            <?php

            block_menufield([
                'label' => txt('browse_search_field_placeholder'),
                'text' => '',
                'name' => 'fmg_browse_option_search_field',
                'mt' => '4',
                'mb' => '3',
            ], []);

            block_field([
                'label' => txt('browse_search_value_placeholder'),
                'text' => '',
                'name' => 'fmg_browse_option_search_value',
            ]);

            ?>
        </div>
        <div class="fmg_browse_filter_footer">
            <button id="fmg_browse_submit_filter_button" class="fmg_browse_filter_submit_button"
                onclick="fmg_browse_filterSubmit()"><?php echo txt("update"); ?></button>
        </div>
    </div>
</div>

<script>
    const msg_waiting = '<?php echo "<strong>" . txt("browse_msg_waiting") . "</strong>"; ?>';
    const msg_fail = '<?php echo "<strong>" . txt("browse_msg_failed") . "</strong>"; ?>';

    const msg_nav_title = '<?php echo txt("browse_nav_records"); ?>';
    const msg_nav_next = '<?php echo txt("browse_page_next"); ?>';
    const msg_nav_previous = '<?php echo txt("browse_page_previous"); ?>';

    const msg_nav_settings = '<?php echo txt("msg_nav_settings"); ?>';
    const msg_nav_refresh = '<?php echo txt("msg_nav_refresh"); ?>';
    const msg_nav_nodata = '<?php echo txt("msg_nav_nodata"); ?>';

    const msg_nav_filter = '<?php echo txt("msg_nav_filter"); ?>';
</script>

<?php

block_column_close();
block_row_close();
page_admin_end();

// Clear setup session data
unset($_SESSION['post_data']);