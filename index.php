<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $email = $_POST['email'];
    $password =$_POST['password'];
    
    registerUser($email,$password);
}
function registerUser($email,$password){
    $welcomeMessage = "Welcome your email is $email";
    
    sendWelcomeEmail($welcomeMessage);
    header('location:welcome.php');
}
function sendWelcomeEmail($message){
    $mail = new PHPMailer(true);   
    try {
    //Server settings
    $mail->SMTPDebug = 1;
    $mail->isSMTP();
    $mail->Host       = '';//Must create a profile with mailgun to use 
    $mail->SMTPAuth   = true;
    $mail->Username   = '';//username copied from mailgun
    $mail->Password   = '';//password copied from mailgun
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use ENCRYPTION_SMTPS for port 465
    $mail->Port       = 587; // or 465
    //Recipients
    $mail->setFrom("");//email thats the sender
    $mail->addAddress('');//change this to your email
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';// this is your subject
    $mail->Body    = $message;//this is your message
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}



