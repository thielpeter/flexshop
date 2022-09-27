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
                            <a href="#"><?php echo htmlspecialchars_decode($this->getVar('label')) ?></a>
                        </h6>
                    </div>
                    <!--/ product-info -->
                </div>
                <!-- End of Product -->
            </div>
        </div>
    </td>
    <td data-cell-title="Subtotal">
        <?php echo $this->getVar('quantity') ?>
    </td>
    <td data-cell-title="Subtotal">
        <?php echo format_chf($this->getVar('sum')) ?>
    </td>
</tr>
<!-- Single item -->