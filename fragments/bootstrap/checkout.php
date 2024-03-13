<?php

$yform = new rex_yform();
// $yform->setDebug(TRUE);
$yform->setObjectparams('form_name', 'form-checkout');
$yform->setObjectparams('form_id', 'form-checkout');
$yform->setObjectparams('form_class', 'form form-checkout mad-form type-2 item-col-1');
$yform->setObjectparams('form_wrap_class', 'flexshop-checkout-form');
$yform->setObjectparams('real_field_names', true);
$yform->setObjectparams('form_action', rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['page' => 'checkout']));

$yform->setValueField('html', array('', '<div class="row"><div class="col-sm-6">'));
	$yform->setValueField('text', array('email', 'E-Mail *' ));
$yform->setValueField('html', array('', '</div><div class="col-sm-6">'));
	$yform->setValueField('text', array('tel', 'Telefon *' ));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValueField('html', array('', '<div class="row"><div class="col-sm-4">'));
	$yform->setValueField('choice', array('salutation','Anrede *','Herr,Frau'));
$yform->setValueField('html', array('', '</div><div class="col-sm-4">'));
	$yform->setValueField('text', array('firstname', 'Vorname *' ));
$yform->setValueField('html', array('', '</div><div class="col-sm-4">'));
	$yform->setValueField('text', array('surname', 'Nachname *' ));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValueField('html', array('', '<div class="row"><div class="col-sm-4">'));
	$yform->setValueField('text', array('street', 'Straße Nr. *' ));
$yform->setValueField('html', array('', '</div><div class="col-sm-4">'));
	$yform->setValueField('text', array('zip', 'PLZ *' ));
$yform->setValueField('html', array('', '</div><div class="col-sm-4">'));
	$yform->setValueField('text', array('city', 'Ort *' ));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValueField('html', array('', '<div class="row"><div class="col-sm-12">'));
	$yform->setValueField('choice', array('country', 'Land *', rex_flexshop_cart::getCountriesList() ));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValueField('html', array('', '<div class="row"><div class="col-sm-12">'));
	$yform->setValueField('submit', array('send-form-checkout', 'Bestellung prüfen', '', '', '', 'btn btn-primary btn-huge w-100'));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValidateField('empty', array('email', 'Bitte E-Mail eintragen'));
$yform->setValidateField('empty', array('tel', 'Bitte Telefon eintragen'));
$yform->setValidateField('empty', array('firstname', 'Bitte Vorname eintragen'));
$yform->setValidateField('empty', array('surname', 'Bitte Nachname eintragen'));
$yform->setValidateField('empty', array('street', 'Bitte Straße und Nummer eintragen'));
$yform->setValidateField('empty', array('zip', 'Bitte PLZ eintragen'));
$yform->setValidateField('empty', array('city', 'Bitte Ort eintragen'));
$yform->setValidateField('empty', array('country', 'Bitte Land eintragen'));

$yform->setActionField('redirect', array(rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['page' => 'summary']).'&email=###email###&tel=###tel###&salutation=###salutation###&firstname=###firstname###&surname=###surname###&street=###street###&zip=###zip###&city=###city###&country=###country###'));

$form = $yform->getForm();

// dump($_REQUEST);
?>

    <div class="row">
        <div class="col-xxl-8 col-lg-8">
            <h2>Kontaktdaten</h2>
             <?php echo $form ?>
        </div>
        <div class="col-xxl-4 col-lg-4">
            <div class="mad-widget">
                <h2 class="mad-widget-title color-2">Übersicht</h2>
                <!--================ Horizontal Table ================-->
                <div class="mad-table-wrap mad-order content-element-4">
                    <table class="mad-table mad-table--vertical">
                        <tbody>
                        <tr class="mad-product-item">
                            <th>Produkte</th>
                            <td data-cell-title="Produkte">
                                <span class="mad-price"><?= rex_flexshop_helper::format_currency($this->getVar('sum')) ?></span>
                            </td>
                        </tr>
                        <tr class="mad-product-item">
                            <th>Versand</th>
                            <td data-cell-title="Versand">
                                <span class="mad-price"><?= rex_flexshop_helper::format_currency($this->getVar('shipping')) ?></span>
                            </td>
                        </tr>
                        <tr class="mad-total">
                            <th>Gesamt</th>
                            <td>
                                <span class="mad-price"><b><?php echo rex_flexshop_helper::format_currency($this->getVar('total')) ?></b></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!--================ End of Horizontal Table ================-->
            </div>
        </div>
    </div>
