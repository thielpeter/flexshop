<?php



$yform = new rex_yform();
// $yform->setDebug(TRUE);
$yform->setObjectparams('form_name', 'form-payment');
$yform->setObjectparams('form_id', 'form-payment');
$yform->setObjectparams('form_class', 'form form-payment mad-form type-2 item-col-1');
$yform->setObjectparams('form_wrap_class', 'flexshop-payment-form');
$yform->setObjectparams('real_field_names', true);
$yform->setObjectparams('form_action', rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['page' => 'payment']));

$yform->setValueField('html', array('', '<div class="row"><div class="col-sm-12">'));
$yform->setValueField('html', array('', rex_flexshop_payment::getPaymentMethodsSelection()));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValueField('fieldset', array("fieldset_submit", "", ""));

$yform->setValueField('html', array('', '<div class="row"><div class="col-sm-12">'));
$yform->setValueField('submit', array('send-form-checkout', 'Weiter', '', '', '', 'btn btn-primary btn-huge w-100'));
$yform->setValueField('html', array('', '</div></div>'));

$yform->setValidateField('empty', array('payment_method', 'Bitte Zahlungsart wählen'));

$yform->setActionField('callback', ['rex_flexshop_payment::saveToSession']);
$yform->setActionField('redirect', array(rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['page' => 'summary'])));

$form = $yform->getForm();
?>

<div class="row">
    <div class="col-xxl-8 col-lg-8">
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
                            <span class="mad-price"><?php echo rex_flexshop_helper::format_currency($this->getVar('sum')) ?></span>
                        </td>
                    </tr>
                    <tr class="mad-product-item">
                        <th>Versand</th>
                        <td data-cell-title="Versand">
                            <span class="mad-price"><?php echo rex_flexshop_helper::format_currency($this->getVar('shipping')) ?></span>
                        </td>
                    </tr>
                    <?php if($this->getVar('vat') > 0 && $this->getVar('vat') <= 100){ ?>
                        <tr class="mad-product-item">
                            <th>zzgl. <?php echo $this->getVar('vat') ?>% MwSt.</th>
                            <td data-cell-title="Mehrwertsteuer">
                                <span class="mad-price"><?php echo rex_flexshop_helper::format_currency($this->getVar('vatsum')) ?></span>
                            </td>
                        </tr>
                    <?php } ?>
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
