<?php

use PHPMailer\PHPMailer\PHPMailer;

function sendmail($name, $message, $from)
{
    $to = "Shadanaljarbou@gmail.com";  // mail of reciever
    $body =
        "<div style='width:100%;text-align:center;margin-bottom:50px'>
            <p>"
                . $name .
            "</p>
            <p>"
                . $message .
            "</p>
        </div>";

    // Credentials 
    $username = "Shadanaljarbou@gmail.com";  // you mail
    $password = "awvpdekiuqkojnpo";  // your mail password

    // Ignore from here
    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();
    // To Here

    $mail->CharSet = 'utf-8';
    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  //Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $username);
    $mail->addAddress($to); // enter email address whom you want to send
    // $mail->addReplyTo($from, $name);
    // $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}
