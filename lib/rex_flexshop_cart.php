<?php

class rex_flexshop_cart
{
    private Cart $cart;

    public function __construct()
    {
        $this->cart = new Cart([
            // Can add unlimited number of item to cart
            'cartMaxItem' => 0,

            // Set maximum quantity allowed per item to 99
            'itemMaxQuantity' => 99,

            // Do not use cookie, cart data will lost when browser is closed
            'useCookie' => true,
        ]);
    }

    public function getOutput()
    {
        $page = rex_request('page', 'string', '');
        $func = rex_request('func', 'string', '');
        $id = rex_request('id', 'string', 0);

        switch ($func) {
            case 'add':
                $this->addObject($id);
            case 'remove':
                $this->removeObject($id);
        }

        switch ($page) {
            case 'checkout':
                return $this->returnCheckout();
            case 'summary':
                return $this->returnSummary();
            default:
                return $this->returnOverview();
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

    public function returnSummary()
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

    public function returnCheckout()
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

    public function returnOverview()
    {
        $cartObjects = $this->getObjects();

        $objects = [];
        foreach ($cartObjects as $cartObject) {

            $object = rex_flexshop_object::query()
                ->where('id', $cartObject['id'])
                ->findOne();

            $quantity = $cartObject['quantity'];

            $pictures = explode(',', $object->pictures);

            $picture = '';
            if (is_object(rex_media::get($pictures[0]))) {
                $picture = $pictures[0];
            }

            $objects[] = [
                'picture' => $picture,
                'label' => $object->label,
                'description' => $object->description,
                'price' => $object->price,
                'id' => $object->id,
                'count' => $quantity
            ];
        }

        $fragment = new rex_fragment();
        $fragment->setVar('objects', $objects);
        $fragment->setVar('sum', $this->getSum());
        $fragment->setVar('cart_text', sprogcard('flexshop_cart'));
        $fragment->setVar('sum_text', sprogcard('flexshop_sum'));
        $fragment->setVar('button_text', sprogcard('flexshop_finish_order'));
        $fragment->setVar('count_objects', $this->countObjects());
        return $fragment->parse('/bootstrap/cart.php');
    }

    public function getObjects()
    {
        return $_SESSION['cart'];
//        return $this->cart->getItems();
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
        return rex_getUrl(self::getArticleId());
    }

    public static function getArticleId()
    {
        return rex_config::get('flexshop', 'cart_article', 1);
    }

    public function addObject($id)
    {
        $object = rex_flexshop_object::query()
            ->where('id', $id)
            ->findOne();

        if (!$object) return false;

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += 1;
        }

        $_SESSION['cart'][$id] = [
            'id'         => $id,
            'quantity'   => 1,
        ];

//        $this->cart->add($object->id, 1, [
//            'price' => $object->price,
//        ]);
    }

    public function removeObject($id)
    {
        $this->cart->remove($id);
    }

    private function countObjects()
    {
        return count($_SESSION['cart']);
    }

    private function getSum()
    {
        $sum = 0;
        foreach($_SESSION['cart'] as $cartObject){
            $object = rex_flexshop_object::query()
                ->where('id', $cartObject['id'])
                ->findOne();
            $sum += $object->price;
        }
        return $sum;
    }
}
