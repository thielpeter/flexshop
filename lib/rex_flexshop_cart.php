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
        $func = rex_request('func', 'string', '');
        $id = rex_request('id', 'int', 0);

        switch ($func) {
            case 'delete':
                return self::deleteCartObject($id);
        }

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

    public static function increaseCartObject($id)
    {
        rex_session('flexshop_cart', 'array', []);
        return true;
    }

    public static function decreaseCartObject($id)
    {
        rex_session('flexshop_cart', 'array', []);
        return true;
    }

    public static function deleteCartObject($id)
    {
        rex_session('flexshop_cart', 'array', []);
        return true;
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

        $cartObjects = [];
        $cartSum = 0;

        foreach ($objects as $object) {

            $data = $object['data'];
            $count = $object['count'];

            $pictures = explode(',', $data->pictures);

            $picture = '';
            if (is_object(rex_media::get($pictures[0]))) {
                $picture = $pictures[0];
            }

            $cartObjects[] = [
                'picture' => $picture,
                'label' => $data->label,
                'price' => $data->price,
                'id' => $data->id,
                'count' => $count,
                'button_text' => sprogcard('flexshop_remove_from_cart'),
            ];

            $cartSum += $data->price;
        }

        $fragment = new rex_fragment();
        $fragment->setVar('objects', $cartObjects);
        $fragment->setVar('sum', $cartSum);
        $fragment->setVar('cart_text', sprogcard('flexshop_cart'));
        $fragment->setVar('sum_text', sprogcard('flexshop_sum'));
        $fragment->setVar('button_text', sprogcard('flexshop_finish_order'));
        return $fragment->parse('cart.default.php');
    }

    public static function getObjects()
    {
        $objects = rex_session('flexshop_cart', 'array', []);
        $uniqueObjects = array_unique($objects);
        $countedObjects = array_count_values($objects);

        $return = [];
        foreach ($uniqueObjects as $id) {

            $object = rex_flexshop_object::query()
                ->where('id', $id)
                ->findOne();

            $return[] = [
                'data' => $object,
                'count' => $countedObjects[$id],
            ];
        }
        return $return;
    }

    public static function getCheckoutUrl()
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

    public static function addObject($id)
    {
        $object = rex_flexshop_object::query()
            ->where('id', $id)
            ->findOne();

        if (!$object) return false;

//        rex_unset_session('flexshop_cart');
        $cart = rex_session('flexshop_cart', 'array', []);
        $cart[$id] = isset($cart[$id]) ? $cart[$id] + 1 : 1;

        rex_set_session('flexshop_cart', $cart);

        return self::countObjects($cart);
    }

    private static function countObjects($cartObjects)
    {
        $count = 0;
        foreach($cartObjects as $objectCount){
            $count += $objectCount;
        }

        return $count;
    }

    public static function removeObject($id)
    {
        $object = rex_flexshop_object::query()
            ->where('id', $id)
            ->findOne();

        if (!$object) return false;

        // rex_unset_session('flexshop_cart');
        $cart = rex_session('flexshop_cart', 'array', []);
        $cart[$id] = $cart[$id];

        rex_set_session('flexshop_cart', $cart);

        return count($cart);
    }
}
