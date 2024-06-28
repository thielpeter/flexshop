<?php

// use Konekt\PdfInvoice\InvoicePrinter;
// use setasign\Fpdi\Fpdi;

class rex_yform_action_flexshop_generate_attachments extends rex_yform_action_abstract
{
    public function executeAction(): void
    {
        $invoiceAdressIsPostAddress = $this->params['value_pool']['email']['invoice_address'];

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
            'invoice_address' => $this->params['value_pool']['email']['invoice_address'],
            'invoice_company' => $this->params['value_pool']['email']['invoice_company'],
            'invoice_salutation' => $invoiceAdressIsPostAddress ? $this->params['value_pool']['email']['salutation'] : $this->params['value_pool']['email']['invoice_salutation'],
            'invoice_firstname' => $invoiceAdressIsPostAddress ? $this->params['value_pool']['email']['firstname'] : $this->params['value_pool']['email']['invoice_firstname'],
            'invoice_surname' => $invoiceAdressIsPostAddress ? $this->params['value_pool']['email']['surname'] : $this->params['value_pool']['email']['invoice_surname'],
            'invoice_street' => $invoiceAdressIsPostAddress ? $this->params['value_pool']['email']['street'] : $this->params['value_pool']['email']['invoice_street'],
            'invoice_zip' => $invoiceAdressIsPostAddress ? $this->params['value_pool']['email']['zip'] : $this->params['value_pool']['email']['invoice_zip'],
            'invoice_city' => $invoiceAdressIsPostAddress ? $this->params['value_pool']['email']['city'] : $this->params['value_pool']['email']['invoice_city'],
            'invoice_country' => $invoiceAdressIsPostAddress ? $this->params['value_pool']['email']['country'] : $this->params['value_pool']['email']['invoice_country'],
        ];

        $confirmationPdf = rex_flexshop_pdf::generateConfirmation($data);
        $this->params['value_pool']['email_attachments'][] = $confirmationPdf;

        if (rex_config::get('flexshop', 'send_invoice')) {
            $invoicePdf = rex_flexshop_pdf::generateInvoice($data);
            $this->params['value_pool']['email_attachments'][] = $invoicePdf;
        }
    }

    public function getDescription(): string
    {
        return 'action|flexshop_generate_attachments';
    }
}
