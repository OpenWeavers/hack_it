<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Host = 'smtp.mail.com';
//$mail->Username = 'open.weavers@linuxmail.org';                 // SMTP username
//$mail->Password = '()pen\|/eavers';
$mail->Host = 'smtp.gmail.com';
$mail->Username = 'openweavers@gmail.com';
$mail->Password = 'openhack_itweavers';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;
?>