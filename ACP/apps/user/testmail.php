<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer;
use PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'lithantesters@gmail.com';                 // SMTP username
    $mail->Password = '$lithanese@2020.';                           // SMTP password
    $mail->SMTPSecure = 'SSL';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    
    //Recipients
    $mail->setFrom('lithantesters@gmail.com', 'DNC Administrator');
    $mail->addAddress('jimmy.lim@live.com.sg');     // Add a recipient
    $mail->addAddress('lydiatgl@gmail.com');    // Name is optional
    $mail->addReplyTo('lithantesters@gmail.com', 'DNC Administrator');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Developer Network Connection Technet Events 2018 @ MBS Convention';
    $mail->Body    = 'You are invited to the <b>Developer Network Technet 2018!</b> A special event where all software programmers and developers will gathered once a year';
    $mail->AltBody = 'You are invited to the Developer Network Technet 2018! A special event where all software programmers and developers will gathered once a year';
    
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>