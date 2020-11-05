<?php

if(isset($_POST["send_pre"])){

    $f_name = $_POST["f_name"];
    $f_country = $_POST["f_country"];
    $f_email = $_POST["f_email"];
    $f_phone = $_POST["f_phone"];
    
    $c_name = $_POST["c_name"];
    $c_email = $_POST["c_email"];
    $c_phone = $_POST["c_phone"];
    
    $fencer_ids = $_POST["fencer_ids"];

    $compet_id = $_POST["compet_id"];

}



// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'borisz.varkonyi@gmail.com';                     // SMTP username
    $mail->Password   = 'boborisz2003';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('borisz.varkonyi@gmail.com', 'Mailer');
    $mail->addAddress('borisz.varkonyi@gmail.com', 'Federation');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Please confirm your pre registration';
    $mail->Body    = '
    
    <a style="color:red;" href="http://localhost/cw/confirmed_pre.php?f_name='. $f_name .'&f_country='. $f_country  .'&f_email='. $f_email .'&f_phone='. $f_phone .'&c_name='. $c_name .'&c_email='.$c_email.'&c_phone='.$c_phone.'&fencer_ids='.$fencer_ids.'&compet_id='.$compet_id.'">Confirm</a>
    
    ';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}