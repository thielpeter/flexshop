<?php

class rex_flexshop_helper
{
    public static function format_currency($currency)
    {
        return self::getCurrency() . ' ' . str_replace(',00', '.-', number_format(floatval($currency), 2, ',', ' '));
    }

    public static function getFreeShipping()
    {
        return self::getCurrency() . ' ' . rex_addon::get('flexshop')->getConfig('free_shipping') . ' .-';
    }

    public static function getCurrency()
    {
        return rex_addon::get('flexshop')->getConfig('currency');
    }
}
