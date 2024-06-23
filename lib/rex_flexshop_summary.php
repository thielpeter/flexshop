<?php

class rex_flexshop_summary
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
        return $fragment->parse('/bootstrap/summary.php');
    }

    public static function getOverview()
    {
        $fragment = new rex_fragment();
        $fragment->setVar('sum', rex_flexshop_cart::getSum());
        // $fragment->setVar('vatsum', self::getVatSum());
        $fragment->setVar('total', rex_flexshop_cart::getTotal());
        // $fragment->setVar('vat', self::getVat());
        $fragment->setVar('shipping', rex_flexshop_cart::calculateShipping());
        // $fragment->setVar('count_objects', $this->countObjects());
        return $fragment->parse('/bootstrap/summary.php');

    }
}
