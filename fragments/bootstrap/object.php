<div class="col mb-5">
    <div class="card h-100">
        <!-- Sale badge-->
        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
        <!-- Product image-->
        <img class="card-img-top" src="index.php?rex_media_type=rex_media_medium&rex_media_file=<?php echo $this->getVar('picture') ?>" alt="..." />
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder"><?php echo $this->getVar('label') ?></h5>
                <p><?php echo $this->getVar('description') ?></p>
                <!-- Product price-->
                <span class="text-muted text-decoration-line-through"><?php echo $this->getVar('price') ?></span>
            </div>
        </div>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?php echo rex_getUrl( rex_flexshop_cart::getArticleId() , rex_clang::getCurrentId(), ['func' => 'add', 'id' => $this->getVar('id')]) ?>" data-id="<?php echo $this->getVar('id') ?>"><?php echo $this->i18n('add_to_cart') ?></a></div>
        </div>
    </div>
</div>