<?php

class rex_flexshop
{
    public static $object;

    public function __construct()
    {
        rex_login::startSession();
    }

    /**
     * returns templated object
     *
     * @param int $id
     *
     * @return string
     */

    public static function get($id)
    {
        self::$object = rex_flexshop_object::query()
            ->where('id', $id)
            ->findOne();

        return self::buildObject();
    }

    /**
     * builds an object
     *
     * @param object $object
     *
     * @return string
     */

    private static function buildObject()
    {
        $pictures = explode(',', self::$object->pictures);

        $picture = '';
        if (is_object(rex_media::get($pictures[0]))) {
            $picture = $pictures[0];
        }

        $fragment = new rex_fragment();
        $fragment->setVar('picture', $picture);
        $fragment->setVar('label', self::$object->label);
        $fragment->setVar('description', self::$object->description);
        $fragment->setVar('price', self::$object->price);
        $fragment->setVar('id', self::$object->id);
        $fragment->setVar('button_text', sprogcard('flexshop_add_to_cart'));
        return $fragment->parse('/bootstrap/object.php');
    }

    public static function getCartLight()
    {
        return rex_flexshop_cart_light::getOutput();
    }

    public static function getCartOutput()
    {
        return rex_flexshop_cart::getOutput();
    }

    private static function addToCartUrl()
    {
        return 'index.php?rex-api-call=flexshop&id=' . self::$object->id;
    }

}
