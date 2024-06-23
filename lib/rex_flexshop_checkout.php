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
        $_SESSION['checkout'] = $_REQUEST;
        return true;
    }

    public static function getData()
    {
        return $_SESSION['checkout'];
    }
}
