<?php
include __DIR__ . '/admin-header.php';
?>

<div class="fmg-sidebar">
    <div class="fmg-sidebaritem-active">Install FMGet</div>
</div>

<div class="fmg-mainarea">

    <div class="fmg-form-object">
        Add a new web viewer in a secure layout that only admins can access
        Add the code to the field labeled "Web address"
    </div>

    <?php
    gui_codeBox("Web viewer code", $randomAuthCode);
    ?>

    <div class="fmg-form-object">
        Recommeneded web viewer size is 700*700 pt
        Make sure to select the option "Allow interaction with the web viewer content"
        Unselect the following options "Display progress bar" and "Display status bar"
    </div>

</div>

<?php
include __DIR__ . '/admin-footer.php';
?>