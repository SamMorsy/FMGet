<?php
/**
 * The side menu module for the admin area
 *
 * Displays the side menu with the current section highlighted
 * 
 * @package FMGet
 */


// Don't load directly.
if (!defined('FMGROOT')) {
    exit();
}
// Don't load directly.
if (!defined('FMG_ACTIVE_SIDEMENU')) {
    exit();
}

?>

<div class="nav-container">
    <ul class="nav-menu">
        <li><a href="index.php" target="_self"><?php echo txt("sidemenu_goto_website"); ?></a></li>

        <li><a href="admin/index.php" target="_self" <?php sidemenu_active_tag("dashboard"); ?>><?php echo txt("sidemenu_dashboard"); ?></a></li>

        <li><a href="#"<?php sidemenu_active_tag("browse"); ?>><?php echo txt("sidemenu_browse"); ?></a></li>

        <li>
            <a href="#"><?php echo txt("sidemenu_pages"); ?></a>
            <ul class="sub-menu">
                <li><a href="#"<?php sidemenu_active_tag("form_settings"); ?>><?php echo txt("sidemenu_form_settings"); ?></a></li>
                <li><a href="#"<?php sidemenu_active_tag("customize"); ?>><?php echo txt("sidemenu_customize"); ?></a></li>
                <li><a href="#"<?php sidemenu_active_tag("landing"); ?>><?php echo txt("sidemenu_landing"); ?></a></li>
                <li><a href="#"<?php sidemenu_active_tag("form"); ?>><?php echo txt("sidemenu_form"); ?></a></li>
                <li><a href="#"<?php sidemenu_active_tag("submit"); ?>><?php echo txt("sidemenu_submit"); ?></a></li>
                <li><a href="#"<?php sidemenu_active_tag("submit_error"); ?>><?php echo txt("sidemenu_submit_error"); ?></a></li>
                <li><a href="#"<?php sidemenu_active_tag("custom"); ?>><?php echo txt("sidemenu_custom"); ?></a></li>
                <li><a href="#"<?php sidemenu_active_tag("seo"); ?>><?php echo txt("sidemenu_seo"); ?></a></li>
                <li><a href="#"<?php sidemenu_active_tag("cookies"); ?>><?php echo txt("sidemenu_cookies"); ?></a></li>
            </ul>
        </li>

        <li>
            <a href="#"><?php echo txt("sidemenu_apis"); ?></a>
            <ul class="sub-menu">
                <li><a href="#"<?php sidemenu_active_tag("all_apis"); ?>><?php echo txt("sidemenu_all_apis"); ?></a></li>
                <li><a href="#"<?php sidemenu_active_tag("new_apis"); ?>><?php echo txt("sidemenu_new_apis"); ?></a></li>
            </ul>
        </li>

        <li>
            <a href="#"><?php echo txt("sidemenu_logs"); ?></a>
            <ul class="sub-menu">
                <li><a href="#"<?php sidemenu_active_tag("all_logs"); ?>><?php echo txt("sidemenu_all_logs"); ?></a></li>
                <li><a href="#"<?php sidemenu_active_tag("logs_settings"); ?>><?php echo txt("sidemenu_logs_settings"); ?></a></li>
            </ul>
        </li>

        <li>
            <a href="admin/settings.php" target="_self"><?php echo txt("sidemenu_settings"); ?></a>
            <ul class="sub-menu">
                <li><a href="admin/settings.php" target="_self" <?php sidemenu_active_tag("general_settings"); ?>><?php echo txt("sidemenu_general_settings"); ?></a></li>
                <li><a href="admin/security.php" target="_self" <?php sidemenu_active_tag("security"); ?>><?php echo txt("sidemenu_security"); ?></a></li>
            </ul>
        </li>

        <li><a href="admin/login.php?logout=1" target="_self"><?php echo txt("sidemenu_logout"); ?></a></li>
    </ul>
</div>