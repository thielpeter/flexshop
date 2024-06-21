<?php

$data = rex_flexshop_checkout::getData();

$postAddress = '
	<div class="row mb-4">
		<div class="col-12"><h4>Postadresse</h4></div>
		<div class="col-12">' . $data['salutation'] . ' ' . $data['firstname'] . ' ' . $data['surname'] . '</div>
		<div class="col-12">' . $data['email'] . '</div>
		<div class="col-12">' . $data['tel'] . '</div>
		<div class="col-12">' . $data['street'] . '</div>
		<div class="col-12">' . $data['zip'] . ' ' . $data['city'] . ' ' . $data['country'] . '</div>
	</div>
';

$billingAddress = '';
if (isset($data['invoice_address']) && $data['invoice_address'] == "1") {
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
            <div class="col-12">' . $data['invoice_salutation'] . ' ' . $data['invoice_firstname'] . ' ' . $data['invoice_surname'] . '</div>
            ' . ($data['invoice_company'] != '' ? '<div class="col-12">' . $data['invoice_company'] . '</div>' : '') . '
            <div class="col-12">' . $data['invoice_street'] . '</div>
            <div class="col-12">' . $data['invoice_zip'] . ' ' . $data['invoice_city'] . ' ' . $data['invoice_country'] . '</div>
        </div>
    ';
}

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

foreach (array_intersect_key(rex_flexshop_checkout::getData(), array_flip([
    'email', 'tel', 'salutation', 'firstname', 'surname', 'street', 'zip', 'city', 'country', 'invoice_address', 'invoice_company', 'invoice_salutation', 'invoice_firstname', 'invoice_surname', 'invoice_street', 'invoice_zip', 'invoice_city', 'invoice_country'
])) as $key => $value) {
    $yform->setValueField('hidden', array($key, $value, 'REQUEST'));
}

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
$yform->setValueField('submit', array('send-form-summary', 'Jetzt kostenpflichtig bestellen', '', 'no_db', '', 'btn btn-primary btn-huge'));
$yform->setValueField('html', array('', '<div id="paypal-button-container"></div>'));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValidateField('empty', array('agb', 'Bitte den AGB zustimmen'));
$yform->setValidateField('empty', array('optin_signature', 'Bitte einwilligen, dass das Formular auch ohne Unterschrift als Bestellung gilt'));

$yform->setActionField('db', array('rex_flexshop_order'));

if (rex_config::get('flexshop', 'send_invoice')) {
    $yform->setActionField('generateinvoice', array('invoice'));
}

$yform->setActionField('tpl2email', array('flexshop_admin_order', 'email'));
$yform->setActionField('tpl2email', array('flexshop_user_order', 'email'));
/*$yform->setActionField('php', array('<?php rex_flexshop_cart::resetCart(); ?>'));*/
$yform->setActionField('redirect', array(rex_getUrl(rex_config::get('flexshop', 'redirect_article'))));

$form = $yform->getForm();

?>

<div class="row">
    <div class="col-10">
        <h3>Kontaktdaten</h3>
        <?php echo $postAddress ?>
        <?php echo $billingAddress ?>
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
        <script src="https://www.paypal.com/sdk/js?client-id=AWi4WL3ozuFEhtdAj2LcUw53udhlOZXeRleZDGXaD5wxM6AtJYbmXYc20z2eE8_29TtxrH7wknVedV_I&currency=EUR&components=buttons"></script>
        <?php echo $data['country'] === "DE" ? '<div class="mb-5"><strong>Hinweis:</strong> Ihr Bestellung wird über unseren Partner in Deutschland versendet.</div>' : '' ?>
        <!--================ End of Horizontal Table ================-->

        <h3>Bezahlmethode</h3>
        <select class="payment-method">
            <option value="bill">Rechnung</option>
            <option value="paypal">Paypal</option>
        </select>

        <?php echo $form ?>

        <script>
            document.querySelector('.payment-method').addEventListener('change', (event) => {
                // If PayPal is selected, show the PayPal button
                console.log(event.target.value)
                if (event.target.value === 'paypal') {
                    document.body.querySelector('#paypal-button-container')
                        .style.display = 'block';
                } else {
                    document.body.querySelector('#paypal-button-container')
                        .style.display = 'none';
                }
            });
            // Hide non-PayPal button by default
            document.body.querySelector('#paypal-button-container').style.display = 'none';

            paypal.Buttons({
                style: {
                    layout: 'horizontal',
                    label: 'paypal',
                    tagline: false
                },

                // Order is created on the server and the order id is returned
                createOrder: (data, actions) => {
                    return fetch("index.php?rex-api-call=flexshop&func=create_order", {
                        method: "post",
                        // use the "body" param to optionally pass additional order information
                        // like product skus and quantities
                    })
                        .then((response) => response.json())
                        .then((order) => order.id);
                },

                // Finalize the transaction on the server after payer approval
                onApprove: (data, actions) => {
                    return fetch(`index.php?rex-api-call=flexshop&func=capture_payment&id=${data.orderID}`, {
                        method: "post",
                    })
                        .then((response) => response.json())
                        .then((orderData) => {
                            // Successful capture! For dev/demo purposes:
                            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                            const transaction = orderData.purchase_units[0].payments.captures[0];
                            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                            // When ready to go live, remove the alert and show a success message within this page. For example:
                            // const element = document.getElementById('paypal-button-container');
                            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                            // Or go to another URL:  actions.redirect('thank_you.html');
                            document.querySelector('button[name=send-form-summary]').click();
                        });
                }
            }).render('#paypal-button-container');
        </script>
    </div>
</div>
