<?php

class rex_flexshop_paypal
{
    protected $CLIENT_ID = "AWi4WL3ozuFEhtdAj2LcUw53udhlOZXeRleZDGXaD5wxM6AtJYbmXYc20z2eE8_29TtxrH7wknVedV_I";
    protected $CLIENT_SECRET = "ECqtyUrzvuXmTb_gMn1-ZwVXN_vXwnNgTKVT6Z9RpZP_y9ZBSvVb3T3gspLuc21bOZmFThldeCY_iqXQ";

    public function capturePayment($orderId){

        $accessToken = $this->generateAccessToken();
        if(!$accessToken) return;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/checkout/orders/'.$orderId.'/capture',
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
                'PayPal-Request-Id: '.uniqid(),
                'Authorization: Bearer '.$accessToken
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    public function createOrder()
    {
        $accessToken = $this->generateAccessToken();
        if(!$accessToken) return;

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
            "items": [
                {
                    "name": "T-Shirt",
                    "description": "Green XL",
                    "quantity": "1",
                    "unit_amount": {
                        "currency_code": "EUR",
                        "value": "100.00"
                    }
                }
            ],
            "amount": {
                "currency_code": "EUR",
                "value": "100.00",
                "breakdown": {
                    "item_total": {
                        "currency_code": "EUR",
                        "value": "100.00"
                    }
                }
            }
        }
    ],
    "application_context": {
        "return_url": "http://shop.local/return",
        "cancel_url": "http://shop.local/cancel"
    }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Prefer: return=representation',
                'PayPal-Request-Id: '.uniqid(),
                'Authorization: Bearer '.$accessToken
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
}
