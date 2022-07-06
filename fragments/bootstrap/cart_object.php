<!-- Single item -->
<div class="row">
    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
        <!-- Image -->
        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
            <img src="index.php?rex_media_type=rex_media_medium&rex_media_file=<?php echo $this->getVar('picture') ?>"
                 class="w-100" alt="<?php echo $this->getVar('label') ?>"/>
            <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
            </a>
        </div>
        <!-- Image -->
    </div>

    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
        <!-- Data -->
        <p><strong><?php echo $this->getVar('label') ?></strong></p>
        <p><?php echo $this->getVar('description') ?></p>
        <a href="<?php echo rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['func' => 'remove', 'id' => $this->getVar('id')]) ?>"
           class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
           title="<?php echo $this->i18n('remove_item') ?>">
            <i class="fas fa-trash"><?php echo $this->i18n('remove') ?></i>
        </a>
        <!--<button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                title="Move to the wish list">
            <i class="fas fa-heart"></i>
        </button>-->
        <!-- Data -->
    </div>

    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <!-- Quantity -->
        <div class="d-flex mb-4" style="max-width: 300px">
            <button class="btn btn-primary px-3 me-2"
                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                <i class="fas fa-minus">-</i>
            </button>

            <div class="form-outline">
                <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control"/>
                <!--                <label class="form-label" for="form1">Quantity</label>-->
            </div>

            <button class="btn btn-primary px-3 ms-2"
                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                <i class="fas fa-plus">+</i>
            </button>
        </div>
        <!-- Quantity -->

        <!-- Price -->
        <p class="text-start text-md-center">
            <strong><?php echo $this->getVar('price') ?> €</strong>
        </p>
        <!-- Price -->
    </div>
</div>
<!-- Single item -->