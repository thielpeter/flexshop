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
            $sImageType = 'rex_media_medium';
            $sImageFile = $pictures[0];

            $picture = '<div class="flexshop-object-picture col-xs-12 col-sm-5"><img src="index.php?rex_media_type=' . $sImageType . '&rex_media_file=' . $sImageFile . '"/></div>';
        }

        $label = '';
        if (self::$object->label != '') {
            $label = '<div class="flexshop-object-label col-12"><h3>' . self::$object->label . '</h3></div>';
        }

        $description = '';
        if (self::$object->description != '') {
            $description = '<div class="flexshop-object-description col-12 typo-default">' . self::$object->description . '</div>';
        }

        $price = '';
        if (self::$object->price != '') {
            $price = '<div class="flexshop-cart-price col-12">' . self::$object->price . '</div>';
        }

        $link = '<div class="flexshop-object-link"><button class="btn btn-theme" data-id="' . self::$object->id . '">In den Warenkorb legen</button></div>';

        return '
			<div class="flexshop-object">
				<div class="row">
					' . $picture . '
					<div class="flexshop-object-data col-xs-12 col-sm-7">
						' . $label . '
						' . $description . '
						' . $price . ' €
						' . $link . '
					</div>
				</div>
			</div>
		';
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
