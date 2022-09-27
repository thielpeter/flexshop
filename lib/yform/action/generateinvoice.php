<?php

// use Konekt\PdfInvoice\InvoicePrinter;
// use setasign\Fpdi\Fpdi;

class rex_yform_action_generateinvoice extends rex_yform_action_abstract
{
    public function executeAction(): void
    {		
		$data = [
			'uuid' => $this->params['value_pool']['sql']['uuid'],
			'date_create' => $this->params['value_pool']['sql']['date_create'],
			'email' => $this->params['value_pool']['sql']['email'],
			'tel' => $this->params['value_pool']['sql']['tel'],
			'salutation' => $this->params['value_pool']['sql']['salutation'],
			'firstname' => $this->params['value_pool']['sql']['firstname'],
			'surname' => $this->params['value_pool']['sql']['surname'],
			'street' => $this->params['value_pool']['sql']['street'],
			'zip' => $this->params['value_pool']['sql']['zip'],
			'city' => $this->params['value_pool']['sql']['city'],
			'country' => $this->params['value_pool']['sql']['country'],
		];
		
		$pdf = rex_flexshop_invoice::generatePDF($data);
		
        $this->params['value_pool']['email_attachments'][] = $pdf;
    }

    public function getDescription(): string
    {
        return 'action|generateinvoice';
    }
}
