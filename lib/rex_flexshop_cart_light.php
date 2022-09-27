<?php

class rex_flexshop_cart_light
{
    /**
     * @return string
     */
    public static function getOutput(): string
    {
        return '
			<div class="mad-col mad-dropdown-cart">
				<a class="mad-dropdown-title" href="' . self::getCartUrl() . '">
					<i class="far fa-shopping-bag"><span class="flexshop-cart-count">' . self::getCountObjects() . '</span></i>
				</a>
			</div>
		';
    }

    /**
     * @return int
     * @throws rex_exception
     */
    public static function getCountObjects()
    {
        $cart = $_SESSION['cart'];
		
		$count = 0;
		foreach($cart as $cartObject){
			$count += $cartObject['quantity'];
		}
        return $count;
    }

    /**
     * @return string
     */
    private static function getCartUrl()
    {
        return rex_getUrl(rex_config::get('flexshop', 'cart_article', 1));
    }
}
