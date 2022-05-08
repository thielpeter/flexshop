<div class="flexshop-object">
    <div class="row">
        <div class="flexshop-object-picture col-xs-12 col-sm-5"><img
                    src="index.php?rex_media_type=rex_media_medium&rex_media_file=<?php echo $this->getVar('picture') ?>"/>
        </div>
        <div class="flexshop-object-data col-xs-12 col-sm-7">
            <div class="flexshop-object-label col-12"><h3><?php echo $this->getVar('label') ?></h3></div>
            <div class="flexshop-object-description col-12 typo-default"><?php echo $this->getVar('description') ?></div>
            <div class="flexshop-cart-price col-12"><?php echo $this->getVar('price') ?></div>
            <div class="flexshop-object-link">
                <button class="btn btn-theme"
                        data-id="<?php echo $this->getVar('id') ?>"><?php echo $this->getVar('button_text') ?></button>
            </div>
        </div>
    </div>
</div>