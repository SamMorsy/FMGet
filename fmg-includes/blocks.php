<?php
/**
 * Used to set up all core blocks used inside FMGet.
 * 
 * Holds all the functions needed to generate HTML blocks dynamically
 * The HTML is generated server-side
 *
 * @package FMGet
 */


/**
 * Generate the HTML code for a title block and style it as 
 * needed using the metadata and echo it to the user.
 *
 * [
 * 'text' => '', 
 * 'siza' => '3', 
 * 'level' => '2', 
 * 'align' => 'left', 
 * 'mt' => '4', 
 * 'mb' => '2', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_title($metadata)
{
    $title_text = (isset($metadata['text'])) ? $metadata['text'] : "";
    $h_level = (isset($metadata['level'])) ? $metadata['level'] : 2;
    $font_size = (isset($metadata['size'])) ? " size" . $metadata['size'] : "";
    $align = (isset($metadata['align'])) ? " " . $metadata['align'] : "";
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt4";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb2";
    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";

    echo '<div class="fmg-ui-block' . $mt . $mb . '">';
    echo '<h' . $h_level . ' class="fmg-ui-title' . $font_size . $align . '"' . $custom_style . '>';
    echo $title_text;
    echo '</h' . $h_level . '>';
    echo '</div>';
}


/**
 * Generate the HTML code for a text block and style it as 
 * needed using the metadata and echo it to the user.
 *
 * [
 * 'text' => '', 
 * 'siza' => '2', 
 * 'align' => 'left', 
 * 'mt' => '0', 
 * 'mb' => '0', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_text($metadata)
{
    $text = (isset($metadata['text'])) ? $metadata['text'] : "";
    $font_size = (isset($metadata['size'])) ? " size" . $metadata['size'] : "";
    $align = (isset($metadata['align'])) ? " " . $metadata['align'] : "";
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt0";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb0";
    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";

    echo '<div class="fmg-ui-block' . $mt . $mb . '">';
    echo '<p class="fmg-ui-text' . $font_size . $align . '"' . $custom_style . '>';
    echo $text;
    echo '</p>';
    echo '</div>';
}


/**
 * Generate the HTML code for a link block and style it as 
 * needed using the metadata and echo it to the user.
 *
 * [
 * 'text' => '', 
 * 'url' => '', 
 * 'external' => false,
 * 'align' => 'left', 
 * 'mt' => '0', 
 * 'mb' => '0', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_link($metadata)
{
    $link_text = (isset($metadata['text'])) ? $metadata['text'] : "";
    $link_url = (isset($metadata['url'])) ? $metadata['url'] : "";
    $align = (isset($metadata['align'])) ? " text-" . $metadata['align'] : "";
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt0";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb0";

    if (isset($metadata['external']) && $metadata['external'] == true) {
        $ext_icon = ' &#x29c9;';
        $target = ' target="_blank"';
    } else {
        $ext_icon = '';
        $target = '';
    }

    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";

    echo '<div class="fmg-ui-block' . $mt . $mb . $align . '">';
    echo '<a' . $target . ' href="' . $link_url . '" class="fmg-ui-link"' . $custom_style . '>';
    echo $link_text . $ext_icon;
    echo '</a>';
    echo '</div>';
}


/**
 * Generate the HTML code for a separator block and style it as 
 * needed using the metadata and echo it to the user.
 *
 * [
 * 'visible' => false,
 * 'mt' => '1', 
 * 'mb' => '1', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_separator($metadata)
{
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt1";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb1";

    if (isset($metadata['visible']) && $metadata['visible'] == true) {
        $target = '<hr>';
    } else {
        $target = '';
    }

    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";

    echo '<div class="fmg-ui-block' . $mt . $mb . '">';
    echo '<div class="fmg-ui-separator"' . $custom_style . '>';
    echo $target;
    echo '</div>';
    echo '</div>';
}


/**
 * Generate the HTML / Javascript code for a message block and style it as 
 * needed using the metadata and echo it to the user.
 *
 * [
 * 'text' => '',
 * 'type' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_message($metadata)
{
    $text = (isset($metadata['text'])) ? $metadata['text'] : "";
    $type = (isset($metadata['type'])) ? $metadata['type'] : "default";

    echo '<script>';
    echo 'window.onload = () => {';
    echo 'fmg_showMessage("' . $text . '", "' . $type . '");';
    echo '};';
    echo '</script>';
}


/**
 * Generate the HTML code for a note block and style it as 
 * needed using the metadata and echo it to the user.
 *
 * [
 * 'text' => '',
 * 'type' => '',
 * 'mt' => '1', 
 * 'mb' => '1', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_note($metadata)
{
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt1";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb1";
    $text = (isset($metadata['text'])) ? $metadata['text'] : "";
    $type = (isset($metadata['type'])) ? " " . $metadata['type'] : " default";
    $align = (isset($metadata['align'])) ? " text-" . $metadata['align'] : "";
    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";

    echo '<div class="fmg-ui-block' . $mt . $mb . '">';
    echo '<div class="fmg-ui-note' . $type . $align . '"' . $custom_style . '>';
    echo $text;
    echo '</div>';
    echo '</div>';
}


/**
 * Generate the HTML open code for a column and style it as 
 * needed using the metadata and echo it to the user.
 *
 * [
 * 'size' => '6',
 * 'align' => 'left', 
 * 'mt' => '0', 
 * 'mb' => '0', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_column_open($metadata)
{
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt0";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb0";
    $col_size = (isset($metadata['size'])) ? " size" . $metadata['size'] : " size6";
    $align = (isset($metadata['align'])) ? " text-" . $metadata['align'] : "";
    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";
    echo '<!-- open column -->';
    echo '<div class="fmg-ui-column' . $align . $col_size . $mt . $mb . '"' . $custom_style . '>';
}


/**
 * Generate the HTML close code for a column and style it as 
 * needed using the metadata and echo it to the user.
 *
 * @return void
 */
function block_column_close()
{
    echo '</div>';
    echo '<!-- close column -->';
}


/**
 * Generate the HTML open code for a row and style it as 
 * needed using the metadata and echo it to the user.
 *
 * [
 * 'size' => '6',
 * 'align' => 'left', 
 * 'mt' => '0', 
 * 'mb' => '0', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_row_open($metadata)
{
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt0";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb0";
    $align = (isset($metadata['align'])) ? " " . $metadata['align'] : "";
    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";
    echo '<!-- open row -->';
    echo '<div class="fmg-ui-row' . $align . $mt . $mb . '"' . $custom_style . '>';
}


/**
 * Generate the HTML close code for a row and style it as 
 * needed using the metadata and echo it to the user.
 *
 * @return void
 */
function block_row_close()
{
    echo '</div>';
    echo '<!-- close row -->';
}


/**
 * Generate the HTML code for a field block and style it as 
 * needed using the metadata and echo it to the user.
 * 
 * Next update to add required tag
 * 
 * [
 * 'label' => '', 
 * 'text' => '', 
 * 'name' => '', 
 * 'hint' => '', 
 * 'type' => 'text', 
 * 'disabled' => false,
 * 'align' => 'left', 
 * 'mt' => '1', 
 * 'mb' => '1', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_field($metadata)
{
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt1";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb1";
    $name = (isset($metadata['name'])) ? $metadata['name'] : "";
    $text = (isset($metadata['text'])) ? $metadata['text'] : "";
    $label = (isset($metadata['label'])) ? $metadata['label'] : "";
    $type = (isset($metadata['type'])) ? $metadata['type'] : "text";
    $hint = (isset($metadata['hint'])) ? '<p class="fmg-ui-hint">' . $metadata['hint'] . '</p>' : "";
    $align = (isset($metadata['align'])) ? " " . $metadata['align'] : "";

    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";

    if (isset($metadata['disabled']) && $metadata['disabled'] == true) {
        $disabled_tag = ' disabled';
    } else {
        $disabled_tag = '';
    }

    echo '<div class="fmg-ui-block' . $mt . $mb . '">';
    echo '<div class="fmg-ui-field-container">';
    echo '<input type="' . $type . '" name="' . $name . '" value="' . $text . '" class="fmg-ui-field' . $align . $disabled_tag . '" id="input-' . $name . '" placeholder=" "' . $custom_style . $disabled_tag . ' />';
    echo '<label for="input-' . $name . '" class="fmg-ui-field-label">' . $label . '</label>';
    echo '</div>';
    echo $hint;
    echo '</div>';
}


/**
 * Generate the HTML code for a dropdown menu block and style it as 
 * needed using the metadata and echo it to the user.
 * 
 * Next update to add required tag
 * 
 * [
 * 'label' => '', 
 * 'text' => '', 
 * 'name' => '', 
 * 'hint' => '', 
 * 'type' => 'text', 
 * 'disabled' => false,
 * 'required' => false,
 * 'align' => 'left', 
 * 'mt' => '1', 
 * 'mb' => '1', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @param array  $options   Dropdown menu options.
 * @return void
 */
function block_menufield($metadata, $options)
{
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt1";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb1";
    $name = (isset($metadata['name'])) ? $metadata['name'] : "";
    $text = (isset($metadata['text'])) ? $metadata['text'] : "";
    $label = (isset($metadata['label'])) ? $metadata['label'] : "";
    $type = (isset($metadata['type'])) ? $metadata['type'] : "text";
    $hint = (isset($metadata['hint'])) ? '<p class="fmg-ui-hint">' . $metadata['hint'] . '</p>' : "";
    $align = (isset($metadata['align'])) ? " " . $metadata['align'] : "";
    $dbtable = '';

    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";

    if (isset($metadata['disabled']) && $metadata['disabled'] == true) {
        $disabled_tag = ' disabled';
    } else {
        $disabled_tag = '';
    }

    if (isset($metadata['required']) && $metadata['required'] == true) {
        $required_attr = ' required';
    } else {
        $required_attr = '';
    }

    echo '<div class="fmg-ui-block' . $mt . $mb . '">';
    echo '<div class="fmg-ui-field-container menu">';
    echo '<input type="' . $type . '" name="' . $name . '" value="' . $text . '" class="fmg-ui-field' . $align . $disabled_tag . '" id="input-' . $name . '" placeholder=" "' . $custom_style . $disabled_tag . ' ';
    echo 'oninput="fmg_dropdownfilterOptions(this)" ';
    echo 'onfocus="fmg_dropdownshow(this)" ';
    echo 'onblur="fmg_dropdownhide(this)" ' . $required_attr . '>';
    echo '<label for="input-' . $name . '" class="fmg-ui-field-label">' . $label . '</label>';
    echo '<div class="fmg-ui-field-options" onclick="fmg_dropdownselectOption(event)">';

    foreach ($options as $entry) {
        $dbtable .= "<div>{$entry}</div>";
    }

    echo $dbtable;
    echo '</div>';
    echo '</div>';
    echo $hint;
    echo '</div>';
}


/**
 * Generate the HTML code for a checkbox block and style it as 
 * needed using the metadata and echo it to the user.
 * 
 * Next update to add required tag
 * 
 * [
 * 'label' => '', 
 * 'name' => '', 
 * 'hint' => '', 
 * 'disabled' => false,
 * 'checked' => false,
 * 'mt' => '1', 
 * 'mb' => '1', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_checkbox($metadata)
{
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt1";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb1";
    $name = (isset($metadata['name'])) ? $metadata['name'] : "";
    $label = (isset($metadata['label'])) ? $metadata['label'] : "";
    $hint = (isset($metadata['hint'])) ? '<p class="fmg-ui-hint">' . $metadata['hint'] . '</p>' : "";

    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";

    if (isset($metadata['disabled']) && $metadata['disabled'] == true) {
        $disabled_tag = ' disabled';
    } else {
        $disabled_tag = '';
    }
    if (isset($metadata['checked']) && $metadata['checked'] == true) {
        $checked_tag = ' checked';
    } else {
        $checked_tag = '';
    }

    echo '<div class="fmg-ui-block' . $mt . $mb . '">';
    echo '<label class="fmg-ui-checkbox-container">';
    echo '<input type="checkbox" name="' . $name . '" ' . $checked_tag . ' class="fmg-ui-checkbox' .  $disabled_tag . '" ' . $custom_style . $disabled_tag . ' />';
    echo '<span class="fmg-ui-checkmark"></span>';
    echo $label;
    echo '</label>';
    echo $hint;
    echo '</div>';
}


/**
 * Generate the HTML code for a textarea block and style it as 
 * needed using the metadata and echo it to the user.
 * 
 * Next update to add required tag
 * 
 * [
 * 'label' => '', 
 * 'text' => '', 
 * 'name' => '', 
 * 'hint' => '', 
 * 'disabled' => false,
 * 'align' => 'left', 
 * 'mt' => '1', 
 * 'mb' => '1', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_textarea($metadata)
{
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt2";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb2";
    $name = (isset($metadata['name'])) ? $metadata['name'] : "";
    $text = (isset($metadata['text'])) ? $metadata['text'] : "";
    $label = (isset($metadata['label'])) ? $metadata['label'] : "";
    $hint = (isset($metadata['hint'])) ? '<p class="fmg-ui-hint">' . $metadata['hint'] . '</p>' : "";
    $align = (isset($metadata['align'])) ? " " . $metadata['align'] : "";

    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";

    if (isset($metadata['disabled']) && $metadata['disabled'] == true) {
        $disabled_tag = ' disabled';
    } else {
        $disabled_tag = '';
    }

    echo '<div class="fmg-ui-block' . $mt . $mb . '">';
    echo '<div class="fmg-ui-field-container">';
    echo '<textarea name="' . $name . '" class="fmg-ui-textarea' . $align . $disabled_tag . '" id="input-' . $name . '" placeholder=" "' . $custom_style . $disabled_tag . ' />' . $text . '</textarea> ';
    echo '<label for="input-' . $name . '" class="fmg-ui-textarea-label">' . $label . '</label>';
    echo '</div>';
    echo $hint;
    echo '</div>';
}


/**
 * Generate the HTML code for a checkbox block and style it as 
 * needed using the metadata and echo it to the user.
 * 
 * Next update to add required tag
 * 
 * [
 * 'label' => '', 
 * 'name' => '', 
 * 'hint' => '', 
 * 'disabled' => false,
 * 'checked' => false,
 * 'mt' => '1', 
 * 'mb' => '1', 
 * 'style' => ''
 * ]
 * 
 * @param array  $metadata   Block metadata.
 * @return void
 */
function block_radio($metadata)
{
    $mt = (isset($metadata['mt'])) ? " mt" . $metadata['mt'] : " mt1";
    $mb = (isset($metadata['mb'])) ? " mb" . $metadata['mb'] : " mb1";
    $name = (isset($metadata['name'])) ? $metadata['name'] : "";
    $label = (isset($metadata['label'])) ? $metadata['label'] : "";
    $hint = (isset($metadata['hint'])) ? '<p class="fmg-ui-hint">' . $metadata['hint'] . '</p>' : "";

    $custom_style = (isset($metadata['style'])) ? ' style="' . $metadata['style'] . '"' : "";

    if (isset($metadata['disabled']) && $metadata['disabled'] == true) {
        $disabled_tag = ' disabled';
    } else {
        $disabled_tag = '';
    }
    if (isset($metadata['checked']) && $metadata['checked'] == true) {
        $checked_tag = ' checked';
    } else {
        $checked_tag = '';
    }

    echo '<div class="fmg-ui-block' . $mt . $mb . '">';
    echo '<label class="fmg-ui-radio-container">';
    echo '<input type="radio" name="' . $name . '" ' . $checked_tag . ' class="fmg-ui-radio' .  $disabled_tag . '" ' . $custom_style . $disabled_tag . ' />';
    echo '<span class="fmg-ui-radiomark"></span>';
    echo $label;
    echo '</label>';
    echo $hint;
    echo '</div>';
}