<?php

class rex_flexshop_summary
{
	public static function getOutput(){
		
		$yform = new rex_yform();
		// $yform->setDebug(TRUE);
		$yform->setObjectparams('form_name', 'form-summary');
		$yform->setObjectparams('form_id', 'form-summary');
		$yform->setObjectparams('form_class', 'form form-summary');
		$yform->setObjectparams('form_wrap_class', 'flexshop-summary-form');
		$yform->setObjectparams('real_field_names', false);
		$yform->setObjectparams('form_action', rex_getUrl(rex_article::getCurrentId(),rex_clang::getCurrentId(), ['page' => 'summary']));
		
		$yform->setValueField('html', array('','<div class="col-xs-12">'));
		$yform->setValueField('checkbox', array('optin','{{formAGB}}'));
		$yform->setValueField('html', array('','</div>'));
		
		// Daten & Einkaufskorb
		// ?? Bezahlung?
		$yform->setValueField('flexshop_summary', array());
		$yform->setValueField('flexshop_payment', array());

		$yform->setValueField('html', array('','<div class="col-xs-12 col-md-4 offset-md-6">'));
		$yform->setValueField('submit', array('send-form-summary','Kostenpflichtig bestellen','','','','form-submit button button-regular'));
		$yform->setValueField('html', array('','</div>'));

		// $yform->setActionField('flexshop_save_order', array();
		$yform->setActionField('tpl2email', array('flexshop-admin-order','','thiel.peter@gmail.com'));
		$yform->setActionField('redirect', array(rex_getUrl(rex_config::get('flex_shop', 'redirect_article'))));

		return $yform->getForm();
	}
}
