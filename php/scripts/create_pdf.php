<?php
    session_start();

    include("mysql.php");
    include("mpdf/mpdf.php");

    $date = date("d.m.Y");
    $user = $_SESSION['username'];
    $data = $_POST['json'];
    $type = $data[0]['type'];
    $mail_address1 = $data[1]['mail_address1'];
    $mail_address2 = $data[2]['mail_address2'];
    $mail_address3 = $data[3]['mail_address3'];
    $mail_message = str_replace("'", "", $data[4]['mail_message']);
    $mail_mark_identifier = $data[5]['mail_mark_identifier'];
    $download_mark_identifier = $data[6]['download_mark_identifier'];
    $print_mark_identifier = $data[7]['print_mark_identifier'];
    $tile = $data[8]['tile'];
    $discount = $data[9]['discount'];
    $lift_to_roof = $data[10]['lift_to_roof'];
    $postal_code = $data[11]['postal_code'];
    $city = $data[12]['city'];
    $delivery_cost = $data[13]['delivery_cost'];
    $total_price = $data[14]['total_price'];
    $total_price_with_delivery = $data[15]['total_price_with_delivery'];
    $total_price_tax = $data[16]['total_price_tax'];
    $total_price_with_delivery_tax = $data[17]['total_price_with_delivery_tax'];

    if ($type == 'mail') {
        $mark_identifier = $mail_mark_identifier;
    } else if  ($type == 'download') {
        $mark_identifier = $download_mark_identifier;
    } else {
        $mark_identifier = $print_mark_identifier;
    }

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

    $logged_in_header = '';
    $logged_in_header_style = '';

    if($user != 'ormax' && $user != 'asentaja') { 
        if($user == 'rautakesko') { $logged_in_header_style = 'style="background-color: #e6e6e6; text-align: left;"'; }
        if($user == 'rautanet') { $logged_in_header_style = 'style="background-color: #004fa1; text-align: left;"'; }
        if($user == 'stark') { $logged_in_header_style = 'style="background-color: #255797; text-align: left;"'; }
        if($user == 'hankkija') { $logged_in_header_style = 'style="background-color: #0c9859; text-align: left;"'; }
        if($user == 'sok') { $logged_in_header_style = 'style="background-color: #0d469d; text-align: left;"'; }

        $logged_in_header .= "<tr id='logged_in_header'>";
            $logged_in_header .= "<td colspan='4' ". $logged_in_header_style .">";
                $logged_in_header .= '<img height="20px" src="../../img/'. $user .'.png"></img>';
            $logged_in_header .= '</td>';
        $logged_in_header .= '</tr>';
    }

    $product_table = '';

    for($i = 0; $i < Count($data) + 1; ++$i){
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
                            <td>'. $total_price .' €</td>
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
                        <tr>
                            <td class="label">Merkki:</td>
                            <td class="info">'. $mark_identifier .'</td>
                        </tr>
                    </table>                </td>                <td id="total_cost_table">
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

    $header_text = 'Tarjouslaskenta - Ormax Monier Oy - ' . $mark_identifier . ' - ' . $date;

    $filename = $header_text . ' - ' . $tile . '.pdf'; 
    $filename = sanitize_filename($filename);

    if ($type == 'mail') {
        $emailAttachment = $mpdf->Output($filename,'S');  
        include("send_mail.php");
    } else if  ($type == 'download') {
        $pdf = $mpdf->Output('../../pdf/' . $filename,'F');

        $query="UPDATE kayttajat SET tallennuskerrat = tallennuskerrat + 1, viimeksikaynyt = DATE_ADD(now(), INTERVAL 9 HOUR) WHERE nimi='$user'";
        mysqli_query($con, $query) or die(mysqli_error($con));
        
        echo $filename;
    } else {
        $mpdf->SetJS('this.print();');
        $pdf = $mpdf->Output('../../pdf/' . $filename,'F');
        
        $query="UPDATE kayttajat SET tulostuskerrat = tulostuskerrat + 1, viimeksikaynyt = DATE_ADD(now(), INTERVAL 9 HOUR) WHERE nimi='$user'";
        mysqli_query($con, $query) or die(mysqli_error($con));
        
        echo $filename;  
    }

    function sanitize_filename($filename) {
        $replace_chars = array(
            'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
            'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
            'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
            'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
            'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
            'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
            'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
        );
        $filename = strtr($filename, $replace_chars);
        $filename = preg_replace(array('/[\&]/', '/[\@]/', '/[\#]/'), array(' ja ', ' at ', ' numero '), $filename);
        $filename = preg_replace('|[^A-Za-z0-9\s\.\_\-]|', '', $filename);
        return $filename;
    }
?>