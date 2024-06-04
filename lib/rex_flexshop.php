<?php

class rex_flexshop
{
    public static rex_flexshop_object $object;
    public static $objects;
    private rex_flexshop_cart $rex_flexshop_cart;

    public function __construct()
    {
		rex_login::startSession();

        $this->rex_flexshop_cart = new rex_flexshop_cart();
    }

    /**
     * returns templated object
     *
     * @param string $id
     *
     * @return string
     */

    public static function getAndBuildObject(string $id): string
    {
        self::$object = rex_flexshop_object::query()
            ->where('id', $id)
            ->findOne();

        return self::buildObject();
    }

    /**
     * returns templated object
     *
     * @param string $id
     *
     * @return rex_flexshop_object
     */
    public static function getObject(string $id): rex_flexshop_object
    {
        return self::$object = rex_flexshop_object::query()
            ->where('id', $id)
            ->findOne();
    }

    /**
     * @param string $id
     * @return string
     */
    public static function getCategory(string $id): string
    {
        self::$objects = rex_flexshop_object::query()
            ->whereRaw('find_in_set('.$id.', categories)')
            ->find();

        return self::buildObjects();
    }

    /**
     * builds an object
     *
     * @return string
     */

    private static function buildObject(): string
    {
        $pictures = explode(',', self::$object->pictures);

        $picture = '';
        if (is_object(rex_media::get($pictures[0]))) {
            $picture = $pictures[0];
        }

        $fragment = new rex_fragment();
        $fragment->setVar('picture', $picture);
		$fragment->setVar('subtitle', self::$object->subtitle);
        $fragment->setVar('label', self::$object->label);
        $fragment->setVar('description', self::$object->description);
        $fragment->setVar('price', self::$object->price);
		$fragment->setVar('info', self::$object->info);
        $fragment->setVar('id', self::$object->id);
        $fragment->setVar('button_text', sprogcard('flexshop_add_to_cart'));

        $variants = [];
        if (self::$object->variants) {
            foreach(explode(',', self::$object->variants) as $variantId){
                $variants[] = self::getObject($variantId);
            }
        }
        $fragment->setVar('variants', $variants);

        return $fragment->parse('/bootstrap/object.php');
    }

    /**
     * builds an object
     *
     * @param object $object
     *
     * @return string
     */

    private static function buildObjects()
    {
        $return = '';
        foreach(self::$objects as $object){
            self::$object = $object;
            $return .= self::buildObject();
        }
        return $return;
    }

    public static function getCartLight()
    {
        return rex_flexshop_cart_light::getOutput();
    }

    public function getCartOutput()
    {
        return $this->rex_flexshop_cart->getOutput();
    }

    private static function addToCartUrl()
    {
        return 'index.php?rex-api-call=flexshop&id=' . self::$object->id;
    }

}
