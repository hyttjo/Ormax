<?php
    date_default_timezone_set('Etc/UTC');

    include("mysql.php");
    require 'PHPMailerAutoload.php';    

    $query="UPDATE kayttajat SET mailikerrat = mailikerrat + 1, viimeksikaynyt = DATE_ADD(now(), INTERVAL 9 HOUR) WHERE nimi='$user'";
    mysqli_query($con, $query) or die(mysqli_error($con));

    $mail = new PHPMailer;

    $email_from = 'ormaxnoreply@gmail.com';

    $mail->setLanguage('fi', '/');
    $mail->CharSet = "UTF-8";
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = $email_from;
    $mail->Password = "obrmtyy77";
    $mail->setFrom($email_from, 'Ormax Monier Oy');
    $mail->addReplyTo('katot@ormax.fi', 'Ormax Monier Oy');

    $mail->AddBCC($email_from);
    $mail->addAddress($mail_address1);
    if($mail_address2 != '') {
        $mail->addAddress($mail_address2);
    }
    if($mail_address3 != '') {
        $mail->addAddress($mail_address3);
    }

    $mail->Subject = $header_text;

    $header_mail = 'Tämä on automaattisesti lähetetty viesti Ormax Monier Oy:ltä';
    $attachment_info = 'Liitteenä tarjouslaskenta PDF-muodossa.';
    $header_mail_body = 'Saateteksti:';

    if($mail_message == '') { 
        $mail_message = 'Tyhjä'; 
    }

    $mail->Body = $header_mail . ' - ' . $date . "\n\n" . $attachment_info . "\n\n" . $header_mail_body . "\n\n" . $mail_message;

    $mail->AddStringAttachment($emailAttachment, $filename);

    if (!$mail->send()) {
        echo "Virhe: " . $mail->ErrorInfo;
        } else {
        echo "Tarjous on lähetetty.";
    }
?>