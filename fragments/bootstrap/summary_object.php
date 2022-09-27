<!-- Single item -->
<tr class="mad-product-item">
    <td data-cell-title="Product">
        <div class="mad-products mad-product-small">
            <div class="mad-col">
                <!-- Product -->
                <div class="mad-product align-items-center">
                    <!-- product-info -->
                    <div class="mad-product-description">
                        <p class="mad-product-title">
                            <?php echo htmlspecialchars_decode($this->getVar('label')) ?>
                        </p>
                    </div>
                    <!--/ product-info -->
                </div>
                <!-- End of Product -->
            </div>
        </div>
    </td>
    <td data-cell-title="Price">
        <div class="price type-2">
            <?php echo rex_flexshop_helper::format_currency($this->getVar('price')) ?>
        </div>
    </td>
    <td data-cell-title="Quantity">
        <div class="quantity type-2 text-center">
            <?php echo $this->getVar('quantity') ?>
        </div>
    </td>
    <td data-cell-title="Subtotal">
        <span class="mad-price"><?php echo rex_flexshop_helper::format_currency($this->getVar('sum')) ?></span>
    </td>
</tr>
<!-- Single item -->