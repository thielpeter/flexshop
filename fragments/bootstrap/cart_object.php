<!-- Single item -->
<tr class="mad-product-item">
    <td data-cell-title="Product">
        <div class="mad-products mad-product-small">
            <div class="mad-col">
                <!-- Product -->
                <div class="mad-product align-items-center">
                    <a href="<?php echo rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['func' => 'delete', 'id' => $this->getVar('id')]) ?>"
                       class="mad-close-item" data-mdb-toggle="tooltip"
                       title="<?php echo $this->i18n('remove_item') ?>">
                        <i class="fas fa-times"></i>
                    </a>

                    <a href="#">
                        <img src="index.php?rex_media_type=rex_media_medium&rex_media_file=<?php echo $this->getVar('picture') ?>"
                             class="w-100" alt="<?php echo $this->getVar('label') ?>"/>
                    </a>
                    <!-- product-info -->
                    <div class="mad-product-description">
                        <p class="mad-product-title">
                            <a href="#"><?php echo htmlspecialchars_decode($this->getVar('label')) ?></a>
                            <p><?php echo rex_flexshop_helper::format_currency($this->getVar('price')) ?></p>
                            <p class="info"><?php echo htmlspecialchars_decode($this->getVar('info')) ?></p>
                        </h6>
                    </div>
                    <!--/ product-info -->
                </div>
                <!-- End of Product -->
            </div>
        </div>
    </td>

    <td data-cell-title="Quantity">
        <div class="quantity type-2">

            <input id="form1" min="0" name="quantity" value="<?php echo $this->getVar('quantity') ?>" type="number" readonly="">
            <a href="<?php echo rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['func' => 'add', 'id' => $this->getVar('id')]) ?>" class="qty-plus">
                <i class="fas fa-plus"></i>
            </a>
            <a href="<?php echo rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['func' => 'remove', 'id' => $this->getVar('id')]) ?>" class="qty-minus">
                <i class="fas fa-minus"></i>
            </a>

        </div>
    </td>
    <td data-cell-title="Subtotal">
        <span class="mad-price"><?php echo rex_flexshop_helper::format_currency($this->getVar('sum')) ?></span>
    </td>
</tr>
<!-- Single item -->