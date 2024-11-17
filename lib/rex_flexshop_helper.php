<?php

class rex_flexshop_helper
{
    public static function format_currency($currency)
    {
        return self::getCurrency() . ' ' . str_replace(',00', '.-', number_format(floatval($currency), 2, ',', ' '));
    }

    public static function getFreeShipping()
    {
        return self::getCurrency() . ' ' . number_format(floatval(rex_addon::get('flexshop')->getConfig('free_shipping')), 2, ',', ' ');
    }

    public static function getCurrency()
    {
        return rex_addon::get('flexshop')->getConfig('currency');
    }

    public static function getCurrencyCode()
    {
        return rex_addon::get('flexshop')->getConfig('currency_code');
    }

    public static function getPaymentsEnabled()
    {
        return rex_addon::get('flexshop')->getConfig('payments_enabled');
    }

    public static function getBillMaxValue()
    {
        return rex_addon::get('flexshop')->getConfig('bill_maxvalue');
    }

    public static function getMailFrom()
    {
        return rex_addon::get('flexshop')->getConfig('mail_from');
    }

    public static function getMailAdmin()
    {
        return rex_addon::get('flexshop')->getConfig('mail_admin');
    }
}
