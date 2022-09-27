<!-- Single item -->
<tr>
    <td data-cell-title="Product">
		<?php echo htmlspecialchars_decode($this->getVar('label')) ?>
    </td>
    <td data-cell-title="Price" style="text-align:center">
		<?php echo rex_flexshop_helper::format_currency($this->getVar('price')) ?>
    </td>
    <td data-cell-title="Quantity" style="text-align:center">
		<?php echo $this->getVar('quantity') ?>
    </td>
    <td data-cell-title="Subtotal" style="text-align:right">
		<?php echo rex_flexshop_helper::format_currency($this->getVar('sum')) ?>
    </td>
</tr>
<!-- Single item -->