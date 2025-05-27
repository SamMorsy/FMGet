<?php
return [
    "login_username_label" => "Username",
    "login_password_label" => "Password",
    "login_button_label" => "Log In",
    "login_error1" => "Username and password can't be empty.",
    "login_error2" => "Invalid username or password.",
    "login_error3" => "Session timed out, Please try again.",
    'login_title' => 'Sign in to continue',
    "admin_area" => "Admin Area",
    "download" => "Download",
    "go" => "Go",

    "sidemenu_goto_website" => "View Website",
    "sidemenu_dashboard" => "Dashboard",
    "sidemenu_browse" => "Browse Database",

    "sidemenu_pages" => "Pages & Theme",
    "sidemenu_form_settings" => "Form Settings",
    "sidemenu_customize" => "Customize Theme",
    "sidemenu_landing" => "Landing Page",
    "sidemenu_form" => "Form Page",
    "sidemenu_submit" => "Submit Page",
    "sidemenu_submit_error" => "Error Page",
    "sidemenu_custom" => "Custom CSS / JS",
    "sidemenu_seo" => "SEO & Accessibility",
    "sidemenu_cookies" => "Cookies Message",

    "sidemenu_apis" => "APIs",
    "sidemenu_all_apis" => "All APIs",
    "sidemenu_new_apis" => "Add New",

    "sidemenu_logs" => "Logs",
    "sidemenu_all_logs" => "All Logs",
    "sidemenu_logs_settings" => "Logs Settings",

    "sidemenu_settings" => "Settings",
    "sidemenu_general_settings" => "General Settings",
    "sidemenu_security" => "Security",

    "sidemenu_logout" => "Log out",
    "dashboard_title_links" => "Dashboard:",
    "dashboard_title_logs" => "Most recent system logs:",

    "dashboard_link_Changelog" => "Changelog",
    "dashboard_link_news" => "Articles and news",
    "dashboard_link_Documentation" => "Documentation",
    "dashboard_link_Support" => "Support",

    "dashboard_notice_version" => "[ FMGet V",
    "dashboard_notice_version2" => " ] New version of FMGet is available, you can download it from the link below:",
    "seassion_end" => "Seassion ended.",

    "dashboard_title_settings" => "General Settings",
    "config_language_label" => "Selected language",
    "example" => "Example",
    "update" => "Update",
    "config_title2" => "Database Configurations",
    "config_sitename_label" => "Site Name",
    "config_fmusername_label" => "Database Username",
    "config_fmpassword_label" => "Database Password",
    "config_fmserver_hint" => "The web address for your FileMaker server, Without leading www or https:// or trailing slashes, IP address are not allowed, The address must be a public domain.",
    "config_fmserver_label" => "FileMaker Server Address",
    "config_timezone_label" => "Timezone",
    "config_dateformat_label" => "Date Format",
    "config_selectdb" => "Available databases on your server:",
    "config_dbaccess" => "Below you should enter the details of the account you use to access the database.",
    "config_email_label"=> "FMGet Admin Email Address",
    "config_email_hint"=> "Double check your email address before continuing.",
    "error_sitename_required" => "The site name is required.",
    "error_timezone_required" => "The time zone is required.",
    "error_fmusername_required" => "The database username is required.",
    "error_fmpassword_required" => "The database password is required.",
    "error_dateformat_required" => "The date format is required.",
    "error_email_required" => "The email address is required.",
    "error_fmdatabase_required" => "No database was selected.",
    "error_fmserver_required" => "The FM Server address is required.",
    "error_language_required" => "The language is required.",

    "error_dateformat_error" => "This date format is not valid, please check again.",
    "error_timezone_error" => "This time zone is not valid, please check again.",
    "error_email_error" => "This email address is not valid, please check again.",

    "error_fmserver_invalid" => "FMGet was unable to detect this FM Server, please check the server address again.",
    "error_fmserver_nodatabase" => "The FM Server was detected, But no database was found for this username/password.",
    "alert_username_colon" => "The database username can't contain a colon ( : ) because it causes a conflict with the data API authentication.",
    "error_fmusername_colon" => "The database username must not include a colon.",
    
    "fmserver_otherdatabase" => "If you can't find your database in the list above then it may have been hidden or the data API is not enabled for it, you can try to connect to it by entering it's name in the field below.",
    "config_named_fmdatabase_label" => "Database Name",
    "config_named_fmdatabase_hint" => "Case sensitive - The database name without .fmp12.",

    "error_database_noaccess" => "FMGet is unable to access the database using this username / password.",
    "fmcloud_notice" => "For databases hosted by FileMaker Cloud, This version doesn't support connecting to a database using a Claris ID account, This option will be available soon.",

    "settings_updated" => "Settings have been updated.",
    "settings_language_updated" => "Language have been updated, Please refresh the page to load the new language.",

    "error_fmgusername_required" => "The admin username for FMGet is required.",
    "error_fmgpassword_required" => "The admin password for FMGet is required.",
    "error_fmgpassword_match" => "The admin passwords didn't match.",

    "title_security" => "Security Settings",

    "details_security" => "Below you can update the details of the admin account.",
    "security_username_label" => "Admin Username",
    "security_password_label" => "Admin New Password",
    "security_confirm_label" => "Confirm New Password",
    "details_security2" => "When updating the security settings in this page, it will log out all current users from the admins area.",

    "title_browse" => "Browse Database",

    "browse_layoutselect_note" => "Only the fields on this layout are accessble.",
    "browse_layoutselect_placeholder" => "Click here to select a layout",
    "browse_layoutselect_error" => "Unable to query the list of layouts from the FileMaker server.",

    "browse_nav_records" => "Browse records",

    "browse_page_next" => "Next Page",
    "browse_page_previous" => "Previous Page",

    "browse_msg_waiting" => "Loading the data, Please wait.",
    "browse_msg_failed" => "Faild to load the data, please try again.",

    "msg_nav_settings" => "Filter / Sort",

    "msg_nav_refresh" => "Refresh",

    "msg_nav_nodata" => "No data was found.",
    "browse_nav_options" => "Options",

    "browse_limit_placeholder" => "Records per page",
    "browse_offset_placeholder" => "Offset record",
    "browse_sort_type_placeholder" => "Sort direction",
    "browse_sort_field_placeholder" => "Sort by",

    "browse_sort_type_ascend" => "Ascend",
    "browse_sort_type_descend" => "Descend",
];