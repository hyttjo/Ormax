<?php
    header('P3P: CP="NOI ADM DEV COM NAV OUR STP"');    

    date_default_timezone_set("Europe/Helsinki");

    $date = date("d.m.Y");

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $address = $_POST["address"];
    $postal_code = $_POST["postal_code"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $tile = $_POST["tile"];
    $colour = $_POST["colour"];
    $message = $_POST["message_text"];
    $attachment_1 = $_FILES["attachment_1"];
    $attachment_2 = $_FILES["attachment_2"];
    $attachment_3 = $_FILES["attachment_3"];
    $attachment_4 = $_FILES["attachment_4"];
    $attachment_5 = $_FILES["attachment_5"];
 
    $quote_info .= 'Yhteystiedot:' . "\n\n";
    $quote_info .= $firstname . ' ' . $lastname . "\n";
    $quote_info .= $address . "\n";
    $quote_info .= $postal_code . ' ' . $city . "\n";
    $quote_info .= 'Puh. ' . $phone . "\n";
    $quote_info .= $email . "\n\n";
    $quote_info .= 'Tuotetiedot:' . "\n\n";
    $quote_info .= 'Tiilimalli: ' . $tile . "\n";
    $quote_info .= 'Väri: ' . $colour . "\n\n";
    $quote_info .= 'Viesti: ' . "\n\n" . $message . "\n";

    date_default_timezone_set('Etc/UTC');

    require '../../php/scripts/PHPMailerAutoload.php';    

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
    $mail->addReplyTo($email);

    $mail->AddBCC($email_from);
    $mail->addAddress('katot@ormax.fi');

    $mail->Subject = 'Tarjouspyyntö - ' . $date .  ' - ' . $firstname . ' ' . $lastname . ' - ' . $email;

    $header_mail = $date . ' - Ormax Monier Oy' . "\n" . 'Tämä on automaattisesti lähetetty viesti tarjouspyyntölomaketta käyttäen:';

    $mail->Body = $header_mail . "\n\n" . $quote_info;

    if(isset($attachment_1)) {
        $mail->AddAttachment($attachment_1['tmp_name'], $attachment_1['name']);
    }

    if(isset($attachment_2)) {
        $mail->AddAttachment($attachment_2['tmp_name'], $attachment_2['name']);
    }

    if(isset($attachment_3)) {
        $mail->AddAttachment($attachment_3['tmp_name'], $attachment_3['name']);
    }

    if(isset($attachment_4)) {
        $mail->AddAttachment($attachment_4['tmp_name'], $attachment_4['name']);
    }

    if(isset($attachment_5)) {
        $mail->AddAttachment($attachment_5['tmp_name'], $attachment_5['name']);
    }

    if (!$mail->send()) {
        $result_message = "Virhe: " . $mail->ErrorInfo;
        } else {
        $result_message = "Tarjouspyyntö on lähetetty.";
    }
?>

<!DOCTYPE html>
<html lang="fi">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8">

        <title>Ormax Monier Oy - Tarjouspyyntölomake - Lähetetty</title>

        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div id="result_message">
            <?php echo $result_message; ?>
        </div>
    </body>
</html>
