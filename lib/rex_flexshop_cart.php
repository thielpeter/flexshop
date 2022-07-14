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
            default:
                return $this->returnOverview();
        }
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
                'sum' => $object->price * $cartObject['quantity'],
                'id' => $object->id,
                'quantity' => $quantity
            ];
        }

        $fragment = new rex_fragment();
        $fragment->setVar('objects', $objects);
        $fragment->setVar('sum', self::getSum());
        $fragment->setVar('vatsum', self::getVatSum());
        $fragment->setVar('total', self::getTotal());
        $fragment->setVar('vat', self::getVat());
        $fragment->setVar('shipping', self::getShipping());
        $fragment->setVar('count_objects', $this->countObjects());
        return $fragment->parse('/bootstrap/cart.php');
    }

    public function getObjects()
    {
        return $_SESSION['cart'];
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
        else {
            $_SESSION['cart'][$id] = [
                'id'         => $id,
                'quantity'   => 1,
            ];
        }
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

    private function countObjects()
    {
        return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    }

    public static function getShipping()
    {
        return rex_config::get('flexshop', 'shipping', 0);
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
        $sum = 0;
        foreach($_SESSION['cart'] as $cartObject){
            $object = rex_flexshop_object::query()
                ->where('id', $cartObject['id'])
                ->findOne();
            $sum += $object->price * $cartObject['quantity'];
        }
        return $sum;
    }

    public static function getTotal()
    {
        return self::getSum() + self::getVatSum();
    }
}
