<div class="flexshop-cart-object">
    <div class="row">
        <div class="flexshop-object-picture col-xs-12 col-sm-3"><img
                    src="index.php?rex_media_type=rex_media_medium&rex_media_file=<?php echo $this->getVar('picture') ?>"/>
        </div>
        <div class="flexshop-object-data col-xs-12 col-sm-5">
            <div class="flexshop-object-label col-12"><h3><?php echo $this->getVar('label') ?></h3></div>
            <div class="flexshop-cart-price col-12"><?php echo $this->getVar('price') ?></div>
        </div>
        <div class="flexshop-object-functions col-xs-12 col-sm-4 text-right">
            <button class="btn btn-default flexshop-object-remove" data-id="<?php echo $this->getVar('id') ?>">-</button>
            <span class="flexshop-object-count"><?php echo $this->getVar('count') ?></span>
            <button class="btn btn-default flexshop-object-add" data-id="<?php echo $this->getVar('id') ?>">+</button>
            <a class="btn btn-alert"
                href="<?php echo rex_flexshop_cart::getDeleteUrl($this->id) ?>"><span><?php echo $this->getVar('button_text') ?></span></a>
        </div>
    </div>
</div>