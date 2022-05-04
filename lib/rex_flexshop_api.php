<?php

class rex_api_flexshop extends rex_api_function
{
    protected $published = true;

    function execute()
    {
        rex_login::startSession();

        // Parameter abrufen und auswerten
        $id = rex_request('id', 'string', '');
        if (!$id) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            $result = ['errorcode' => 1, 'message' => 'Parameter "id" is missing'];
            exit(json_encode($result));
        }

        $object = rex_flexshop_object::query()
            ->where('id', $id)
            ->findOne();

        if (!$object) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            $result = ['errorcode' => 1, 'message' => 'Object not found'];
            exit(json_encode($result));
        }

        // rex_unset_session('flexshop_cart');
        $cart = rex_session('flexshop_cart', 'array', []);
        $cart[] = $object->id;

        rex_set_session('flexshop_cart', $cart);

        $content = count($cart);

        // Inhalt ausgeben
        header('Content-Type: text/html; charset=UTF-8');
        echo $content;
        exit;
    }
}