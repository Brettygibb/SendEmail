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
    $welcomeMessage = "Welcome your email is $email,your password is $password";
    
    sendWelcomeEmail($welcomeMessage);
    header('location:welcome.php');
}
function sendWelcomeEmail($message){
    $mail = new PHPMailer(true);   
    try {
    //Server settings
    $mail->SMTPDebug = 1;
    $mail->isSMTP();
    $mail->Host       = 'smtp.mailgun.org';//Must create a profile with mailgun to use 
    $mail->SMTPAuth   = true;
    $mail->Username   = 'postmaster@sandboxf2f2ea2ce27440c89f16b71d40bca460.mailgun.org';//username copied from mailgun
    $mail->Password   = 'd8358de9d67334ac40180546d6f20a19-8c9e82ec-bf5e6c35';//password copied from mailgun
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use ENCRYPTION_SMTPS for port 465
    $mail->Port       = 587; // or 465
    //Recipients
    $mail->setFrom('random@gmail.com', 'Mailer');//email thats the sender
    $mail->addAddress('brettgibbons44@gmail.com');//change this to your email
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



