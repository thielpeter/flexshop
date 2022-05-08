<?php

class rex_flexshop_cart_light
{
    /**
     * @throws rex_exception
     */
    public function __construct()
    {
        rex_login::startSession();
    }

    /**
     * @return string
     */
    public static function getOutput()
    {
        return '
			<div class="flexshop-cart-short">
				<div class="flexshop-cart-count">' . self::getCountObjects() . '</div>
			</div>
		';
    }

    /**
     * @return int
     * @throws rex_exception
     */
    public static function getCountObjects()
    {
        rex_login::startSession();
        return count(rex_session('flexshop_cart', 'array', []));
    }
}
