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
        foreach ($objects as $id) {

            $object = rex_flexshop_object::query()
                ->where('id', $id)
                ->findOne();

            $pictures = explode(',', $object->pictures);

            $picture = '';
            if (is_object(rex_media::get($pictures[0]))) {
                $sImageType = 'rex_media_medium';
                $sImageFile = $pictures[0];

                $picture = '<div class="flexshop-cart-picture col-xs-12 col-sm-2"><img src="index.php?rex_media_type=' . $sImageType . '&rex_media_file=' . $sImageFile . '"/></div>';
            }

            $label = '';
            if ($object->label != '') {
                $label = '<div class="flexshop-cart-label"><h3>' . $object->label . '</h3></div>';
            }

            $price = '';
            if ($object->price != '') {
                $price = '<div class="flexshop-cart-price">' . $object->price . ' €</div>';
            }

            $cartObjects .= '<div class="flexshop-cart-object">
				<div class="row">
					' . $picture . '
					<div class="flexshop-object-data col-xs-12 col-sm-6">
						' . $label . '
						' . $price . '
					</div>
					<div class="flexshop-object-delete col-xs-12 col-sm-4 text-right"><a class="btn btn-alert" href="' . self::getDeleteUrl($object->id) . '"><span>Aus Warenkorb entfernen</span></a></div>
				</div>
			</div>';

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

    private static function getDeleteUrl($id)
    {
        return rex_getUrl(rex_config::get('flexshop', 'cart_article', 1), rex_clang::getCurrentId(), ['page' => 'overview', 'func' => 'delete', 'id' => $id]);
    }

    public static function getCountObjects()
    {
        return count(rex_session('flexshop_cart', 'array', []));
    }
}
