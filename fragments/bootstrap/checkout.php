<?php

$yform = new rex_yform();
// $yform->setDebug(TRUE);
$yform->setObjectparams('form_name', 'form-checkout');
$yform->setObjectparams('form_id', 'form-checkout');
$yform->setObjectparams('form_class', 'form form-checkout');
$yform->setObjectparams('form_wrap_class', 'flexshop-checkout-form');
$yform->setObjectparams('real_field_names', false);
$yform->setObjectparams('form_action', rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['page' => 'checkout']));

$yform->setValueField('html', array('', '<div class="card mb-4"><div class="card-header py-3"><h5 class="mb-0">'.$this->i18n('fieldset_contact').'</h5></div><div class="card-body"><div class="row">'));

$yform->setValueField('html', array('', '<div class="col-xs-6 mb-2">'));
$yform->setValueField('text', array('firstname',  $this->i18n('firstname') ));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '<div class="col-xs-6 mb-2">'));
$yform->setValueField('text', array('surname', $this->i18n('lastname')));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '<div class="col-xs-6 mb-2">'));
$yform->setValueField('text', array('email', $this->i18n('email')));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '<div class="col-xs-6 mb-2">'));
$yform->setValueField('text', array('tel', $this->i18n('phone')));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '</div></div></div>'));

$yform->setValueField('html', array('', '<div class="card mb-4"><div class="card-header py-3"><h5 class="mb-0">'.$this->i18n('fieldset_address_delivery').'</h5></div><div class="card-body"><div class="row">'));

$yform->setValueField('html', array('', '<div class="col-xs-6 mb-2">'));
$yform->setValueField('text', array('address_street', $this->i18n('street')));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '<div class="col-xs-3 mb-2">'));
$yform->setValueField('text', array('address_zip', $this->i18n('zip')));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '<div class="col-xs-3 mb-2">'));
$yform->setValueField('text', array('address_place', $this->i18n('place')));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '</div></div></div>'));

$yform->setValueField('html', array('', '<div class="card mb-4"><div class="card-header py-3"><h5 class="mb-0">'.$this->i18n('fieldset_address_bill').'</h5></div><div class="card-body"><div class="row">'));

$yform->setValueField('html', array('', '<div class="col-xs-6 mb-2">'));
$yform->setValueField('text', array('address_street', $this->i18n('street')));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '<div class="col-xs-3 mb-2">'));
$yform->setValueField('text', array('address_zip', $this->i18n('zip')));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '<div class="col-xs-3 mb-2">'));
$yform->setValueField('text', array('address_place', $this->i18n('place')));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '</div></div></div>'));

$yform->setValueField('html', array('', '<div class="card mb-4"><div class="card-header py-3"><h5 class="mb-0">'.$this->i18n('fieldset_notes').'</h5></div><div class="card-body"><div class="row">'));

$yform->setValueField('html', array('', '<div class="col-xs-12 mb-2">'));
$yform->setValueField('textarea', array('notes',''));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '</div></div></div>'));

$yform->setValueField('html', array('', '<div class="card mb-4"><div class="card-header py-3"><h5 class="mb-0">'.$this->i18n('fieldset_payment').'</h5></div><div class="card-body"><div class="row">'));

$yform->setValueField('html', array('', '<div class="col-xs-12 mb-2">'));
$yform->setValueField('choice', array('payment_service','',['bill' => 'Rechnung', 'sepa' => 'Lastschriftverfahren', 'paypal' => 'Paypal']));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '</div></div></div>'));

$yform->setValueField('html', array('', '<div class="col-xs-12 mb-2">'));
$yform->setValueField('checkbox', array('optin', $this->i18n('optin')));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '<div class="col-xs-12 mb-2">'));
$yform->setValueField('checkbox', array('optin_sepa', $this->i18n('optin_sepa')));
$yform->setValueField('html', array('', '</div>'));

$yform->setValueField('html', array('', '<div class="col-xs-12 col-md-6 mt-4">'));
$yform->setValueField('submit', array('send-form-checkout', $this->i18n('make_purchase'), '', '', '', 'form-submit btn btn-primary btn-lg btn-block'));
$yform->setValueField('html', array('', '</div>'));

$yform->setValidateField('empty', array('name', '{{validateName}}'));
$yform->setValidateField('empty', array('email', '{{validateEmail}}'));
$yform->setValidateField('empty', array('optin', '{{validateOptin}}'));

$yform->setActionField('redirect', array(rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['page' => 'summary'])));

$form = $yform->getForm();

?>

<div class="flexshop-checkout">
    <div class="container">
        <h2><?php echo $this->i18n('checkout') ?></h2>
        <div class="flexshop-form mt-4">
            <div class="row">
                <div class="col-md-8 mb-4">
                    <?php echo $form ?>
                </div>

                <div class="col-md-4 mb-4 position-sticky top-0">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0"><?php echo $this->i18n('overview') ?></h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    <?php echo $this->i18n('products') ?>
                                    <span><?php echo $this->getVar('sum') ?> €</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <?php echo $this->i18n('shipping') ?>
                                    <span><?php echo $this->getVar('shipping') ?> €</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong><?php echo $this->i18n('total') ?></strong>
                                        <strong>
                                            <p class="mb-0">(<?php echo $this->i18n('including_vat') ?> <?php echo $this->getVar('vat') ?> %)</p>
                                        </strong>
                                    </div>
                                    <span><strong><?php echo $this->getVar('total') ?> €</strong></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>