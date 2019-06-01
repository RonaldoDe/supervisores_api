<?php

namespace App\Http\Controllers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include(app_path() . '/../vendor/phpmailer/phpmailer/src/Exception.php');

include(app_path() . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php');

include(app_path() . '/../vendor/phpmailer/phpmailer/src/SMTP.php');

class SenderEmail extends Controller
{
    public static function sendEmail($email, $subject, $name, $template)
    {
        try {

            $mail = new PHPMailer;
           
            $mail->isSMTP();
           
            $mail->SMTPDebug = 0;
           
            $mail->Debugoutput = 'html';
           
            $mail->Host = "mail.authsmtp.com";

            $mail->CharSet = 'UTF-8';
           
            $mail->Port = 2525;
           
            $mail->SMTPAuth = true;
           
            $mail->SMTPAutoTLS = false;
           
            $mail->SMTPSecure = ''; // To enable TLS/SSL encryption change to 'tls'
           
            $mail->AuthType = "CRAM-MD5";
           
            $mail->Username = "ac75881";
           
            $mail->Password = "Super+AT+2019.";
           
            $mail->setFrom('administrator@binar10.com.co', 'SuperAT');
           
            $mail->addAddress($email, $name); //(Send the test to yourself)
           
            $mail->Subject = $subject;
           
            $mail->isHTML(true);
           
            $mail->Body = $template;
                      
            
           
            if (!$mail->send()) {
           
                $response = 'No se pudo enviar el mensaje';
           
            } else {
           
                $response = 1;
           
            }
           
            
           
            } catch (Exception $e) {
           
                $response = "Message could not be sent. Mailer Error: {.$mail->ErrorInfo.}";

            }

            return $response;
    }
}
