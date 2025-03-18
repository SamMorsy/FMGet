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

/**
 * Display setup fmg-config.php file header.
 *
 * @ignore
 *
 * @param string $title The title of the setup stage.
 */
function setup_config_display_header($title)
{
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noindex,nofollow" />
        <title>FMGet - Setup</title>
        <link rel="icon" href="data:," />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="theme-color" content="#004458">
        <link rel='stylesheet' href='css/install.css' type='text/css' />
    </head>

    <body>
        <div class="container">
            <div class="content-wrapper">
                <div class="main-content">
                    <h2><?php echo $title; ?></h2>
                    <hr>
                    <?php
} // End function setup_config_display_header();

/**
 * Display setup fmg-config.php file footer.
 *
 * @ignore
 *
 */
function setup_config_display_footer()
{
    ?>
                </div>
            </div>
            <div class="footer">
                <div class="main-footer"></div>
                <div class="side-footer">
                    <p>Powered by <a target="_blank" href="https://fmget.com">FMGet</a></p>
                </div>
            </div>
        </div>
        <script crossorigin="anonymous" defer="defer" type="application/javascript" src="js/install.js"></script>
    </body>

    </html>
    <?php
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
        ]);
        block_text([
            'text' => txt('setup_config_details1'),
            'size' => 2,
        ]);
        block_form_open([
            'action' => 'admin/setup-config.php?step=2'
        ]);
        block_field([
            'label' => txt('setup_config_fmserver_label'),
            'name' => 'fm_server',
            'hint' => txt('example') . ': fms.example.com<br>' . txt('setup_config_fmserver_hint'),
            'type' => 'text',
            'mt' => '4',
            'mb' => '4',
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
        $language_code = isset($_POST['local']) ? $_POST['local'] : '';
        fmg_load_language($language_code, 'admin');

        $form_errors = "";
        if (isset($_POST['fm_server']) && !empty($_POST['fm_server'])) {
            // Ensure input is a string and trim any surrounding whitespace
            $fm_server = trim($_POST['fm_server']);

            // Regular expression to match a valid domain name
            $fms_pattern = '/^(?!www\.)(?!http:\/\/)(?!https:\/\/)(?!\/)([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/';
            if (!preg_match($fms_pattern, $fm_server)) {
                $form_errors .= txt("setup_error_fmserver_error") . "<br>";
            }
            
        } else {
            $form_errors .= txt("setup_error_fmserver_required") . "<br>";
        }

        // check user input from the post request
            // fm_server*
            // fmg_timezone
            // fmg_dateformat
            // fmg_username
            // fmg_password
            // fmg_email
        // check if server exists 
        // Save the settings to session
        page_admin_start('Setup', false, true, true);
        block_row_open([
            'align' => 'center',
        ]);
        block_column_open([
            'size' => 8,
        ]);

        block_title([
            'text' => txt('setup_error_title'),
            'size' => 3,
        ]);
        block_separator([
            'visible' => true,
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

        block_column_close();
        block_row_close();
        page_admin_end(true);
        break;



    case 3:
        $language_code = isset($_GET['lang']) ? $_GET['lang'] : '';
        fmg_load_language($language_code, 'admin');

        // Create the auth keys
        $authKey1 = generate_random(40);
        $authKey2 = generate_random(40);
        $authKey3 = generate_random(40);
        $logged_in_key = generate_random(40);
        $root_domain = fmg_guess_url();
        $fmg_lang = fmg_check_language_code($language_code);

        // rename the config file and fill it with the auth keys and the selected language code and the current domain
        // Write to a new file named 'fmg-config.php'
        $config_content = implode("", $config_file);
        if (file_put_contents(FMGROOT . 'fmg-config.php', $config_content) === false) {
            fmg_die('<p>' . txt('setup_error_config') . '</p>' . "<a href=\"setup-config.php?step=0&lang={$language_code}\">" . txt('setup_back2') . "</a>", 'FMGet Setup');
        }
        $updates_for_config = [
            ['name' => 'DB_NAME', 'value' => ''],
            ['name' => 'DB_USER', 'value' => ''],
            ['name' => 'DB_PASSWORD', 'value' => ''],
            ['name' => 'DB_HOST', 'value' => ''],

            ['name' => 'FMG_MAIN_APP', 'value' => ''],

            ['name' => 'FMG_SITEURL', 'value' => $root_domain],
            ['name' => 'FMGLANG', 'value' => $fmg_lang],

            ['name' => 'AUTH_KEY1', 'value' => $authKey1],
            ['name' => 'AUTH_KEY2', 'value' => $authKey2],
            ['name' => 'AUTH_KEY3', 'value' => $authKey3],
            ['name' => 'LOGGED_IN_KEY', 'value' => $logged_in_key]
        ];
        if (config_update($updates_for_config) == false) {
            fmg_die('<p>' . txt('setup_error_config') . '</p>' . "<a href=\"setup-config.php?step=0&lang={$language_code}\">" . txt('setup_back2') . "</a>", 'FMGet Setup');
        }


        //Show page

        break;
}