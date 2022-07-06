<?php

class rex_api_flexshop extends rex_api_function
{
    protected $published = true;

    function execute()
    {
//        rex_login::startSession();

        // Parameter abrufen und auswerten
        $func = rex_request('func', 'string', '');
        $id = rex_request('id', 'string', '');
        if (!$id) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            $result = ['errorcode' => 1, 'message' => 'Parameter "id" is missing'];
            exit(json_encode($result));
        }

        $content = '';
        switch ($func) {
            case 'add':
                $content = rex_flexshop_cart::addObject($id);
                break;
            case 'remove':
                $content = rex_flexshop_cart::removeObject($id);
                break;
        }

        if (!$content) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            $result = ['errorcode' => 1, 'message' => 'Object not found'];
            exit(json_encode($result));
        }

        // Inhalt ausgeben
        header('Content-Type: text/html; charset=UTF-8');
        echo $content;
        exit;
    }
}