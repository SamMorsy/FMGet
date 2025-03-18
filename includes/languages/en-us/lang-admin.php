<?php
return [
    "setup_welcome" => "Welcome to FMGet. Before getting started, you will need the following items.",

    "setup_req_ssl" => "Website with SSL enabled [https://]",
    "setup_req_php" => "PHP version 7.3 or greater",
    "setup_req_fms" => "FileMaker server version 18 or newer (SSL must be enabled)",
    "setup_req_api" => "FM server settings > Data API must be enabled",
    "setup_req_acc" => "[Full Access] database account (Access to the FileMaker data API must be enabled)",

    "setup_back1" => "Select another language",

    "setup_button_install" => "Install FMGet",

    "setup_intro1" => "Need more help with configuring your website and FileMaker server?",
    "setup_intro2" => "Read the support article on setup.",

    "setup_error_ssl" => "SSL certificate wasn't detected, usually it's supplied to you by your web host. If you do not have it enabled, then you will need to contact them before you can continue.",
    "setup_back2" => "Try again",

    "setup_error_curl1" => "cURL is not enabled on this server. usually it's supplied to you by your web host. If you do not have it enabled, then you will need to contact them before you can continue.",
    "setup_error_curl2" => "cURL functions are not functioning correctly on this server. usually it's supplied to you by your web host. You will need to contact them before you can continue.",
    "setup_copied" => "The code was copied to your clipboard",

    "setup_welcome_title" => "Welcome",
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
];