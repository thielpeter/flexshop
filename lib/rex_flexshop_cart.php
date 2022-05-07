<?php

class rex_flexshop_cart
{
    public function __construct()
    {
        rex_login::startSession();
    }

    public static function getOutput()
    {

        $page = rex_request('page', 'string', 'overview');

        switch ($page) {
            case 'overview':
                return self::returnOverview();
            case 'checkout':
                return self::returnCheckout();
            case 'summary':
                return self::returnSummary();
            default:
                return self::returnOverview();
        }

    }

    public static function returnSummary()
    {
        return '
			<div class="flexshop-summary">
				<div class="container">
					<h2>Übersicht</h2>
					' . rex_flexshop_summary::getOutput() . '
				</div>
			</div>
		';
    }

    public static function returnCheckout()
    {
        return '
			<div class="flexshop-checkout">
				<div class="container">
					<h2>Checkout</h2>
					<div class="flexshop-form">
						' . rex_flexshop_checkout::getOutput() . '
					</div>
				</div>
			</div>
		';
    }

    public static function returnOverview()
    {
        $objects = self::getObjects();

        $cartObjects = '';
        $cartSum = 0;

        foreach ($objects as $id) {

            $object = rex_flexshop_object::query()
                ->where('id', $id)
                ->findOne();

            $pictures = explode(',', $object->pictures);

            $picture = '';
            if (is_object(rex_media::get($pictures[0]))) {
                $picture = $pictures[0];
            }

            $fragment = new rex_fragment();
            $fragment->setVar('picture', $picture);
            $fragment->setVar('label', $object->label);
            $fragment->setVar('price', $object->price);
            $fragment->setVar('id', $object->id);
            $fragment->setVar('button_text', sprogcard('flexshop_remove_from_cart'));
            $cartObjects .= $fragment->parse('cart_object.default.php');

            $cartSum += $object->price;
        }

        return '
			<div class="flexshop-cart">
				<div class="container">
					<h2>Warenkorb</h2>
					<div class="flexshop-cart-objects">' . $cartObjects . '</div>
					<div class="flexshop-cart-sum text-right">Summe: ' . $cartSum . ' €</div>
					<div class="flexshop-cart-footer text-right"><a class="btn btn-theme" href="' . self::getCheckoutUrl() . '"><span>Bestellung abschließen</span></a></div>
				</div>
			</div>
		';
    }

    public static function getObjects()
    {
        return rex_session('flexshop_cart', 'array', []);
    }

    private static function getCheckoutUrl()
    {
        return rex_getUrl(rex_config::get('flexshop', 'cart_article', 1), rex_clang::getCurrentId(), ['page' => 'checkout']);
    }

    public static function getDeleteUrl($id)
    {
        return rex_getUrl(rex_config::get('flexshop', 'cart_article', 1), rex_clang::getCurrentId(), ['page' => 'overview', 'func' => 'delete', 'id' => $id]);
    }

    public static function getUrl()
    {
        return rex_getUrl(rex_config::get('flexshop', 'cart_article', 1));
    }

    public static function getCountObjects()
    {
        return count(rex_session('flexshop_cart', 'array', []));
    }
}
