<?php

    // session_start();
    // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    // }
    // echo $email;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'supreetmaurya77@gmail.com';
    $mail->Password = 'zlenzqapvuwtcgbc';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('supreetmaurya77@gmail.com');
    $mail->addAddress('me.supreet.maurya@gmail.com');

    $mail->Body = "Hello";

    $mail->send();
    echo "sent";


?>