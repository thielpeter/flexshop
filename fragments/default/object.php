<!--<div class="flexshop-object">
    <div class="row">
        <div class="flexshop-object-picture col-xs-12 col-sm-5"><img
                    src="index.php?rex_media_type=rex_media_medium&rex_media_file=<?php echo $this->getVar('picture') ?>"/>
        </div>
        <div class="flexshop-object-data col-xs-12 col-sm-7">
            <div class="flexshop-object-label col-12"><h3></h3></div>
            <div class="flexshop-object-description col-12 typo-default"><?php echo $this->getVar('description') ?></div>
            <div class="flexshop-cart-price col-12"></div>
            <div class="flexshop-object-link">
                <button class="btn btn-theme"
                        data-id="<?php echo $this->getVar('id') ?>"><?php echo $this->getVar('button_text') ?></button>
            </div>
        </div>
    </div>
</div>-->

<div class="col mb-5">
    <div class="card h-100">
        <img class="card-img-top" src="index.php?rex_media_type=rex_media_medium&rex_media_file=<?php echo $this->getVar('picture') ?>" alt="..." />
        <div class="card-body p-4">
            <div class="text-center">
                <h5 class="fw-bolder"><?php echo $this->getVar('label') ?></h5>
                <p><?php echo $this->getVar('price') ?></p>
                <p><?php echo $this->getVar('description') ?></p>
            </div>
        </div>
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto flexshop-object-add" data-id="<?php echo $this->getVar('id') ?>" href="#"><?php echo $this->getVar('button_text') ?></a></div>
        </div>
    </div>
</div>