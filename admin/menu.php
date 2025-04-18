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

?>

<div class="nav-container">
    <ul class="nav-menu">
        <li><a href="<?php echo fmg_guess_url(); ?>">Go to website</a></li>

        <li><a href="#" class="active">Dashboard</a></li>

        <li>
            <a href="#">Pages & Theme</a>
            <ul class="sub-menu">
                <li><a href="#">Landing Page</a></li>
                <li><a href="#">Form Page</a></li>
                <li><a href="#">Submit Page</a></li>
                <li><a href="#">Customize Theme</a></li>
                <li><a href="#">Custom CSS / JS</a></li>
                <li><a href="#">Cookies message</a></li>
            </ul>
        </li>

        <li>
            <a href="#">APIs</a>
            <ul class="sub-menu">
                <li><a href="#">All APIs</a></li>
                <li><a href="#">Add new</a></li>
            </ul>
        </li>

        <li>
            <a href="#">Logs</a>
            <ul class="sub-menu">
                <li><a href="#">All Logs</a></li>
                <li><a href="#">Logs settings</a></li>
            </ul>
        </li>

        <li>
            <a href="#">Settings</a>
            <ul class="sub-menu">
                <li><a href="#">General settings</a></li>
                <li><a href="#">FileMaker settings</a></li>
                <li><a href="#">SEO & Accessibility</a></li>
                <li><a href="#">Security</a></li>
            </ul>
        </li>

        <li><a href="#">Log out</a></li>
    </ul>
</div>