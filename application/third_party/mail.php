<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function getMailer()
{
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();                                            
        $mail->Mailer = "smtp";
        $mail->Host       = 'smtp.hostinger.com';                  
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'admin@12thcityrealestate.ng';
        $mail->Password   = 'Rit*Yt6|';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->Hostname   = 'localhost.localdomain';
        $mail->addReplyTo('admin@12thcityrealestate.ng', 'no-reply');
        $mail->setFrom('admin@12thcityrealestate.ng', '12thCity Real Estate');

        return $mail;
}
