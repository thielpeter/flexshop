<?php
class rex_flexshop_pdf
{
    public static function generateInvoice($data)
    {
        $filename = rex_string::normalize('Rechnung - '.$data['invoice_firstname'].' '.$data['invoice_surname'].' - '.$data['date_create']).'.pdf';
        $path = $_SERVER["DOCUMENT_ROOT"] . '/documents/' . $filename;
        $template = $_SERVER["DOCUMENT_ROOT"] . '/assets/pdf/Briefpapier_2022_NEU.pdf';

        $objects = rex_flexshop_cart::processObjects($_SESSION['cart']);

        $fragment = new rex_fragment();
        $fragment->setVar('data', $data);
        $fragment->setVar('objects', $objects);
        $fragment->setVar('sum', rex_flexshop_cart::getSum());
        $fragment->setVar('total', rex_flexshop_cart::getTotal());
        $fragment->setVar('shipping', rex_flexshop_cart::calculateShipping());
        $content = $fragment->parse('/bootstrap/invoice.php');

        $mpdf = new \Mpdf\Mpdf(['mode' => 'c']);

        $mpdf->SetSourceFile($template);
        $tplId = $mpdf->ImportPage(1);
        $mpdf->UseTemplate($tplId);
        $mpdf->WriteHTML($content);
        $mpdf->Output($path, \Mpdf\Output\Destination::FILE);

        return [$filename, $path];
    }

    public static function generateConfirmation($data)
    {
        $filename = rex_string::normalize('Lieferschein - '.$data['firstname'].' '.$data['surname'].' - '.$data['date_create']).'.pdf';
        $path = $_SERVER["DOCUMENT_ROOT"] . '/documents/' . $filename;
        $template = $_SERVER["DOCUMENT_ROOT"] . '/assets/pdf/Briefpapier_2022_NEU.pdf';

        $objects = rex_flexshop_cart::processObjects($_SESSION['cart']);

        $fragment = new rex_fragment();
        $fragment->setVar('data', $data);
        $fragment->setVar('objects', $objects);
        $fragment->setVar('sum', rex_flexshop_cart::getSum());
        $fragment->setVar('total', rex_flexshop_cart::getTotal());
        $fragment->setVar('shipping', rex_flexshop_cart::calculateShipping());
        $content = $fragment->parse('/bootstrap/confirmation.php');

        $mpdf = new \Mpdf\Mpdf(['mode' => 'c']);

        $mpdf->SetSourceFile($template);
        $tplId = $mpdf->ImportPage(1);
        $mpdf->UseTemplate($tplId);
        $mpdf->WriteHTML($content);
        $mpdf->Output($path, \Mpdf\Output\Destination::FILE);

        return [$filename, $path];
    }
}
