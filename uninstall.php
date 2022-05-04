<?php

/**
 * FlexShop.
 *
 * @author jpeter.thiel@gmail.com
 * @package redaxo\flex_shop
 *
 * @var rex_addon $this
 */

$sql = rex_sql::factory();
$sql->setQuery('DELETE FROM `'.rex::getTable('yform_table').'` WHERE table_name = "'.rex::getTable('flexshop_object').'"');
$sql->setQuery('DELETE FROM `'.rex::getTable('yform_table').'` WHERE table_name = "'.rex::getTable('flexshop_category').'"');
$sql->setQuery('DELETE FROM `'.rex::getTable('yform_field').'` WHERE table_name = "'.rex::getTable('flexshop_object').'"');
$sql->setQuery('DELETE FROM `'.rex::getTable('yform_field').'` WHERE table_name = "'.rex::getTable('flexshop_category').'"');
$sql->setQuery('DELETE FROM `'.rex::getTable('yform_history').'` WHERE table_name = "'.rex::getTable('flexshop_object').'"');
$sql->setQuery('DELETE FROM `'.rex::getTable('yform_history').'` WHERE table_name = "'.rex::getTable('flexshop_category').'"');

rex_sql_table::get(rex::getTable('flexshop_object'))
    ->drop();
rex_sql_table::get(rex::getTable('flexshop_category'))
    ->drop();

rex_yform_manager_table::deleteCache();