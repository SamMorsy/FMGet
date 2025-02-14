<?php

/**
 * Creates a config.php file and initializes it with the provided authentication keys.
 *
 * @param mixed $authKey1 The value for CONFIG_AUTH_KEY1
 * @param mixed $authKey2 The value for CONFIG_AUTH_KEY2
 * @param mixed $authKey3 The value for CONFIG_AUTH_KEY3
 * @return void
 */
function config_create($authKey1, $authKey2, $authKey3)
{
    $configFilePath = __DIR__ . '/fmg-includes/config.php';
    $configContent = "<?php\n\n";
    $configContent .= "// Configuration File\n";
    $configContent .= "define('CONFIG_AUTH_KEY1', " . var_export($authKey1, true) . ");\n";
    $configContent .= "define('CONFIG_AUTH_KEY2', " . var_export($authKey2, true) . ");\n";
    $configContent .= "define('CONFIG_AUTH_KEY3', " . var_export($authKey3, true) . ");\n";

    // Ensure the directory exists
    if (!is_dir(__DIR__ . '/includes')) {
        mkdir(__DIR__ . '/includes', 0755, true);
    }

    // Write the config content to the file
    file_put_contents($configFilePath, $configContent);
}

/**
 * Updates existing variables in the config.php file or adds new ones.
 *
 * @param array $variables An associative array of variable names and their values
 * @return void
 */
function config_set(array $variables)
{
    $configFilePath = __DIR__ . '/fmg-includes/config.php';

    if (!file_exists($configFilePath)) {
        throw new Exception("Config file not found. Please create it first using config_create().");
    }

    // Load the existing config file
    $configContent = file_get_contents($configFilePath);

    foreach ($variables as $variableName => $value) {
        // Prepare the new variable line
        $variableLine = "\$$variableName = " . var_export($value, true) . ";\n";

        // Update if the variable exists, otherwise add it
        if (preg_match("/\$$variableName\\s*=", $configContent)) {
            $configContent = preg_replace(
                "/\$$variableName\\s*=.*?;/",
                trim($variableLine),
                $configContent
            );
        } else {
            $configContent .= $variableLine;
        }
    }

    // Write the updated content back to the file
    file_put_contents($configFilePath, $configContent);
}

/**
 * Removes a variable from the config.php file if it exists.
 *
 * @param string $variableName The name of the variable to remove
 * @return void
 */
function config_unset($variableName)
{
    $configFilePath = __DIR__ . '/fmg-includes/config.php';

    if (!file_exists($configFilePath)) {
        throw new Exception("Config file not found. Please create it first using config_create().");
    }

    // Load the existing config file
    $configContent = file_get_contents($configFilePath);

    // Remove the variable if it exists
    $configContent = preg_replace(
        "/^\\$" . preg_quote($variableName, '/') . "\\s*=.*?;\\n?/m",
        '',
        $configContent
    );

    // Write the updated content back to the file
    file_put_contents($configFilePath, $configContent);
}

/**
 * Generate a random string from letters and numbers.
 *
 * @param int $length The needed length of the random string
 * @return string
 */
function generateRandomString($length = 20)
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
function getRedirectHtml($authKey1, $authKey2, $authKey3)
{
    global $fmg_version;
    $adminLink = 'https://'. fmg_guess_url() . '/fmg-admin.php?action=connect';

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