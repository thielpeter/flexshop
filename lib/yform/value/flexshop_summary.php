<?php

class rex_yform_value_flexshop_summary extends rex_yform_value_abstract
{

	function enterObject()
	{
		// $objects = rex_flexshop_cart::getObjects();
		
		// $sum = 0;
		// foreach($objects as $id){
			// $object = rex_flexshop_object::query()
            // ->where('id', $id)
            // ->findOne();
			
			// $sum += $object->price;
		// }
		
        // $this->params['form_output'][$this->getId()] = '
			// <div class="flexshop-summary-data">
				// Name: '.$this->params['value_pool']['db']['firstname'].' '.$this->params['value_pool']['db']['surname'].'
			// </div>
			// <div class="flexshop-summary-cart">
				// Gesamtsumme: '.$sum.' €
			// </div>
		// ';
		
		// this->params['form_output'][$this->getId()] = rex_flexshop_summary::getOverview();
	}

	function getDescription(): string
	{
		return "flexshop_summary -> Beispiel: flexshop_summary";
	}
	
	public function getDefinitions(): array
    {
        return [
            'type' => 'value',
            'name' => 'signatur',
            'values' => [
                'name' => ['type' => 'name',   'label' => rex_i18n::msg('yform_values_defaults_name')],
            ],
            'description' => 'FlexShop Bestell-Übersicht',
            'db_type' => ['text']
        ];
    }
}

?>