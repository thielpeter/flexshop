<?php

class rex_flexshop_paypal
{
    public static function createOrder($uuid): void
    {
        $accessToken = static::generateAccessToken();
        if (!$accessToken) return;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/checkout/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        $total = rex_flexshop_cart::getTotal();
        $currencyCode = rex_flexshop_helper::getCurrencyCode();
        $CAPTURE_URL = rtrim(rex::getServer(), "/").rex_flexshop_cart::getUrl().'?page=paypal_capture&uuid='.$uuid;
        $CANCEL_URL = rtrim(rex::getServer(), "/").rex_flexshop_cart::getUrl().'?page=paypal_cancel&uuid='.$uuid;

        $orderData = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => $currencyCode,
                    'value' => $total
                ],
                'description' => 'Payment description',
                'custom_id' => $uuid
            ]],
            'application_context' => [
                'return_url' => $CAPTURE_URL,
                'cancel_url' => $CANCEL_URL
            ]
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));

        $headers = [];
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: Bearer " . $accessToken;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $order = json_decode($response);

        foreach ($order->links as $link) {
            if ($link->rel == 'approve') {
                header('Location: ' . $link->href);
                exit;
            }
        }
    }

    public static function capturePayment()
    {
        $accessToken = self::generateAccessToken();
        if (!$accessToken) return;

        $orderId = $_GET['token']; // PayPal gibt die Auftrags-ID in einem GET-Parameter namens 'token' zurück

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/checkout/orders/$orderId/capture");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = [];
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: Bearer " . $accessToken;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $capture = json_decode($response);

        if ($capture && isset($capture->status) && $capture->status == 'COMPLETED' && isset($capture->purchase_units[0]->payments->captures[0]->custom_id) && $capture->purchase_units[0]->payments->captures[0]->custom_id) {
            return true;
        } else {
            return false;
        }
    }

    private static function generateAccessToken()
    {
        $CLIENT_ID = rex_addon::get('flexshop')->getConfig('paypal_client_id');
        $CLIENT_SECRET = rex_addon::get('flexshop')->getConfig('paypal_client_secret');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials&ignoreCache=true&return_authn_schemes=true&return_client_metadata=true&return_unconsented_scopes=true',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic ' . base64_encode($CLIENT_ID . ':' . $CLIENT_SECRET)
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $responseObject = json_decode($response);
        return $responseObject->access_token ?? null;
    }
}
