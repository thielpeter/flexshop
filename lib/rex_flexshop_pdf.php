<?php

use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Mpdf\Output\Destination;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;

class rex_flexshop_pdf
{
    /**
     * @throws MpdfException
     * @throws CrossReferenceException
     * @throws PdfParserException
     * @throws PdfTypeException
     */
    public static function generateInvoice($data): array
    {
        $filename = self::normalize('Rechnung - '.$data['invoice_firstname'].' '.$data['invoice_surname'].' - '.$data['date_create']).'.pdf';
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

        $mpdf = new Mpdf(['mode' => 'c']);

        $mpdf->SetSourceFile($template);
        $tplId = $mpdf->ImportPage(1);
        $mpdf->UseTemplate($tplId);
        $mpdf->WriteHTML($content);
        $mpdf->Output($path, Destination::FILE);

        return [$filename, $path];
    }

    /**
     * @throws MpdfException
     * @throws CrossReferenceException
     * @throws PdfParserException
     * @throws PdfTypeException
     */
    public static function generateConfirmation($data): array
    {
        $filename = self::normalize('Lieferschein - '.$data['firstname'].' '.$data['surname'].' - '.$data['date_create']).'.pdf';
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

        $mpdf = new Mpdf(['mode' => 'c']);

        $mpdf->SetSourceFile($template);

        $tplId = $mpdf->ImportPage(1);
        $mpdf->UseTemplate($tplId);
        $mpdf->WriteHTML($content);
        $mpdf->Output($path, Destination::FILE);

        return [$filename, $path];
    }

    private static function normalize($string, $replaceChar = '_', $allowedChars = '')
    {
        $string = mb_strtolower($string, 'UTF-8');
        $string = str_replace(['ä', 'ö', 'ü', 'ß'], ['ae', 'oe', 'ue', 'ss'], $string);
        $string = preg_replace('/[^a-z\d' . preg_quote($allowedChars, '/') . ']+/ui', $replaceChar, $string);
        return trim($string, $replaceChar);
    }
}
