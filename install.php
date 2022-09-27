<?php

/**
 * FlexShop.
 *
 * @author jpeter.thiel@gmail.com
 * @package redaxo\flex_shop
 *
 * @var rex_addon $this
 */

$content = rex_file::get(rex_path::addon('flexshop', 'install/tablesets/rex_flexshop_object.json'));
if ($content) {
    rex_yform_manager_table_api::importTablesets($content);
}

$content = rex_file::get(rex_path::addon('flexshop', 'install/tablesets/rex_flexshop_category.json'));
if ($content) {
    rex_yform_manager_table_api::importTablesets($content);
}

$content = rex_file::get(rex_path::addon('flexshop', 'install/tablesets/rex_flexshop_order.json'));
if ($content) {
    rex_yform_manager_table_api::importTablesets($content);
}

$content = rex_file::get(rex_path::addon('flexshop', 'install/tablesets/rex_flexshop_country.json'));
if ($content) {
    rex_yform_manager_table_api::importTablesets($content);
}

rex_yform_manager_table::deleteCache();

if (!class_exists('rex_flexshop_settings')) {
    require_once 'lib/rex_flexshop_settings.php';
}
rex_flexshop_settings::install();