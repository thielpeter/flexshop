<?php

class rex_flexshop_checkout
{
    public static function getOutput()
    {
        $fragment = new rex_fragment();
        $fragment->setVar('sum', rex_flexshop_cart::getSum());
        $fragment->setVar('total', rex_flexshop_cart::getTotal());
        $fragment->setVar('vat', rex_flexshop_cart::getVat());
        $fragment->setVar('vatsum', rex_flexshop_cart::getVatSum());
        $fragment->setVar('shipping', rex_flexshop_cart::calculateShipping());
        return $fragment->parse('/bootstrap/checkout.php');
    }

    public static function saveToSession($yform)
    {
        $_SESSION['checkout'] = array_intersect_key($_REQUEST, array_flip([
            'email', 'tel', 'salutation', 'firstname', 'surname', 'street', 'zip', 'city', 'country', 'invoice_address', 'invoice_company', 'invoice_salutation', 'invoice_firstname', 'invoice_surname', 'invoice_street', 'invoice_zip', 'invoice_city', 'invoice_country'
        ]));
        return true;
    }

    public static function getData()
    {
        return $_SESSION['checkout'];
    }
}
