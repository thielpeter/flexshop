<?php

class rex_flexshop_checkout
{
    public static function getOutput()
    {

        $yform = new rex_yform();
        // $yform->setDebug(TRUE);
        $yform->setObjectparams('form_name', 'form-checkout');
        $yform->setObjectparams('form_id', 'form-checkout');
        $yform->setObjectparams('form_class', 'form form-checkout');
        $yform->setObjectparams('form_wrap_class', 'flexshop-checkout-form');
        $yform->setObjectparams('real_field_names', false);
        $yform->setObjectparams('form_action', rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['page' => 'checkout']));

        $yform->setValueField('html', array('', '<div class="row">'));

        $yform->setValueField('html', array('', '<div class="col-xs-6">'));
        $yform->setValueField('text', array('firstname', 'Vorname*'));
        $yform->setValueField('html', array('', '</div>'));

        $yform->setValueField('html', array('', '<div class="col-xs-6">'));
        $yform->setValueField('text', array('surname', 'Nachname*'));
        $yform->setValueField('html', array('', '</div>'));

        $yform->setValueField('html', array('', '<div class="col-xs-6">'));
        $yform->setValueField('text', array('email', 'E-Mail-Adresse*'));
        $yform->setValueField('html', array('', '</div>'));

        $yform->setValueField('html', array('', '<div class="col-xs-6">'));
        $yform->setValueField('text', array('tel', 'Telefon'));
        $yform->setValueField('html', array('', '</div>'));

        $yform->setValueField('html', array('', '<div class="col-xs-6">'));
        $yform->setValueField('text', array('street', 'Strasse'));
        $yform->setValueField('html', array('', '</div>'));

        $yform->setValueField('html', array('', '<div class="col-xs-3">'));
        $yform->setValueField('text', array('zip', 'PLZ'));
        $yform->setValueField('html', array('', '</div>'));

        $yform->setValueField('html', array('', '<div class="col-xs-3">'));
        $yform->setValueField('text', array('place', 'Ort'));
        $yform->setValueField('html', array('', '</div>'));

        $yform->setValueField('html', array('', '<div class="col-xs-12">'));
        $yform->setValueField('text', array('message', 'Ihre Nachricht an uns'));
        $yform->setValueField('html', array('', '</div>'));

        $yform->setValueField('html', array('', '<div class="col-xs-12">'));
        $yform->setValueField('checkbox', array('optin', '{{formAGB}}'));
        $yform->setValueField('html', array('', '</div>'));

        $yform->setValueField('html', array('', '<div class="col-xs-12 col-md-4 offset-md-6">'));
        $yform->setValueField('submit', array('send-form-checkout', '{{formSubmit}}', '', '', '', 'form-submit button button-regular'));
        $yform->setValueField('html', array('', '</div>'));


        $yform->setValueField('html', array('', '</div>'));

        $yform->setValidateField('empty', array('name', '{{validateName}}'));
        $yform->setValidateField('empty', array('email', '{{validateEmail}}'));
        $yform->setValidateField('empty', array('optin', '{{validateOptin}}'));

        $yform->setActionField('redirect', array(rex_getUrl(rex_article::getCurrentId(), rex_clang::getCurrentId(), ['page' => 'summary'])));

        return $yform->getForm();
    }
}
