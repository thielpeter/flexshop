<?php

$checkoutData = rex_flexshop_checkout::getData();
$paymentData = rex_flexshop_payment::getPaymentMethod();

$postAddress = '
	<div class="row mb-4">
		<div class="col-12"><h4>Postadresse</h4></div>
		<div class="col-12">' . $checkoutData['salutation'] . ' ' . $checkoutData['firstname'] . ' ' . $checkoutData['surname'] . '</div>
		<div class="col-12">' . $checkoutData['email'] . '</div>
		<div class="col-12">' . $checkoutData['tel'] . '</div>
		<div class="col-12">' . $checkoutData['street'] . '</div>
		<div class="col-12">' . $checkoutData['zip'] . ' ' . $checkoutData['city'] . ' ' . $checkoutData['country'] . '</div>
	</div>
';

$billingAddress = '';
if (isset($checkoutData['invoice_address']) && $checkoutData['invoice_address'] == "1") {
    $billingAddress = '
        <div class="row mb-4">
            <div class="col-12"><h4>Rechnungsadresse</h4></div>
            <div class="col-12">Identisch zu Postadresse</div>
        </div>
    ';
} else {
    $billingAddress = '
        <div class="row mb-4">
            <div class="col-12"><h4>Rechnungsadresse</h4></div>
            ' . ($checkoutData['invoice_company'] != '' ? '<div class="col-12">' . $checkoutData['invoice_company'] . '</div>' : '') . '
            <div class="col-12">' . $checkoutData['invoice_salutation'] . ' ' . $checkoutData['invoice_firstname'] . ' ' . $checkoutData['invoice_surname'] . '</div>
            <div class="col-12">' . $checkoutData['invoice_street'] . '</div>
            <div class="col-12">' . $checkoutData['invoice_zip'] . ' ' . $checkoutData['invoice_city'] . ' ' . $checkoutData['invoice_country'] . '</div>
        </div>
    ';
}

$paymentMethod = '
    <div class="row mb-4">
        <div class="col-12"><h4>Zahlungsart</h4></div>
        <div class="col-12">' . rex_flexshop_payment::getPaymentLabel() . '</div>
    </div>
';

$yform = new rex_yform();
// $yform->setDebug(TRUE);
$yform->setObjectparams('form_name', 'form-summary');
$yform->setObjectparams('form_id', 'form-summary');
$yform->setObjectparams('form_class', 'form form-summary mad-form type-2 item-col-1');
$yform->setObjectparams('form_wrap_class', 'flexshop-summary-form');
$yform->setObjectparams('real_field_names', true);
$yform->setObjectparams('form_action', rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['page' => 'summary']));

// $yform->setValueField('spam_protection', array("honeypot","Bitte nicht ausfüllen.","Ihre Anfrage wurde als Spam erkannt und gelöscht. Bitte versuchen Sie es in einigen Minuten erneut oder wenden Sie sich persönlich an uns.", 0));

$yform->setValueField('uuid', array('uuid'));
$yform->setValueField('hidden', array('date_create', date('Y-m-d')));
$yform->setValueField('hidden', array('cart', json_encode($_SESSION['cart'])));

foreach ($checkoutData as $key => $value) {
    $yform->setValueField('hidden', array($key, $value, 'REQUEST'));
}

$yform->setValueField('hidden', array('payment_method', rex_flexshop_payment::getPaymentMethod()));
$yform->setValueField('hidden', array('state', 'new'));

$yform->setValueField('html', array('', '<div class="row"><div class="col-sm-12">'));
$yform->setValueField('textarea', array('notes', 'Kommentar'));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValueField('html', array('', '<div class="row"><div class="col-sm-12">'));
$yform->setValueField('checkbox', array('agb', 'Ich stimme den <a class="mad-link" target="_blank" href="' . rex_getUrl(44) . '">AGB</a> zu und habe den <a target="_blank" class="mad-link" href="' . rex_getUrl(12) . '">Datenschutzhinweis</a> gelesen. *', '', 'no_db'));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValueField('html', array('', '<div class="row"><div class="col-sm-12">'));
$yform->setValueField('checkbox', array('optin_signature', 'Ich willige ein, dass dieses Formular auch ohne Unterschrift gültig und verbindlich als Bestellung gilt. *', '', 'no_db'));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValueField('html', array('', '<div class="row"><div class="col-sm-12 d-flex justify-content-between position-relative">'));
$yform->setValueField('html', array('', '<a class="btn btn-primary btn-huge btn-outline" href="' . rex_flexshop_cart::getUrl() . '">Zurück</a>'));
$yform->setValueField('submit', array('send-form-summary', rex_flexshop_payment::getPaymentMethod() == 'paypal' ? 'Bestellung absenden und weiter zur Zahlung' : 'Jetzt kaufen', '', 'no_db', '', 'btn btn-primary btn-huge'));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValidateField('empty', array('agb', 'Bitte den AGB zustimmen'));
$yform->setValidateField('empty', array('optin_signature', 'Bitte einwilligen, dass das Formular auch ohne Unterschrift als Bestellung gilt'));

$yform->setActionField('db', array('rex_flexshop_order'));

$yform->setActionField('flexshop_generate_attachments', array('attachments'));

$yform->setActionField('tpl2email', array('flexshop_admin_order', 'email'));
$yform->setActionField('tpl2email', array('flexshop_user_order', 'email'));
/*$yform->setActionField('php', array('<?php rex_flexshop_cart::resetCart(); ?>'));*/
if (rex_flexshop_payment::getPaymentMethod() == 'paypal') {
    $yform->setActionField('callback', array(function ($yform) {
        $uuid = $yform->params['value_pool']['sql']['uuid'];
        rex_flexshop_payment::payByPaypal($uuid);
    }));
} else {
    $yform->setActionField('redirect', array(rex_getUrl(rex_config::get('flexshop', 'redirect_article'))));
}

$form = $yform->getForm();

?>

<div class="row">
    <div class="col-10">
        <h3>Kontaktdaten</h3>
        <?php echo $postAddress ?>
        <?php echo $billingAddress ?>
        <?php echo $paymentMethod ?>
        <h3>Bestellung</h3>
        <!--================ Horizontal Table ================-->
        <div class="mad-table-wrap shop-cart-form shopping-cart-full">
            <table class="mad-table--responsive-md">
                <thead>
                <tr>
                    <th>Produkt</th>
                    <th class="count-col">Einzelpreis</th>
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
                    echo $fragment->parse('/bootstrap/summary_object.php');
                    ?>
                <?php endforeach ?>

                </tbody>

            </table>
        </div>
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
                    </td>
                </tr>
                <?php if ($this->getVar('vat') > 0 && $this->getVar('vat') <= 100) { ?>
                    <tr>
                        <th>zzgl. <?php echo $this->getVar('vat') ?>% MwSt.</th>
                        <td>
                            <?php echo rex_flexshop_helper::format_currency($this->getVar('vatsum')) ?>
                        </td>
                    </tr>
                <?php } ?>
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

        <?php echo $checkoutData['country'] === "DE" ? '<div class="mb-5"><strong>Hinweis:</strong> Ihr Bestellung wird über unseren Partner in Deutschland versendet.</div>' : '' ?>

        <?php echo $form ?>
    </div>
</div>
