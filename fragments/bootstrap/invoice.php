<?php

$data = $this->getVar('data');

$contactOut = '
	<p>' . $data['invoice_company'] . '<br>
	' . $data['invoice_salutation'] . '<br>
	' . $data['invoice_firstname'] . ' ' . $data['invoice_surname'] . '<br>
	' . $data['invoice_street'] . ' ' . $data['invoice_street_number'] . '<br>
	' . $data['invoice_country'] . ' - ' . $data['invoice_zip'] . ' ' . $data['invoice_city'] . '</p>
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

    <p class="color-primary"><strong>Rechnung</strong></p>

    <br/>

    <p><?php echo ($data['invoice_salutation'] === "Herr" ? "Lieber " : "Liebe ") . $data['invoice_firstname'] . ' ' . $data['invoice_surname']; ?></p>

    <p>Vielen Dank für die Bestellung von <?php echo $data['firstname'] . ' ' . $data['surname'] ?>:</p>

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

    <p>Ich bitte um Ausgleich der Rechnung innerhalb von 10 Tagen.<br/>Ich bin Ihnen
        dankbar, wenn Sie die Überweisung via Bank- oder Post-Konto tätigen. Sie helfen mir damit, Gebühren zu sparen,
        welche bei Einzahlung am Postschalter entstehen.</p>
    <p>Herzliche Grüsse</p>
    <p>i.A. Rolf Murer</p>
</div>
