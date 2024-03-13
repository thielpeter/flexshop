<!--================ Cart ================-->
<div class="mad-table-wrap shop-cart-form shopping-cart-full">
    <table class="mad-table--responsive-md">
        <thead>
        <tr>
            <th>Produkt</th>
            <th class="count-col">Anzahl</th>
            <th class="total-col">Gesamt</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if($this->getVar('objects')){
            foreach ($this->getVar('objects') as $object) {
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
                echo $fragment->parse('/bootstrap/cart_object.php');
            }
        }
        ?>

        </tbody>

    </table>
</div>
<!--================ End of Cart ================-->


<div class="mad-table-wrap color-2 content-element-4">
    <table class="mad-table mad-table--vertical">
        <tbody class="mad-text-color4">
        <tr>
            <th>Ausgewählte Produkte</th>
            <td>
                <span class="mad-price"><?php echo rex_flexshop_helper::format_currency($this->getVar('sum')) ?></span>
            </td>
        </tr>
        <tr>
            <th>Versandkosten</th>
            <td>
                <?php echo rex_flexshop_helper::format_currency($this->getVar('shipping')) ?>
                <p class="small">Ab CHF 100.- Bestellwert ist die Lieferung kostenfrei.</p>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr class="mad-total">
            <th>Gesamtpreis</th>
            <td>
                <span class="mad-price"><?php echo rex_flexshop_helper::format_currency($this->getVar('total')) ?></span>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="d-flex justify-content-between">
    <a href="<?= rex_getUrl(6) ?>" class="btn btn-primary btn-outline">
        Weiter einkaufen
    </a>
    <a href="<?= rex_flexshop_cart::getCheckoutUrl() ?>" class="btn btn-primary">
        Bestellung abschließen
    </a>
</div>
