<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'garciabarreratoni@gmail.com';                     // SMTP username
    $mail->Password   = 'adlmywvqrbalymfe';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged PHPMailer::ENCRYPTION_STARTTLS
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('garciabarreratoni@gmail.com', 'Logging');
    $mail->addAddress($_REQUEST["E-mail"], 'toni');     // Add a recipient a quien le envio el correo PENDIENTE DE CAMBIO


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Correo de recuperacion de cuenta.';
    $mail->Body    = 'Dale al link si deseas recuperar la contraseña, de lo contrario no respondas al correo <a href="https://dawjavi.insjoaquimmir.cat/agarcia/M07/UF1/prova_uf1/B/GeneracionPassword.php?token='.$token.'">Recuperar Password</a>';//MIRAR
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Mensaje enviado, si el correo introducido existe te llegara en breves instantes.';
    die();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>