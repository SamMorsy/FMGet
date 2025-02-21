<?php
/**
 * These functions are needed to setup / manage FMGet.
 *
 * @package FMGet
 */


/**
 * Updates existing constants in the fmg-config.php file or adds new ones.
 *
 * @param array $updates An associative array of constants names and their values
 * @return boolean
 */
function config_update($updates)
{
    $configFile = ABSPATH . 'fmg-config.php';

    if (!file_exists($configFile)) {
        return false;
    }

    $configContent = file_get_contents($configFile);

    foreach ($updates as $update) {
        $constantName = $update['name'];
        $newValue = addslashes($update['value']);

        $pattern = "/define\s*\(\s*['\"]" . preg_quote($constantName, '/') . "['\"]\s*,\s*['\"].*?['\"]\s*\);/";
        $replacement = "define( '$constantName', '$newValue' );";

        $configContent = preg_replace($pattern, $replacement, $configContent);
    }

    return file_put_contents($configFile, $configContent) !== false;
}

/**
 * Generate a random string from letters and numbers.
 *
 * @param int $length The needed length of the random string
 * @return string
 */
function generate_random($length = 20)
{
    // Define the character set (letters and numbers)
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+-*()';
    $charactersLength = strlen($characters);
    $randomString = '';

    // Build the random string
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

/**
 * Generates the webviewer code for connection with FileMaker.
 *
 * @param string $authKey1 random generated private key
 * @param string $authKey2 random generated private key
 * @param string $authKey3 random generated private key
 * @global string $fmg_version           The FMGet version string.
 * 
 * @return string The webviewer code
 */
function generate_wv_code($authKey1, $authKey2, $authKey3)
{
    global $fmg_version;
    $adminLink = fmg_guess_url() . '/fmg-admin.php?action=connect';

    //Formatted the code to be ready for the FileMaker calculation engine, Open heredoc
    $html = <<<HTML
"data:text/html," &  "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <script>
        window.onload = function () {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '$adminLink';

            const fields = {
                con_user: '" & Get ( AccountName ) & "',
                con_file: '" & Get ( FileName ) & "',
                con_srv: '" & Let(v_srv = GetValue(Get(ConnectionAttributes);2); Right(v_srv; Length(v_srv) - Position(v_srv;" ";1;1))) & "',
                authKey1: '$authKey1',
                authKey2: '$authKey2',
                authKey3: '$authKey3'
            };

            for (const [key, value] of Object.entries(fields)) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = value;
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();
        };
    </script>
</head>
<body>
    <p>Redirecting, please wait...</p>
    <!-- FMGet $fmg_version www.fmget.com -->
</body>
</html>"
HTML;
    //Close heredoc
    //IMPORTANT: Don't add anything before HTML; on the same line

    return htmlspecialchars($html); // Escape to safely embed in the box
}

/**
 * Generate the HTML header for the admin area
 *
 * @param string    $title      Field name to pick from metadata.
 * @param boolean   $sidebar    Optional. Index of the script to register when multiple items passed.
 *                              Default true.
 * @return void
 */
function page_admin_start($title = "", $sidebar = true)
{

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noindex,nofollow" />
        <link rel="icon" href="data:," />
        <title>FMGet - Dashboard</title>
        <link rel='stylesheet' href='fmg-admin/css/admin.css' type='text/css' />
        <link rel='stylesheet' href='fmg-includes/css/blocks.css' type='text/css' />
    </head>

    <body>
        <div class="fmg-ui-header">
            <div class="fmg-ui-header-group">
                <?php if ($sidebar) { ?>
                    <span class="fmg-ui-menu-btn" onclick="toggleSidebar()">&#9776;</span>
                <?php } ?>
                <strong><?php echo $title; ?></strong>
            </div>
            <div class="fmg-ui-header-group">Powered by <a class="fmg-ui-link" target="_blank"
                    href="https://fmget.com">FMGet</a></div>
        </div>
        <?php if ($sidebar) { ?>
            <div class="fmg-ui-sidebar" id="sidebar">
                <p>Sidebar content</p>
            </div>
            <div class="fmg-ui-overlay" id="overlay" onclick="toggleSidebar()"></div>
        <?php } ?>

        <div class="fmg-ui-container">
            <?php

}

/**
 * Generate the HTML footer for the admin area
 *
 *
 * @return void
 */
function page_admin_end()
{

    ?>
        </div>

        <script src="fmg-admin/js/admin.js"></script>
        <script src="fmg-includes/js/blocks.js"></script>
    </body>

    </html>
    <?php

}
