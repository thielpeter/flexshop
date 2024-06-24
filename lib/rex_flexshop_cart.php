<?php

class rex_flexshop_cart
{
    public function getOutput()
    {
        $page = rex_request('page', 'string', '');
        $func = rex_request('func', 'string', '');
        $id = rex_request('id', 'string', 0);

        switch ($func) {
            case 'add':
                $this->addObject($id);
                break;
            case 'remove':
                $this->removeObject($id);
                break;
            case 'delete':
                $this->deleteObject($id);
                break;
        }

        switch ($page) {
            case 'checkout':
                return $this->returnCheckout();
            case 'summary':
                return $this->returnSummary();
            case 'payment':
                return $this->returnPayment();
            default:
                return $this->returnOverview();
        }
    }

    public function returnPayment()
    {
        return '
			<div class="flexshop-payment">
				<div class="container">
					<h2>Bezahlung</h2>
					' . rex_flexshop_payment::getOutput() . '
				</div>
			</div>
		';
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
        return rex_flexshop_checkout::getOutput();
    }

    public function returnOverview()
    {
        $objects = $this->getObjects();
        $objects = self::processObjects($objects);

        $fragment = new rex_fragment();
        $fragment->setVar('objects', $objects);
        $fragment->setVar('sum', self::getSum());
        $fragment->setVar('vatsum', self::getVatSum());
        $fragment->setVar('total', self::getTotal());
        $fragment->setVar('vat', self::getVat());
        $fragment->setVar('shipping', self::calculateShipping());
        $fragment->setVar('count_objects', $this->countObjects());
        return $fragment->parse('/bootstrap/cart.php');
    }

    public function returnOverviewEmail()
    {
        $objects = $this->getObjects();
        $objects = self::processObjects($objects);

        $fragment = new rex_fragment();
        $fragment->setVar('objects', $objects);
        $fragment->setVar('sum', self::getSum());
        $fragment->setVar('vatsum', self::getVatSum());
        $fragment->setVar('total', self::getTotal());
        $fragment->setVar('vat', self::getVat());
        $fragment->setVar('shipping', self::calculateShipping());
        $fragment->setVar('count_objects', $this->countObjects());
        return $fragment->parse('/email/cart.php');
    }

    public function getObjects()
    {
        if(!isset($_SESSION['cart'])) return;
        return $_SESSION['cart'];
    }

    public static function processObjects($cartObjects)
    {
        if(!$cartObjects) return;

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
                'subtitle' => $object->subtitle,
                'description' => $object->description,
				'price' => floatval($object->price),
				'info' => $object->info,
                'sum' => floatval($object->price) * $cartObject['quantity'],
                'id' => $object->id,
                'quantity' => $quantity
            ];
        }

		return $objects;
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

    public function addObject($id, $quantity = 1)
    {
        $object = rex_flexshop_object::query()
            ->where('id', $id)
            ->findOne();

        if (!$object || $quantity < 1) return false;

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        }
        else {
            $_SESSION['cart'][$id] = [
                'id'         => $id,
                'quantity'   => $quantity,
            ];
        }
		return true;
    }

    public function removeObject($id)
    {
        $_SESSION['cart'][$id]['quantity'] -= 1;
        if($_SESSION['cart'][$id]['quantity'] < 1){
            unset($_SESSION['cart'][$id]);
        }
    }

    public function deleteObject($id)
    {
        unset($_SESSION['cart'][$id]);
    }

    public static function resetCart()
    {
        unset($_SESSION['cart']);
    }

    private function countObjects()
    {
        return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    }

    private static function getShipping()
    {
        return rex_config::get('flexshop', 'shipping', 0);
    }

    public static function calculateShipping()
    {
        if( self::getSum() >= rex_config::get('flexshop', 'free_shipping', 0) || !self::hasShippingCosts() ){
            return 0;
        }

        return self::getShipping();
    }

    private static function hasShippingCosts()
    {
        if(!isset($_SESSION['cart'])) return;

        $cart = $_SESSION['cart'] ? $_SESSION['cart'] : [];

		$ids = array_column($cart, 'id');

		return rex_flexshop_object::query()
            ->whereRaw('FIND_IN_SET(id, "'.implode(',',$ids).'")')
            ->where('has_freeshipping', '0')
            ->findOne() ? true : false;
    }

    public static function getVat()
    {
        return rex_config::get('flexshop', 'vat', 0);
    }

    public static function getVatSum()
    {
        return (self::getSum() + self::getShipping() ) / 100 * self::getVat();
    }

    public static function getSum()
    {
        if(!isset($_SESSION['cart'])) return 0;

        $sum = 0;
        foreach($_SESSION['cart'] as $cartObject){
            $object = rex_flexshop_object::query()
                ->where('id', $cartObject['id'])
                ->findOne();
            $sum += floatval($object->price) * $cartObject['quantity'];
        }
        return $sum;
    }

    public static function getTotal()
    {
        return self::getSum() + self::calculateShipping() + self::getVatSum();
    }

    public static function getCountries()
    {
		return rex_flexshop_country::query();
	}

    public static function getCountriesList()
    {
		$countries = self::getCountries();

		$return = [
			'' => 'Bitte wählen'
		];
		foreach($countries as $country){
			$return[$country->code] = $country->name;
		}

		return $return;
	}

    public static function hasNonDigitalProducts()
    {
        $cartObjects = $_SESSION['cart'];

        foreach($cartObjects as $cartObject){
            $object = rex_flexshop_object::query()
                ->where('id', $cartObject['id'])
                ->findOne();
            if(!$object->is_digital){
                return true;
            }
        }

        return false;
    }

    public static function hasDigitalProducts()
    {
        $cartObjects = $_SESSION['cart'];

        foreach($cartObjects as $cartObject){
            $object = rex_flexshop_object::query()
                ->where('id', $cartObject['id'])
                ->findOne();
            if($object->is_digital){
                return true;
            }
        }

        return false;
    }

    public static function getDigitalProducts()
    {
        $cartObjects = $_SESSION['cart'];

        $filteredCart = [];
        foreach($cartObjects as $cartObject){
            $object = rex_flexshop_object::query()
                ->where('id', $cartObject['id'])
                ->findOne();
            if($object->is_digital){
                $filteredCart[] = $cartObject;
            }
        }
        return $filteredCart;
    }

    public static function getNonDigitalProducts()
    {
        $cartObjects = $_SESSION['cart'];

        $filteredCart = [];
        foreach($cartObjects as $cartObject){
            $object = rex_flexshop_object::query()
                ->where('id', $cartObject['id'])
                ->findOne();
            if(!$object->is_digital){
                $filteredCart[] = $cartObject;
            }
        }
        return $filteredCart;
    }
}
