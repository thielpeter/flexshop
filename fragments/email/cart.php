<!--================ Cart ================-->
<style>

td{
	padding:15px;
}

</style>
<div>
	<table>
		<thead>
		<tr>
			<th>Produkt</th>
			<th class="count-col">Anzahl</th>
			<th class="total-col">Gesamt</th>
		</tr>
		</thead>
		<tbody>

            <?php foreach ($this->getVar('objects') as $object) : ?>
                <?php
                $fragment = new rex_fragment();
                $fragment->setVar('picture', $object['picture']);
                $fragment->setVar('subtitle', $object['subtitle']);
				$fragment->setVar('label', $object['label']);
                $fragment->setVar('description', $object['description']);
                $fragment->setVar('price', $object['price']);
				$fragment->setVar('info', $object['info']);
                $fragment->setVar('sum', $object['sum']);
                $fragment->setVar('id', $object['id']);
                $fragment->setVar('quantity', $object['quantity']);
                echo $fragment->parse('/email/cart_object.php');
                ?>
            <?php endforeach ?>

		</tbody>

	</table>
</div>
<!--================ End of Cart ================-->


<div>
    <table>
        <tbody class="mad-text-color4">
        <tr>
            <th>Ausgewählte Produkte</th>
            <td>
                <?php echo rex_flexshop_helper::format_currency($this->getVar('sum')) ?>
            </td>
        </tr>
        <tr>
            <th>Versandkosten</th>
            <td><?php echo rex_flexshop_helper::format_currency($this->getVar('shipping')) ?></td>
        </tr>
        </tbody>
        <tfoot>
        <tr class="mad-total">
            <th>Gesamtpreis</th>
            <td>
                <?php echo rex_flexshop_helper::format_currency($this->getVar('total')) ?>
            </td>
        </tr>
        </tfoot>
    </table>
</div>