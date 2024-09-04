<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Create an instance of PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings for the recipient email
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'kiranvishnu2122@gmail.com';            // SMTP username
    $mail->Password   = 'ngzzvbcwveqbpzvv';                     // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                                  // Enable SSL encryption
    $mail->Port       = 587;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress('kiranvishnu2122@gmail.com');              // Add a recipient

    // Content for recipient email
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = $_POST['subject'];
    $mail->Body    = "<strong>From:</strong> {$_POST['name']}<br><strong>Email:</strong> {$_POST['email']}<br><strong>Message:</strong><br>{$_POST['message']}";
    $mail->AltBody = "From: {$_POST['name']}\nEmail: {$_POST['email']}\nMessage:\n{$_POST['message']}";

    // Send the email to the recipient
    $mail->send();

    // Create an instance of PHPMailer for confirmation email
    $confirmationMail = new PHPMailer(true);

    // Server settings for the confirmation email
    $confirmationMail->isSMTP();
    $confirmationMail->Host       = 'smtp.gmail.com';
    $confirmationMail->SMTPAuth   = true;
    $confirmationMail->Username   = 'kiranvishnu2122@gmail.com';
    $confirmationMail->Password   = 'ngzzvbcwveqbpzvv';
    $confirmationMail->SMTPSecure = 'ssl';
    $confirmationMail->Port       = 465;

    // Recipients for confirmation email
    $confirmationMail->setFrom('kiranvishnu2122@gmail.com', 'Dr.R.Kesavamoorthy');
    $confirmationMail->addAddress($_POST['email'], $_POST['name']);  // Add the sender as recipient

    // Content for confirmation email
    $confirmationMail->isHTML(true);
    $confirmationMail->Subject = 'Thank you for contacting us!';
    $confirmationMail->Body    = '<p>Thank you for contacting us.<br> We have received your message and will get back to you shortly.</p>';
    $confirmationMail->AltBody = 'Thank you for contacting us. We have received your message and will get back to you shortly.';

    // Send the confirmation email to the sender
    $confirmationMail->send();
    echo '<p style="color: white; ">Message has been sent and a confirmation email has been sent to the sender.</p>';
} catch (Exception $e) {
    // Catch block for exceptions
    echo '' . $e->getMessage();
}
?>
