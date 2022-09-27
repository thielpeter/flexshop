<?php

class rex_flexshop_modals
{
    public static function getModal($modal)
    {
        $fragment = new rex_fragment();
        return $fragment->parse('/bootstrap/modal_'.$modal.'.php');
    }
}
