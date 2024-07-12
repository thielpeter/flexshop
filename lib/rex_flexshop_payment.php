<?php

class rex_flexshop_payment
{
    const PAYMENT_STATE_PAYED = "payed";
    const PAYMENT_STATE_UNPAYED = "unpayed";

    /**
     * @return string
     */
    public static function getOutput()
    {
        $objects = rex_flexshop_cart::processObjects($_SESSION['cart']);

        $fragment = new rex_fragment();
        $fragment->setVar('objects', $objects);
        $fragment->setVar('sum', rex_flexshop_cart::getSum());
        $fragment->setVar('vat', rex_flexshop_cart::getVat());
        $fragment->setVar('vatsum', rex_flexshop_cart::getVatSum());
        $fragment->setVar('total', rex_flexshop_cart::getTotal());
        $fragment->setVar('shipping', rex_flexshop_cart::calculateShipping());
        return $fragment->parse('/bootstrap/payment.php');
    }

    /**
     * @param $yform
     * @return true
     */
    public static function saveToSession($yform)
    {
        $_SESSION['payment'] = array_intersect_key($_REQUEST, array_flip([
            'payment_method'
        ]));
        return true;
    }

    /**
     * @return mixed|null
     */
    public static function getData()
    {
        return isset($_SESSION['payment']) ? $_SESSION['payment'] : null;
    }

    public static function getPaymentMethods(): array
    {
        return [
            [
                "id" => "bill",
                "label" => "Rechnung",
                "text" => "Du hast bis zu 14 Tage Zeit zu bezahlen, nachdem wir deine Bestellung verschickt haben. Du erhältst von uns eine Email die alle Informationen zur Zahlung beinhaltet.",
                "enabled" => true,
                "max_value" => rex_flexshop_helper::getBillMaxValue()
            ],
            [
                "id" => "paypal",
                "label" => "Paypal",
                "text" => "Du wirst nach der Bestellung an PayPal weitergeleitet, um den Bezahlvorgang abzuschließen.",
                "enabled" => true,
                "max_value" => 0
            ]
        ];
    }

    /**
     * @return mixed|string
     */
    public static function getPaymentMethod()
    {
        $data = self::getData();
        if (isset($data['payment_method'])) {
            return $data['payment_method'];
        }
        return "bill";
    }

    /**
     * @return string
     */
    public static function getPaymentLabel(): string
    {
        $paymentMethod = self::getPaymentMethod();
        switch ($paymentMethod) {
            case "bill":
                return "Rechnung";
            case "paypal":
                return "Paypal";
        }
        return "";
    }

    /**
     * @param $uuid
     * @return void
     */
    public static function payByPaypal($uuid): void
    {
        rex_flexshop_paypal::createOrder($uuid);
    }

    public static function setPaymentStatusPayed($uuid)
    {
        $order = rex_flexshop_order::query()->where('uuid', $uuid)->findOne();
        if ($order) {
            $order->payment_state = rex_flexshop_payment::PAYMENT_STATE_PAYED;
            if ($order->save()) {
                return true;
            }
        }
        return false;
    }

    public static function getPaymentStates(): array
    {
        return [
            rex_flexshop_payment::PAYMENT_STATE_UNPAYED => 'Unbezahlt',
            rex_flexshop_payment::PAYMENT_STATE_PAYED => 'Bezahlt',
        ];
    }

    public static function getPaymentMethodsSelection(): string
    {
        $out = '';
        $paymentMethods = self::getPaymentMethods();
        $total = rex_flexshop_cart::getTotal();
        foreach($paymentMethods as $paymentMethod){
            if($paymentMethod['enabled']){
                $disabled = false;
                if($paymentMethod['max_value'] > 0 && $paymentMethod['max_value'] < $total){
                    $disabled = true;
                }
                $out .= '<div class="payment-method'.($disabled ? ' is-disabled' : '').'"><input type="radio"'.($disabled ? ' disabled="disabled"' : '').' name="payment_method" value="'.$paymentMethod['id'].'"><strong>'.$paymentMethod['label'].'</strong><p>'.$paymentMethod['text'].'</p></input></div>';
            }
        }
        return $out;
    }
}
