<?php

class rex_flexshop_helper
{
    public static function format_currency($currency)
    {
        return '€ ' . str_replace(',00', '.-', number_format($currency, 2, ',', ' '));
    }
}