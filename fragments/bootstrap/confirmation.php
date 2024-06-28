<?php

$data = $this->getVar('data');

$contactOut = '
	<p>' . $data['salutation'] . '<br>
	' . $data['firstname'] . ' ' . $data['surname'] . '<br>
	' . $data['street'] . '<br>
	' . $data['country'] . ' - ' . $data['zip'] . ' ' . $data['city'] . '</p>
';

?>

<style>

    p, h1, h2, h3, a, td, th {
        font-family: Asap, sans-serif;
        color: #3d3d3d;
        font-size: 12px
    }

    .color-primary {
        color: #e95d8e
    }

</style>

<div style="padding-top:165px; padding-left:38px; padding-right:38px">

    <?php echo $contactOut ?>

    <br/>

    <p style="text-align:right">Stein am Rhein, <?php echo date('d.m.Y', time()) ?></p>

    <p class="color-primary"><strong>Lieferschein</strong></p>

    <br/>

    <p><?php echo ($data['salutation'] === "Herr" ? "Lieber " : "Liebe ") . $data['firstname'] . ' ' . $data['surname']; ?></p>

    <p>Vielen Dank für Ihre Bestellung:</p>

    <br/>

    <table style="width:100%">
        <thead>
        <tr>
            <th>Produkt</th>
            <th>Einzelpreis</th>
            <th>Anzahl</th>
            <th style="text-align:right">Gesamt</th>
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
            echo $fragment->parse('/bootstrap/invoice_object.php');
            ?>
        <?php endforeach ?>
        </tbody>

    </table>

    <br/>

    <table style="width:100%;">
        <tbody>
        <tr>
            <th style="text-align:right">Ausgewählte Produkte</th>
            <td style="text-align:right">
                <span><?php echo rex_flexshop_helper::format_currency($this->getVar('sum')) ?></span>
            </td>
        </tr>
        <tr>
            <th style="text-align:right">Versandkosten</th>
            <td style="text-align:right">
                <?php echo rex_flexshop_helper::format_currency($this->getVar('shipping')) ?>
            </td>
        </tr>
        <?php if ($this->getVar('vat') > 0 && $this->getVar('vat') <= 100) { ?>
            <tr>
                <th style="text-align:right">zzgl. <?php echo $this->getVar('vat') ?>% MwSt.</th>
                <td style="text-align:right">
                    <?php echo rex_flexshop_helper::format_currency($this->getVar('vatsum')) ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
        <tr>
            <th style="text-align:right" class="color-primary">Gesamtpreis</th>
            <td style="text-align:right" class="color-primary">
                <strong><?php echo rex_flexshop_helper::format_currency($this->getVar('total')) ?></strong>
            </td>
        </tr>
        </tfoot>
    </table>

    <br/>

    <p>Ich wünsche Ihnen viel Freude damit.</p>
    <p>Herzliche Grüsse</p>
    <p>i.A. Rolf Murer</p>
</div>
