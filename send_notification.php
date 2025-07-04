<!-- this is a page through which i am able to send the notifications to the respective pet owner -->

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'riyagarg1215@gmail.com';   // <-- your Gmail here
        $mail->Password   = 'tcsslrdruivwgtwo';        // <-- the app password you just generated
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('riyagarg1215@gmail.com', 'PetTrackQR');  // From email and name
        $mail->addAddress($to);    // To email

        // Content
        $mail->isHTML(false);  // plain text
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    }
    catch (Exception $e) {
        return false;
    }
}
?>