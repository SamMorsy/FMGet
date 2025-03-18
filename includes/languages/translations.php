<?php
/**
 * Contains a list of the available languages inside the app for fast access.
 * Also contains the core functions for loading language files.
 *
 * @package FMGet
 */


 /**
 * Define language array.
 *
 * Hold the list of languages available for this version of FMGet.
 * 
 * Extra languages can be added be adding their files to /includes/languages
 * and adding their details to this array.
 *
 * @global array $fmg_languages
 */
$fmg_languages = [
    'en-us' => 'English (US)',
    'de' => 'Deutsch',
    'nl' => 'Nederlands',
    'fr' => 'Français',
    'es' => 'Español',
    'it' => 'Italiano',
    'pt-pt' => 'Português (PT)',
    'pt-br' => 'Português (BR)',
    'no' => 'Norsk',
    'fi' => 'Suomi',
    'sv' => 'Svenska',
    'da' => 'Dansk',
    'ja' => '日本語',
    'pl' => 'Polski',
    'ko' => '한국어',
    'uk' => 'Українська',
    'is' => 'Íslenska',
    'lt' => 'Lietuvių',
    'et' => 'Eesti',
    'lv' => 'Latviski'
];


/**
 * Verify that the given language code is valid and load to be used.
 *
 * This function will load the default language en-us if it fails to load the given languages
 * or if it was executed without any languages code as a parameter.
 *
 * @param string    $language_code      Optional. the unique language code to be loaded.
 *                                      Default is en-us
 * @param string    $category           Optional. the category to be loaded, Could be admin / app.
 *                                      Default is apps
 * @global array    $fmg_languages      The FMGet array of languages.
 * @global array    $fmg_translations   The FMGet array of the selected language package.
 * 
 * @return void
 */
function fmg_load_language($language_code = '', $category = 'apps'){
    global $fmg_languages;
    global $fmg_translations;
    if (!empty($language_code)) {
        $language_clean_code = preg_replace('/[^a-z-]/', '', strtolower($language_code));
        if (!preg_match('/^[a-z]{2}(-[a-z]{2})?$/', $language_clean_code) || !array_key_exists($language_clean_code, $fmg_languages)) {
            $language_clean_code = 'en-us';
        }
    }elseif (defined('FMGLANG') && '' !== FMGLANG) {
        $language_clean_code = FMGLANG;
    } else {
        $language_clean_code = 'en-us';
    }

    $language_path = FMGROOT . FMGINC . '/languages/' . $language_clean_code . '/lang-' . $category . '.php';

    if (file_exists($language_path)) {
        $fmg_translations = include $language_path;
    } else {
        $fmg_translations = [];
    }
}

/**
 * Verify that the given language code is valid.
 *
 * This function will return the clean verified language code or the default language code.
 *
 * @param string    $language_code      The unique language code to be checked.
 *                                      Default is en-us
 * @global array    $fmg_languages      The FMGet array of languages.
 * 
 * @return string   The clean language code or the default language code
 */
function fmg_check_language_code($language_code){
    global $fmg_languages;
    if (!empty($language_code)) {
        $language_clean_code = preg_replace('/[^a-z-]/', '', strtolower($language_code));
        if (!preg_match('/^[a-z]{2}(-[a-z]{2})?$/', $language_clean_code) || !array_key_exists($language_clean_code, $fmg_languages)) {
            $language_clean_code = 'en-us';
        }
    }elseif (defined('FMGLANG') && '' !== FMGLANG) {
        $language_clean_code = FMGLANG;
    } else {
        $language_clean_code = 'en-us';
    }

    $language_path = FMGROOT . FMGINC . '/languages/' . $language_clean_code . '/lang-admin.php';

    if (!file_exists($language_path)) {
        $language_clean_code = 'en-us';
    }
    return $language_clean_code;
}

/**
 * Retrieves the translation of $text.
 *
 * If there is no translation, the original text is returned.
 *
 * @global array    $fmg_translations   The FMGet array of the selected language package.
 * @param string    $text   Text to translate.
 * @return string Translated text.
 */
function txt($text) {
    global $fmg_translations;
    return isset($fmg_translations[$text]) ? htmlspecialchars($fmg_translations[$text]) : $text;
}


