<?php

setup_config_display_header(txt('setup_welcome_title'));
echo '<p>' . txt('setup_vw_details1') . '</p>';
echo '<p><strong>' . txt('setup_vw_details2') . '</strong></p>';

echo '<p class="warning"><b>' . txt('setup_vw_important') . ':</b> ' . txt('setup_vw_warning1') . '</p>';
echo '<p class="warning"><b>Important:</b> ' . txt('setup_vw_warning2') . '</p>';
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