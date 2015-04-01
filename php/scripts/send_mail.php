<?php
session_start();
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';
include("mysql.php");
include("mpdf/mpdf.php");

$user = $_SESSION['username'];
$data = $_POST['json'];
$mail_address1 = $data[0]['mail_address1'];
$mail_address2 = $data[1]['mail_address2'];
$mail_address3 = $data[2]['mail_address3'];
$mail_message = str_replace("'", "", $data[3]['mail_message']);
$tile = $data[4]['tile'];
$discount = $data[5]['discount'];
$lift_to_roof = $data[6]['lift_to_roof'];
$postal_code = $data[7]['postal_code'];
$city = $data[8]['city'];
$delivery_cost = $data[9]['delivery_cost'];
$total_price = $data[10]['total_price'];
$total_price_with_delivery = $data[11]['total_price_with_delivery'];
$total_price_tax = $data[12]['total_price_tax'];
$total_price_with_delivery_tax = $data[13]['total_price_with_delivery_tax'];

$query="UPDATE kayttajat SET mailikerrat = mailikerrat + 1, viimeksikaynyt = DATE_ADD(now(), INTERVAL 9 HOUR) WHERE nimi='$user'";
mysqli_query($con, $query) or die(mysqli_error($con));

if ($delivery_cost == '') {
    $delivery_cost = '0';
}
if ($total_price == '') {
    $total_price = '0';
}
if ($total_price_tax == '') {
    $total_price_tax = '0';
}
if ($total_price_with_delivery == '' || $delivery_cost == '0') {
    $total_price_with_delivery = '0';
}
if ($total_price_with_delivery_tax == '' || $delivery_cost == '0') {
    $total_price_with_delivery_tax = '0';
}

$date = date("d.m.Y");

$header = '
    <table id="header" style="background-image: url(\'../../img/header_red.png\');">
        <tr>
            <td id="ormax_logo">
                <img src="../../img/ormax_logo.png";/>
            </td>
            <td id="header_text" colspan="2">
                Ormax Monier Oy<br> 
                <span id="subheader"><i>Tarjouslaskenta  - ' . $date . '</i><br>
                '. $tile .'</span>
            </td>
        </tr>
    </table>
';

$footer = '
    <table id="footer" style="background-image: url(\'../../img/footer_red.png\');">
        <tr>
            <td id="1st">Ormax Monier Oy</td>
            <td id="2nd">Asiakaspalvelu:</td>
            <td id="3rd">Puh. 09 2533 7200<br>katot@ormax.fi</td>
        </tr>
    </table>
';

$product_table = '';

for($i = 0; $i < Count($data); ++$i){
    if ($data[$i]['category']) {
        $product_table .= '<tr>';
            $product_table .= '<td class="product_name" style="text-align: left;">';
                $product_table .= $data[$i]['product_name'];
            $product_table .= '</td>';
            $product_table .= '<td class="product_amount">';
                $product_table .= $data[$i]['product_amount'];
            $product_table .= '</td>';
            $product_table .= '<td class="product_sumprice">';
                $product_table .= $data[$i]['product_sumprice'];
            $product_table .= '</td>';
            $product_table .= '<td class="product_price">';
                $product_table .= $data[$i]['product_price'];
            $product_table .= '</td>';
        $product_table .= '</tr>';
    }
}

$logged_in_header = '';
$logged_in_header_style = '';

if($user != 'ormax' && $user != 'asentaja') { 
    if($user == 'rautakesko') { $logged_in_header_style = 'style="background-color: #e6e6e6;"'; }
    if($user == 'rautanet') { $logged_in_header_style = 'style="background-color: #004fa1;"'; }
    if($user == 'stark') { $logged_in_header_style = 'style="background-color: #255797;"'; }
    if($user == 'hankkija') { $logged_in_header_style = 'style="background-color: #0c9859;"'; }
    if($user == 'sok') { $logged_in_header_style = 'style="background-color: #0d469d;"'; }

    $logged_in_header .= "<tr id='logged_in_header'>";
        $logged_in_header .= "<td colspan='4' ". $logged_in_header_style .">";
            $logged_in_header .= '<img height="20px" src="../../img/'. $user .'.png"></img>';
        $logged_in_header .= '</td>';
    $logged_in_header .= '</tr>';
}



$html = '
    <table id="main_table">
        <tr>
            <td colspan="2" id="product_table">
                <table>
                    '. $logged_in_header .'
                    <tr>
                        <th>Tuote</th>
                        <th>Määrä</th>
                        <th>Hinta €</th>
                        <th>Kappalehinta €</th>
                    </tr>
                    '. $product_table . '
                    <tr id="product_table_total_price">
                        <td></td>
                        <td></td>
                        <td>'. $total_price .'</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td id="delivery_info_table">
                <table>
                    <tr>
                        <th colspan="2">Laskentatiedot</th>
                    </tr>
                    <tr>
                        <td class="label">Tiili:</td>
                        <td class="info">'. $tile .'</td>
                    </tr>
                    <tr>
                        <td class="label">Katolle nosto:</td>
                        <td class="info">'. $lift_to_roof .'</td>
                    </tr>
                    <tr>            
                        <td class="label">Postinumero:</td>
                        <td class="info">'. $postal_code .'</td>
                    </tr>
                    <tr>
                        <td class="label">Kunta:</td>
                        <td class="info">'. $city .'</td>
                    </tr>
                    <tr>
                        <td class="label">Toimituskustannukset:</td>
                        <td class="info">'. $delivery_cost .' €</td>
                    </tr>
                </table>            </td>            <td id="total_cost_table">
                <table>
                    <tr>
                        <th>Tuotteiden <br>hinta</th>
                        <th>Loppusumma <br>toimituskuluineen</th>
                    </tr>
                    <tr>
                        <td class="alv_row" colspan="2">Arvonlisävero 0 %</td>
                    </tr>
                    <tr>
                        <td class="total_price">'. $total_price .' €</td>
                        <td class="total_price">'. $total_price_with_delivery .' €</td>
                    </tr>
                    <tr>
                        <td  class="alv_row" colspan="2">Sis. arvonlisäveron 24 %</td>
                    </tr>
                    <tr>
                        <td class="total_price">'. $total_price_tax .' €</td>
                        <td class="total_price">'. $total_price_with_delivery_tax .' €</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
';

$stylesheet = file_get_contents('../../css/quote_pdf.css');

$mpdf = new mPDF('', 'A4', '', '', 0, 0, 40, 20, 0, 0);
$mpdf->SetHTMLHeader($header, 'true');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html);
$mpdf->SetHTMLFooter($footer);
$emailAttachment = $mpdf->Output('ormax.pdf','S');  

//Create a new PHPMailer instance
$mail = new PHPMailer;

$email_from = 'ormaxnoreply@gmail.com';

$mail->setLanguage('fi', '/');

$mail->CharSet = "UTF-8";

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = $email_from;

//Password to use for SMTP authentication
$mail->Password = "obrmtyy77";

//Set who the message is to be sent from
$mail->setFrom($email_from, 'Ormax Monier Oy');

//Set an alternative reply-to address
$mail->addReplyTo('katot@ormax.fi', 'Ormax Monier Oy');

//Set who the message is to be sent to
$mail->AddBCC($email_from);
$mail->addAddress($mail_address1);
if($mail_address2 != '') {
    $mail->addAddress($mail_address2);
}
if($mail_address3 != '') {
    $mail->addAddress($mail_address3);
}

//Set the subject line
$mail->Subject = 'Tarjouslaskenta - Ormax Monier Oy - ' . $date;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
$header_mail = 'Tämä on automaattisesti lähetetty viesti Ormax Monier Oy:ltä';
$attachment_info = 'Liitteenä tarjouslaskenta PDF-muodossa.';
$header_mail_body = 'Saateteksti:';

if($mail_message == '') { 
    $mail_message = 'Tyhjä'; 
}

$mail->Body = $header_mail . ' - ' . $date . "\n\n" . $attachment_info . "\n\n" . $header_mail_body . "\n\n" . $mail_message;

//Attach an image file
$filename = $mail->Subject . ' - ' . $tile . '.pdf'; 
$mail->AddStringAttachment($emailAttachment, $filename);

//send the message, check for errors
if (!$mail->send()) {
    echo "Virhe: " . $mail->ErrorInfo;
    } else {
    echo "Tarjous on lähetetty.";
}