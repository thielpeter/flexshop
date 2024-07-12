<?php

class rex_flexshop_email
{
    public static function getCartSummary()
    {
		$cart = new rex_flexshop_cart();
        return $cart->returnOverviewEmail();
    }

    public static function sendMail($mail_title, $mail_body)
    {
        $mail_from = rex_flexshop_helper::getMailFrom();
        $mail_to = rex_flexshop_helper::getMailAdmin();

        $mail = new rex_mailer();
        $mail->AddAddress($mail_from);
        $mail->WordWrap = 80;
        $mail->FromName = $mail_to;
        $mail->From = $mail_from;
        $mail->Sender = $mail_title;
        $mail->Subject = "";
        $mail->Body = nl2br($mail_body);
        $mail->AltBody = strip_tags($mail_body);
        $mail->Send();
    }
}
