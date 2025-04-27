<?php
/**
 * Front to the FMGet admin dashboard. This file loads
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

// We are online

page_admin_start(txt('admin_area'));
block_row_open([
    'align' => 'center',
]);


block_column_open([
    'size' => 2,
]);

define("FMG_ACTIVE_SIDEMENU", "dashboard");
require_once FMGROOT . FMGADM . '/menu.php';

block_column_close();



block_column_open([
    'size' => 10,
]);

block_title([
    'text' => txt('dashboard_title_links'),
    'size' => 3,
]);
block_separator([
    'visible' => true,
    'mb' => 3,
]);

//Version check
$fmg_versiong_alert = fmg_version_external_check();
if ($fmg_versiong_alert !== "hide") {
    block_note([
        'text' => txt('dashboard_notice_version') . $fmg_versiong_alert . txt('dashboard_notice_version2') ,
        'mb' => 3,
        'mt' => 3,
    ]);
    block_link([
        'text' => txt('download') . " FMGet V" . $fmg_versiong_alert,
        'external' => true,
        'url' => 'https://fmget.com/getting-started.html'
    ]);
}

//Usefull links
block_link([
    'text' => txt('dashboard_link_Changelog'),
    'external' => true,
    'url' => 'https://fmget.com/getting-started.html'
]);
block_link([
    'text' => txt('dashboard_link_news'),
    'external' => true,
    'url' => 'https://fmget.com/getting-started.html'
]);
block_link([
    'text' => txt('dashboard_link_Documentation'),
    'external' => true,
    'url' => 'https://fmget.com/getting-started.html'
]);
block_link([
    'text' => txt('dashboard_link_Support'),
    'external' => true,
    'url' => 'https://fmget.com/getting-started.html'
]);

//Logs
$logs = get_recent_logs();
block_text([
    'text' => txt("dashboard_title_logs"),
    'size' => 2,
    'mt'   => 4,
    'mb'   => 2,
]);
echo '<table class="logs-table">';
echo '<thead>
        <tr>
            <th>ID</th>
            <th>Timestamp</th>
            <th>User</th>
            <th>Type</th>
            <th>Subject</th>
            <th></th>
        </tr>
      </thead>';
echo '<tbody>';
foreach ($logs as $log) {
    echo '<tr>';
    echo '<td>' . $log['id'] . '</td>';
    echo '<td>' . $log['timestamp'] . '</td>';
    echo '<td>' . htmlspecialchars($log['user']) . '</td>';
    echo '<td>' . htmlspecialchars($log['type']) . '</td>';
    echo '<td>' . htmlspecialchars($log['subject']) . '</td>';
    echo '<td><a class="details-link fmg-ui-link" href="#">Details</a></td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';




block_column_close();



block_row_close();
page_admin_end();