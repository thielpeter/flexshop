<?php

class rex_flexshop_payment
{
    public static function getOutput()
    {
        $objects = rex_flexshop_cart::processObjects($_SESSION['cart']);

        $fragment = new rex_fragment();
        $fragment->setVar('objects', $objects);
        $fragment->setVar('sum', rex_flexshop_cart::getSum());
        $fragment->setVar('vat', rex_flexshop_cart::getVat());
        $fragment->setVar('vatsum', rex_flexshop_cart::getVatSum());
        $fragment->setVar('total', rex_flexshop_cart::getTotal());
        $fragment->setVar('shipping', rex_flexshop_cart::calculateShipping());
        return $fragment->parse('/bootstrap/payment.php');
    }
    public static function saveToSession($yform)
    {
        $_SESSION['payment'] = array_intersect_key($_REQUEST, array_flip([
            'payment_method'
        ]));
        return true;
    }

    public static function getData()
    {
        return $_SESSION['payment'];
    }
}
