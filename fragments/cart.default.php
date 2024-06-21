<div class="flexshop-cart">
    <div class="container">
        <h2><?php echo $this->getVar('cart_text') ?></h2>
        <div class="flexshop-cart-objects">
            <?php foreach ($this->getVar('objects') as $object) : ?>
                <?php
                $fragment = new rex_fragment();
                $fragment->setVar('picture', $object['picture']);
                $fragment->setVar('subtitle', $object['subtitle']);
                $fragment->setVar('label', $object['label']);
                $fragment->setVar('price', $object['price']);
                $fragment->setVar('info', $object['info']);
                $fragment->setVar('id', $object['id']);
                $fragment->setVar('count', $object['count']);
                $fragment->setVar('button_text', $object['button_text']);
                echo $fragment->parse('cart_object.default.php');
                ?>
            <?php endforeach ?>
        </div>
        <div class="flexshop-cart-sum text-right"><?php echo $this->getVar('sum_text') ?>
            : <?php echo $this->getVar('sum') ?> <?php echo rex_flexshop_helper::getCurrency() ?>
        </div>
        <div class="flexshop-cart-footer text-right">
            <a class="btn btn-theme" href="<?php echo rex_flexshop_cart::getCheckoutUrl() ?>"><span><?php echo $this->getVar('button_text') ?></span></a>
        </div>
    </div>
</div>
