<?php

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class rex_flexshop_paypal
{
    protected $CLIENT_ID;
    protected $CLIENT_SECRET;

    public function __construct()
    {
        $this->CLIENT_ID = rex_addon::get('flexshop')->getConfig('paypal_client_id');
        $this->CLIENT_SECRET = rex_addon::get('flexshop')->getConfig('paypal_client_secret');
    }

    public function capturePayment($orderId)
    {
        $accessToken = $this->generateAccessToken();
        if (!$accessToken) return;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/checkout/orders/' . $orderId . '/capture',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Prefer: return=representation',
                'PayPal-Request-Id: ' . uniqid(),
                'Authorization: Bearer ' . $accessToken
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function createOrder()
    {
        $accessToken = $this->generateAccessToken();
        if (!$accessToken) return;

        $cartSum = rex_flexshop_cart::getSum();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/checkout/orders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "intent": "CAPTURE",
    "purchase_units": [
        {
            "amount": {
                "currency_code": "EUR",
                "value": ' . $cartSum . '
            }
        }
    ]
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Prefer: return=representation',
                'PayPal-Request-Id: ' . uniqid(),
                'Authorization: Bearer ' . $accessToken
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    private function generateAccessToken()
    {
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
                'Authorization: Basic ' . base64_encode($this->CLIENT_ID . ':' . $this->CLIENT_SECRET)
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $responseObject = json_decode($response);
        return $responseObject->access_token ?? null;
    }

    public function sendToPaypal()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->CLIENT_ID,     // ClientID
                $this->CLIENT_SECRET  // ClientSecret
            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(10.00);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription("Payment description");

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("https://your-website.com/execute-payment.php")
            ->setCancelUrl("https://your-website.com/cancel.php");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($apiContext);
            header("Location: " . $payment->getApprovalLink());
            exit;
        } catch (Exception $ex) {
            // Handle error
            exit(1);
        }
    }
}
