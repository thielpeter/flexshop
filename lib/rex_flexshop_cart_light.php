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
    public static function getOutput(): string
    {
        return '
			<div class="flexshop-cart-short">
				<div class="flexshop-cart-count">' . self::getCountObjects() . '</div>
				<a class="btn btn-theme" href="' . self::getCartUrl() . '"><span>Warenkorb ansehen</span></a>
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

    /**
     * @return string
     */
    private static function getCartUrl()
    {
        return rex_getUrl(rex_config::get('flexshop', 'cart_article', 1));
    }
}
