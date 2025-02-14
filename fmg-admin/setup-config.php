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

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__DIR__) . '/');
}

require ABSPATH . 'fmg-load.php';
require_once ABSPATH . 'fmg-admin/functions.php';

// Find fmg-config-sample.php
if (file_exists(ABSPATH . 'fmg-config-sample.php')) {
    $config_file = file(ABSPATH . 'fmg-config-sample.php');
} else {
    fmg_die('<p>Some needed files can\'t be found. Please re-upload the files for your FMGet installation.</p>', 'FMGet Setup');
}

// Check if fmg-config.php has been created.
if (file_exists(ABSPATH . 'fmg-config.php')) {
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
if (file_exists(ABSPATH . FMGINC . '/languages/translations.php')) {
    require_once ABSPATH . FMGINC . '/languages/translations.php';
} else {
    fmg_die('<p>Some needed files can\'t be found. Please re-upload the files for your FMGet installation.</p>', 'FMGet Setup');
}

switch ($step) {
    case -1:
        setup_config_display_header("FMGet Setup");

        $html = "";
        $chunkSize = 8;
        $languageChunks = array_chunk($fmg_languages, $chunkSize, true);

        foreach ($languageChunks as $chunk) {
            $html .= "<div class=\"widget-language-select\">\n";
            $html .= "<ul class=\"language-list\">\n";

            foreach ($chunk as $langCode => $langName) {
                $html .= "    <li><a href=\"setup-config.php?step=0&lang={$langCode}\">{$langName}</a></li>\n";
            }

            $html .= "</ul>\n";
            $html .= "</div>\n";
        }

        echo $html;
        setup_config_display_footer();
        break;

    case 0:
        // Check if language is selected and is available then load the language admin file
        $language_code = isset($_GET['lang']) ? $_GET['lang'] : '';
        fmg_load_language($language_code, 'admin');

        setup_config_display_header("FMGet Setup");
        // 1-welcome message
        echo "<p>" . txt('setup_welcome') . "</p>";
        // 3-Instructions on the requirments
        echo '<ul class="items-list"><li>';
        echo txt('setup_req_ssl');
        echo '</li><li>';
        echo txt('setup_req_php');
        echo '</li><li>';
        echo txt('setup_req_fms');
        echo '</li><li>';
        echo txt('setup_req_api');
        echo '</li><li>';
        echo txt('setup_req_acc');
        echo '</li></ul>';
        echo "<p>" . txt('setup_intro1') . "<br><a href=\"https://fmget.com/getting-started.html\" target=\"_blank\">" . txt('setup_intro2') . "</a>" . "</p>";
        echo "<a href=\"setup-config.php?step=1&lang={$language_code}\" class=\"fmg-button\">" . txt('setup_button_install') . "</a>";
        echo "<a href=\"setup-config.php\">" . txt('setup_back1') . "</a>";
        setup_config_display_footer();
        break;

    case 1:
        $language_code = isset($_GET['lang']) ? $_GET['lang'] : '';
        fmg_load_language($language_code, 'admin');

        // it's a POST request, return a success message (For testing curl functions)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo json_encode(["status" => "success", "message" => "cURL is working correctly."]);
            exit;
        }

        // Check for SSL on web server
        if (!fmg_is_ssl()) {
            fmg_die('<p>' . txt('setup_error_ssl') . '</p>' . "<a href=\"setup-config.php?step=0&lang={$language_code}\">" . txt('setup_back2') . "</a>", 'FMGet Setup');
        }

        // Check if cURL is enabled
        // Perform a self-test by making a POST request to itself (Adjusted to work on localhost)
        if (!function_exists('curl_version')) {
            fmg_die('<p>' . txt('setup_error_curl1') . '</p>' . "<a href=\"setup-config.php?step=0&lang={$language_code}\">" . txt('setup_back2') . "</a>", 'FMGet Setup');
        }
        $curl_test_url = fmg_guess_url() . "/fmg-admin/setup-config.php?step=1&lang={$language_code}";
        if ($_SERVER['HTTP_HOST'] == "localhost") {
            $curl_test_url = str_replace('https://', '', $curl_test_url);
        }
        $curl_test_data = ["test" => "curl_check"];
        $curl_test_ch = curl_init($curl_test_url);
        curl_setopt($curl_test_ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_test_ch, CURLOPT_POST, true);
        curl_setopt($curl_test_ch, CURLOPT_POSTFIELDS, http_build_query($curl_test_data));
        curl_setopt($curl_test_ch, CURLOPT_SSL_VERIFYPEER, true);
        $curl_test_response = curl_exec($curl_test_ch);
        if ($curl_test_response === false) {
            fmg_die('<p>' . txt('setup_error_curl2') . '</p>' . "<a href=\"setup-config.php?step=0&lang={$language_code}\">" . txt('setup_back2') . "</a>", 'FMGet Setup');
        }
        curl_close($curl_test_ch);

        // Create the auth keys
        $authKey1 = generate_random(40);
        $authKey2 = generate_random(40);
        $authKey3 = generate_random(40);
        $logged_in_key = generate_random(40);
        $root_domain = fmg_guess_url();
        $fmg_lang = fmg_check_language_code($language_code);

        // Generate the code for FileMaker Web Viewer Access
        $wv_code = generate_wv_code($authKey1, $authKey2, $authKey3);

        // rename the config file and fill it with the auth keys and the selected language code and the current domain
        // Write to a new file named 'fmg-config.php'
        $config_content = implode("", $config_file);
        if (file_put_contents(ABSPATH . 'fmg-config.php', $config_content) === false) {
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
        setup_config_display_header(txt('setup_welcome_title'));
        echo '<p>' . txt('setup_vw_details1') . '</p>';
        echo '<p><strong>' . txt('setup_vw_details2') . '</strong></p>';
        echo '<div class="codebox-container">';
        echo '    <a class="codebox-button">' . txt('setup_button_copy') . '</a>';
        echo '    <div class="codebox-message">' . txt('setup_copied') . '</div>';
        echo '    <div class="codebox-box">' . $wv_code . '</div>'; // Sanitized WV code
        echo '</div>';
        echo '<p class="warning"><b>' . txt('setup_vw_important') . ':</b> ' . txt('setup_vw_warning1') . '</p>';
        echo '<p class="warning"><b>Important:</b> ' . txt(text: 'setup_vw_warning2') . '</p>';
        echo '<p>' . txt('setup_vw_details3') . '</p>';
        echo '<ul class="items-list"><li>';
        echo txt('setup_vw_options1');
        echo '</li><li>';
        echo txt('setup_vw_options2');
        echo '</li></ul>';
        echo '<p>' . txt('setup_vw_size1') . ' <strong>' . txt('setup_vw_size2') . '</strong></p>';
        echo '<p>' . txt('setup_vw_details4') . '</p>';
        echo '<div class="section-row-photo"><img src="images/setup-filemaker-webviewer-config.png"></div>';
        setup_config_display_footer();
        break;
}