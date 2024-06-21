<?php

class rex_flexshop_email
{
    public static function getCartSummary()
    {
		$cart = new rex_flexshop_cart();
        return $cart->returnOverviewEmail();
    }
}
