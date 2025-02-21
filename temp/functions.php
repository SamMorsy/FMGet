<?php

function currentTimestampWithTimezoneUS()
{
    // Set the timezone to a US timezone
    date_default_timezone_set('America/New_York');
    $timestamp = date('m/d/Y h:i:s A');
    // Get the current timezone
    $timezone = date_default_timezone_get();

    return $timestamp . " " . $timezone;
}

function outunset($entry)
{
    if (isset($_SESSION[$entry])) {
        echo htmlspecialchars($_SESSION[$entry]);
        unset($_SESSION[$entry]);
    } else {
        echo "";
    }
}

function set_csrf()
{
    if (!isset($_SESSION["csrf"])) {
        $_SESSION["csrf"] = bin2hex(random_bytes(50));
    }
    echo '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
}

function is_csrf_valid()
{
    if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
        return false;
    }
    if ($_SESSION['csrf'] != $_POST['csrf']) {
        return false;
    }
    return true;
}

function loginentry()
{
    global $db_misc;

    // Get POST variables
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!is_csrf_valid()) {
        errorOut("Connection not secured.");
    }
    // Check if email or password is empty
    if (empty($email) || empty($password)) {
        loginError("Email or password cannot be empty.");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        loginError("Invalid email format.");
    }

    // Check for potential SQL injection (basic sanitization)
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

    try {
        // Generate password hash
        $passwordHash = hash('sha256', $password);

        // Prepare and execute the SQL query
        $stmt = $db_misc->prepare("SELECT * FROM clients WHERE email = :email AND passwordhash = :passwordhash");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':passwordhash', $passwordHash, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Save user data to the session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_status'] = $row['status'];
            $_SESSION['user_name'] = $row['fullname'];
            $_SESSION['user_company'] = $row['companyname'];
            $_SESSION['user_subenddate'] = $row['subend_date'];
            $_SESSION['user_subtype'] = $row['subtype'];
            $_SESSION['user_staff'] = $row['staffuser'];
            $_SESSION['user_createddate'] = $row['created_at'];
        } else {
            loginError("Invalid email or password.");
        }
    } catch (PDOException $e) {
        errorOut("Database error: " . $e->getMessage());
    }

    // Status check
    switch ($_SESSION['user_status']) {
        case 'pending':
            loginCancel();
            loginError("This account is not verified yet, Please check your Email.");
            break;
        case 'banned':
            loginCancel();
            loginError("This account is not active, Please contact us for more details.");
            break;
    }

    // Payment check


    gotopage("home");
}

function logoutUser()
{
    // Start the session if it's not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Clear all session variables
    $_SESSION = [];

    // Destroy the session cookie if it exists
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    // Destroy the session
    session_destroy();
    gotopage("login");
}

function viewProjectsList()
{
    global $db_main;

    // Initialize an empty string for the projects list
    $projectsList = '';

    // Query to fetch project data
    $querySQL = "
    SELECT *
    FROM projects
    WHERE client_id = :client_id
    ";
    
    $stmt = $db_main->prepare($querySQL);

    try {
        // Execute the query with the current user's client ID
        $stmt->execute([
            ':client_id' => $_SESSION['user_id']
        ]);

        // Fetch all results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if any results were returned
        if ($results) {
            foreach ($results as $result) {
                // Extract data for the current project
                $projectData_projectID = $result["project_id"];
                $projectData_templateID = $result["template_id"];
                $projectData_name = $result["project_name"];
                $projectData_server = $result["server_address"];
                $projectData_database = $result["database_name"];
                $projectData_template = $result["template_name"];

                // Append the HTML for the current project to the list
                $projectsList .= '                <tr>
                    <td>
                        <a href="project/' . htmlspecialchars($projectData_templateID) . '/' . htmlspecialchars($projectData_projectID) . '" class="fmg_SectionList_title">' . htmlspecialchars($projectData_name) . '</a>
                        <div class="fmg_SectionList_description">' . htmlspecialchars($projectData_template) . '</div>
                    </td>
                    <td>
                        <div class="fmg_SectionList_version">' . htmlspecialchars($projectData_database) . '</div>
                        <div class="fmg_SectionList_date">' . htmlspecialchars($projectData_server) . '</div>
                    </td>
                </tr>';
            }
        } else {
            // If no results, add a message indicating no projects found
            $projectsList .= '<tr><td colspan="2">No projects found</td></tr>';
        }
    } catch (PDOException $e) {
        errorOut("Database error: " . $e->getMessage());
    }

    // Include the template file
    include_once getPath_layouts("projects_list");
}

function gui_showDatabaseList($template_ID, $project_id, $server, $username, $password)
{

    $authUrl = "https://" . $server . "/fmi/data/vLatest/databases";
    $authHeaders = [
        "Authorization: Basic " . base64_encode($username . ":" . $password),
        "Content-Type: application/json"
    ];

    $ch = curl_init($authUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $authData = json_decode($response, true);

    if (isset($authData['messages'][0]['message'])) {
        if (!isset($authData['response']['databases'])) {
            newProjectError($template_ID, "Error: No databases available.");
        }
    } else {
        newProjectError($template_ID, "Error: Unable to connect to server.");
    }
    $dbtable = '';
    foreach ($authData['response']['databases'] as $entry) {
        $dbname = $entry['name'];

        $dbtable .= '<tr>
                    <td>
                <a href="projectselectdb/' . $template_ID . '/' . $project_id . '/' . htmlspecialchars($dbname) . '" class="fmg_project_title">' . htmlspecialchars($dbname) . '</a>
                    </td>
            </tr>';
    }

    include_once getPath_layouts("comp_databaselist");
}

function project_getKeyAPI($template_ID, $project_id, $projectData_server, $projectData_username, $projectData_password, $projectData_database)
{
    if (isset($_SESSION['api' . $project_id]) && !empty($_SESSION['api' . $project_id])) {
        $authUrl = "https://" . $projectData_server . "/fmi/data/vLatest/validateSession";
        $authHeaders = [
            "Authorization: Bearer " . $_SESSION['api' . $project_id],
            "Content-Type: application/json"
        ];

        $ch = curl_init($authUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $authData = json_decode($response, true);

        if (isset($authData['messages'][0]['message'])) {
            $respounseflag = $authData['messages'][0]['message'];
            if ($respounseflag == "OK") {
                return true;
            }
        } else {
            errorOut("This project is not available. [00103]");
        }
    }



    $authUrl = "https://" . $projectData_server . "/fmi/data/vLatest/databases/" . $projectData_database . "/sessions";
    $authHeaders = [
        "Authorization: Basic " . base64_encode($projectData_username . ":" . $projectData_password),
        "Content-Type: application/json"
    ];

    $emptyPayload = '{}';

    $ch = curl_init($authUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $emptyPayload);
    $response = curl_exec($ch);
    curl_close($ch);

    $authData = json_decode($response, true);

    if (isset($authData['response']['token'])) {
        $token = $authData['response']['token'];
        $_SESSION['api' . $project_id] = $token;
    } else {
        errorOut("This project is not available. [00103]");
    }
}

function gui_generateLayoutTableRows($layouts, $path = '')
{
    $rows = '';

    foreach ($layouts as $layout) {
        if (isset($layout['isFolder']) && $layout['isFolder'] === true) {
            // It's a folder, so recursively process its contents
            $folderPath = $path . $layout['name'] . '/';
            $rows .= gui_generateLayoutTableRows($layout['folderLayoutNames'], $folderPath);
        } else {
            // It's a regular layout, generate the table row
            $layoutName = $layout['name'];
            $layoutPath = $path . $layoutName;
            if ($layoutName !== "-") {
                $rows .= '<tr>
                <td>
                    <a href="projectselectlayout/' . htmlspecialchars($layoutName) . '" class="fmg_project_title">' . htmlspecialchars($layoutName) . '</a>
                    <div class="fmg_project_description">' . htmlspecialchars($layoutPath) . '</div>
                </td>
              </tr>';
            }
        }
    }

    return $rows;
}

function project_generateScriptsList($scripts, $path = '')
{
    $result = [];

    foreach ($scripts as $script) {
        if (isset($script['isFolder']) && $script['isFolder'] === true) {
            // It's a folder, recursively process its contents
            $folderPath = $path . $script['name'] . '/';
            $result = array_merge($result, project_generateScriptsList($script['folderScriptNames'], $folderPath));
        } else {
            // It's a regular script, add its details to the result array
            $scriptName = $script['name'];
            $scriptPath = $path . $scriptName;
            if ($scriptName !== "-") {
                $result[] = [
                    'name' => $scriptName,
                    'path' => $scriptPath,
                ];
            }
        }
    }

    return $result;
}

function gui_showLayoutList($template_ID, $project_id, $server, $database)
{
    $authUrl = "https://" . $server . "/fmi/data/vLatest/databases/" . $database . "/layouts";
    $authHeaders = [
        "Authorization: Bearer " . $_SESSION['api' . $project_id],
        "Content-Type: application/json"
    ];

    $ch = curl_init($authUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $authData = json_decode($response, true);
    $dbtable = "";

    if (isset($authData['messages'][0]['message'])) {
        $respounseflag = $authData['messages'][0]['message'];
        if ($respounseflag !== "OK") {
            errorOut("This project is not available. [00103]");
        }
    } else {
        errorOut("This project is not available. [00103]");
    }

    $layouts = $authData['response']['layouts'];

    $layouttable = gui_generateLayoutTableRows($layouts);
    $layouttable = str_replace("projectselectlayout/", "projectselectlayout/" . $template_ID . "/" . $project_id . "/", $layouttable);

    include_once getPath_layouts("comp_layoutlist");
}

function project_setSettings(&$settings, $errorname, $path, $postName, $limits, $noempty = false, $nonull = false)
{
    // Check the post variable
    if (isset($_POST[$postName])) {
        $value = $_POST[$postName];
    } elseif (!$nonull) {
        $value = "";
    } else {
        $current = &$settings;
        $current["errors"][] = $errorname . " can't be empty";
        return;
    }

    // Exit the function if the length of $value is longer than $limits
    if (strlen($value) >= $limits) {
        $current = &$settings;
        $current["errors"][] = $errorname . " can't be longer than " . $limits . " letters";
        return;
    }

    // Exit the function if $noempty is true and $value is empty
    if ($noempty && empty($value)) {
        $current = &$settings;
        $current["errors"][] = $errorname . " can't be empty";
        return;
    }

    // Sanitize $value (e.g., remove special characters, trim whitespace)
    $sanitizedValue = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');

    // Convert the path string into a nested array path
    $pathParts = explode('/', $path);

    // Reference $settings to assign the value
    $current = &$settings;
    foreach ($pathParts as $part) {
        // Ensure the current level exists as an array
        if (!isset($current[$part]) || !is_array($current[$part])) {
            $current[$part] = [];
        }
        $current = &$current[$part];
    }

    // Assign the sanitized value
    $current = $sanitizedValue;
}

function project_getSettings(&$settings, $path, $noempty = false)
{
    // Convert the path string into a nested array path
    $pathParts = explode('/', $path);

    // Reference $settings to navigate the path
    $current = &$settings;
    foreach ($pathParts as $part) {
        if (!isset($current[$part])) {
            // If $noempty is true, exit if the value is not set or is empty
            if ($noempty) {
                return;
            }
            // If $noempty is false, return an empty string if not set
            return '';
        }
        $current = &$current[$part];
    }

    // Final check for $noempty: if true and the value is empty, exit
    if ($noempty && empty($current)) {
        return;
    }

    // Return the value found at the path
    return $current;
}

function project_saveSettings(&$settings, $projectStage, $template_ID, $project_id, $refresh = true)
{
    global $db_main;

    if (!empty(project_getSettings($settings, "errors"))) {
        $errorslist = "";
        foreach ($settings["errors"] as $error) {
            $errorslist .= "<p>" . htmlspecialchars($error) . "</p>";
        }
        $_SESSION['errorMessage'] = $errorslist;
    } else {
        $jsonSettings = json_encode($settings);

        try {
            // Define the SQL query to update the row
            $updateSQL = "
                    UPDATE projects
                    SET stage = :stage,
                        arr_settings = :arr_settings
                    WHERE project_id = :project_id
                ";
            $stmt = $db_main->prepare($updateSQL);
            $stmt->execute([
                ':stage' => $projectStage,
                ':arr_settings' => $jsonSettings,
                ':project_id' => $project_id,
            ]);
        } catch (PDOException $e) {
            errorOut("Database error: " . $e->getMessage());
        }
    }

    // open updated project page [Optional, Default]
    if ($refresh) {
        gotopage("project/$template_ID/$project_id");
    }
}

function gui_projectFormOpen($template_ID, $project_id, $formTitle, $sub_action = "state")
{
    $sub_actionFull = '/' . $sub_action;
    echo '<h1 class="fmg_project_form-fulltitle">' . $formTitle . '</h1>';
    echo '<form action="projectupdate/' . $template_ID . '/' . $project_id . $sub_actionFull . '" method="POST">';
}

function gui_projectFormClose()
{
    echo '  <div class="fmg_project_form-buttons">
                <button type="submit" class="fmg_project_button fmg_project_button-next">Next</button>
            </div>
    </form>';
}

function gui_projectShowField(&$settings, $tag_name, $label, $tag_type = "text", $path = "", $tag_required = false) {
    $required_attr = $tag_required ? 'required' : '';
    $tag_default = project_getSettings($settings, $path);
    echo "
    <div class='fmg_formentry_field'>
        <label for='fmg_formentry_{$tag_name}' class='fmg_formentry_label'>{$label}</label>
        <input type='{$tag_type}' id='fmg_formentry_{$tag_name}' name='{$tag_name}' class='fmg_formentry_input' value='{$tag_default}' {$required_attr}>
    </div>
    ";
}

function gui_projectShowCheckbox(&$settings, $tag_name, $label, $path = "", $tag_required = false) {
    $required_attr = $tag_required ? 'required' : '';
    $checked_attr = project_getSettings($settings, $path) == "on" ? 'checked' : '';
    echo "
    <div class='fmg_formentry_checkbox'>
        <input type='checkbox' id='fmg_formentry_{$tag_name}' name='{$tag_name}' class='fmg_formentry_input_checkbox' {$checked_attr} {$required_attr}>
        <label for='fmg_formentry_{$tag_name}' class='fmg_formentry_label'>{$label}</label>
    </div>
    ";
}

function gui_projectShowRadioGroup(&$settings, $tag_name, $groupLabel, $labels, $tag_values, $path = "", $tag_required = false) {
    $required_attr = $tag_required ? 'required' : '';
    $radios = "";

    foreach ($labels as $index => $label) {
        $value = $tag_values[$index];
        $id = "fmg_formentry_{$tag_name}_{$index}";
        $checked_attr = project_getSettings($settings, $path) === $value ? 'checked' : '';
        $radios .= "
        <div class='fmg_formentry_radio'>
            <input type='radio' id='{$id}' name='{$tag_name}' value='{$value}' class='fmg_formentry_input_radio' {$checked_attr} {$required_attr}>
            <label for='{$id}' class='fmg_formentry_label'>{$label}</label>
        </div>
        ";
    }

    echo "<div class='fmg_formentry_radiogroup'><label class='fmg_formentry_label'>{$groupLabel}</label>{$radios}</div>";
}

function gui_projectShowRemark($label) {

    echo "<div class='fmg_formentry_remark'>{$label}</div>";

}

function gui_projectShowFieldsList(&$settings, $tag_name, $label, $layout, $path = "", $tag_required = false, $refreshList = false, $project_id = "", $server = "", $database = "") {
    // get the layout name and sanatize it*
    // lookup in the project settings array to see if you can locate the fields list
    // if you can't, then send a request to the FM server for the list and then clean it and store it into the settings array
    // get the default value from the path
    // draw a select list

    $required_attr = $tag_required ? 'required' : '';
    $layoutDefault = project_getSettings($settings, $path);
    $fieldsList = project_getSettings($settings, "scheme/" . $layout . "/fields");
    $dbtable = "";
    if (empty($fieldsList) || $refreshList) {
        $fieldsList = [];
        $authUrl = "https://" . $server . "/fmi/data/vLatest/databases/" . $database . "/layouts/" . $layout;
        $authHeaders = [
            "Authorization: Bearer " . $_SESSION['api' . $project_id],
            "Content-Type: application/json"
        ];
    
        $ch = curl_init($authUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        $response = curl_exec($ch);
        curl_close($ch);
    
        $authData = json_decode($response, true);

        if (isset($authData['response']['fieldMetaData'])) {
            // Loop through each "data" entry and generate HTML rows
            $fieldsList = $authData['response']['fieldMetaData'];
        }
    }
    echo '<div class="fmg_formentry_dropdown">
    <label for="fmg_formentry_' . $tag_name . '" class="fmg_formentry_label">' . $label . '</label>
    <input type="text" placeholder="Search fields..." 
            value = "' . $layoutDefault . '"
            name = "' . $tag_name . '"
           oninput="fmg_formentry_dropdownfilterOptions(this)" 
           onfocus="fmg_formentry_dropdownshow(this)" 
           onblur="fmg_formentry_dropdownhide(this)" ' . $required_attr . '>
    <div class="fmg_formentry_dropdown-menu" onclick="fmg_formentry_dropdownselectOption(event)">';

    foreach ($fieldsList as $entry) {
        $fieldName = $entry['name'];

        $dbtable .= "<div>{$fieldName}</div>";
    }
    echo $dbtable;
    echo "</div></div>";
}

function gui_projectShowScriptsList(&$settings, $tag_name, $label, $path = "", $tag_required = false, $refreshList = false, $project_id = "", $server = "", $database = "") {
    // get the layout name and sanatize it*
    // lookup in the project settings array to see if you can locate the fields list
    // if you can't, then send a request to the FM server for the list and then clean it and store it into the settings array
    // get the default value from the path
    // draw a select list

    $required_attr = $tag_required ? 'required' : '';
    $layoutDefault = project_getSettings($settings, $path);
    $scriptsList = project_getSettings($settings, "scheme/scripts");
    $dbtable = "";
    if (empty($fieldsList) || $refreshList) {
        $scriptsList = [];
        $authUrl = "https://" . $server . "/fmi/data/vLatest/databases/" . $database . "/scripts";
        $authHeaders = [
            "Authorization: Bearer " . $_SESSION['api' . $project_id],
            "Content-Type: application/json"
        ];
    
        $ch = curl_init($authUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        $response = curl_exec($ch);
        curl_close($ch);
    
        $authData = json_decode($response, true);

        if (isset($authData['response']['scripts'])) {
            // Loop through each "data" entry and generate HTML rows
            $scriptsList = $authData['response']['scripts'];
            $scriptsList = project_generateScriptsList($scriptsList);

        }
    }
    echo '<div class="fmg_formentry_dropdown">
    <label for="fmg_formentry_' . $tag_name . '" class="fmg_formentry_label">' . $label . '</label>
    <input type="text" placeholder="Search fields..." 
            value = "' . $layoutDefault . '"
            name = "' . $tag_name . '"
           oninput="fmg_formentry_dropdownfilterOptions(this)" 
           onfocus="fmg_formentry_dropdownshow(this)" 
           onblur="fmg_formentry_dropdownhide(this)" ' . $required_attr . '>
    <div class="fmg_formentry_dropdown-menu" onclick="fmg_formentry_dropdownselectOption(event)">';

    foreach ($scriptsList as $entry) {
        $scriptName = $entry["name"];

        $dbtable .= "<div>{$scriptName}</div>";
    }

    echo $dbtable;
    echo "</div></div>";
    
}