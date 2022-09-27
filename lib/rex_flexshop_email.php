<?php

class rex_flexshop_email
{
    public static function getData()
    {
        return [
			'email' => rex_request('email'),
			'tel' => rex_request('tel'),
			'salutation' => rex_request('salutation'),
			'firstname' => rex_request('firstname'),
			'surname' => rex_request('surname'),
			'street' => rex_request('street'),
			'zip' => rex_request('zip'),
			'city' => rex_request('city'),
			'country' => rex_request('country'),
		];
    }
	
    public static function getCartSummary()
    {
		$cart = new rex_flexshop_cart();
        return $cart->returnOverviewEmail();
    }
}
