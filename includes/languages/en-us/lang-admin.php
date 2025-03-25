<?php
return [
    "setup_welcome" => "Welcome to FMGet. Before getting started, you will need the following items.",

    "setup_req_ssl" => "Website with SSL enabled [https://]",
    "setup_req_php" => "PHP version 7.3 or greater",
    "setup_req_fms" => "FileMaker server version 18 or newer (SSL must be enabled)",
    "setup_req_api" => "FM server settings > Data API must be enabled",
    "setup_req_acc" => "[Full Access] database account and must have the fmrest extended privileges set enabled",

    "setup_back1" => "Select another language",

    "setup_button_install" => "Install FMGet",

    "setup_intro1" => "Need more help with configuring your website and FileMaker server?",
    "setup_intro2" => "Read the support article on setup.",

    "setup_error_ssl" => "SSL certificate wasn't detected, usually it's supplied to you by your web host. If you do not have it enabled, then you will need to contact them before you can continue.",
    "setup_back2" => "Try again",

    "setup_error_curl1" => "cURL is not enabled on this server. usually it's supplied to you by your web host. If you do not have it enabled, then you will need to contact them before you can continue.",
    "setup_error_curl2" => "cURL functions are not functioning correctly on this server. usually it's supplied to you by your web host. You will need to contact them before you can continue.",

    "setup_config_details1" => "Your website is ready! You've made it through this part of the installation. FMGet is now ready to be connected with your FileMaker server.",

    "setup_config_important" => "Important",
    "setup_config_warning1" => "Don't share your username and password with anyone, This enables the user to fully control the FMGet application and access the conected databases.",

    "setup_error_config" => "Error: Could not create fmg-config.php, Please check your web server configurations before you can continue.",

    "setup_config_title" => "FMGet Configurations",
    "example" => "Example",
    "try_again" => "Try Again",
    "continue" => "Continue",
    "setup_config_fmserver_hint" => "The web address for your FileMaker server, Without leading www or https:// or trailing slashes, IP address are not allowed, The address must be a public domain.",
    "setup_config_fmserver_label" => "FileMaker Server Address",
    "setup_config_timezone_label"=> "Timezone",
    "setup_config_dateformat_label"=> "Date Format",
    "setup_config_username_label"=> "FMGet Admin Username",
    "setup_config_username_hint" => "Username can have only alphanumeric characters, underscores, spaces, periods and hyphens.",
    "setup_config_password_label"=> "FMGet Admin Password",
    "setup_config_password_hint"=> "You will need this password to manage your FMGet, Please store it in a secure location.",
    "setup_config_email_label"=> "FMGet Admin Email Address",
    "setup_config_email_hint"=> "Double check your email address before continuing.",

    "setup_error_title" => "Error",
    "setup_error_fmserver_error" => "This FM Server address is not valid, please check again.",
    "setup_error_fmserver_required" => "The FM Server address is required to install FMGet.",
    "setup_config_title2" => "Database Configurations",
    "setup_config_details2" => "Please select your database and enter your FMGet username and password. Don't worry, you can always change these settings later.",

    "setup_config_sitename_label"=> "Site Name",
    "setup_config_fmusername_label"=> "Database Username",
    "setup_config_fmpassword_label"=> "Database Password",

    "setup_config_selectdb"=> "Available databases on your server:",
    "setup_config_dbaccess"=> "Below you should enter the details of the account you use to access the database.",

    "setup_error_sitename_required" => "The site name is required to install FMGet.",
    "setup_error_timezone_required" => "The time zone is required to install FMGet.",
    "setup_error_fmusername_required" => "The database username is required to install FMGet.",
    "setup_error_fmpassword_required" => "The database password is required to install FMGet.",

    "setup_error_dateformat_required" => "The date format is required to install FMGet.",
    "setup_error_fmgusername_required" => "The admin username is required to install FMGet.",
    "setup_error_fmgpassword_required" => "The admin password is required to install FMGet.",
    "setup_error_email_required" => "The email address is required to install FMGet.",
    "setup_error_fmdatabase_required" => "No database was selected.",

    "setup_error_dateformat_error" => "This date format is not valid, please check again.",
    "setup_error_timezone_error" => "This time zone is not valid, please check again.",
    "setup_error_email_error" => "This email address is not valid, please check again.",

    "setup_error_fmserver_invalid" => "FMGet was unable to detect this FM Server, please check the server address again.",
    "setup_error_fmserver_nodatabase" => "The FM Server was detected, But no database was found for this username/password.",

    "setup_fmserver_otherdatabase" => "If you can't find your database in the list above then it may have been hidden or the data API is not enabled for it, you can try to connect to it by entering it's name in the field below.",
    "setup_config_named_fmdatabase_label" => "Database Name",
    "setup_config_named_fmdatabase_hint" => "Case sensitive - The database name without .fmp12.",

    "setup_error_database_noaccess" => "FMGet is unable to access the database using this username / password.",
    "setup_fmcloud_notice" => "For databases hosted by FileMaker Cloud, This version doesn't support connecting to a database using a Claris ID account, This option will be available soon.",

    
    "setup_welcome_title" => "Welcome",
    "setup_welcome_details" => "FMGet had been installed. Log in to the admin dashboard to create and manage your pages and froms.",
    "setup_button_login" => "Log In",

    "setup_alert_username_colon" => "The database username can't contain a colon ( : ) because it causes a conflict with the data API authentication.",
    "setup_error_fmusername_colon" => "The database username must not include a colon.",

    "login_username_label"=> "Username",
    "login_password_label"=> "Password",
    "login_button_label" => "Log In",
    "login_error1" => "Username and password can't be empty.",
    "login_error2" => "Invalid username or password.",
    "login_error3" => "Session timed out, Please try again.",
    'login_title' => 'Sign in to continue',
    "admin_area" => "Admin Area",
];