<?php
    session_start();

    include("mysql.php");
    include("mpdf/mpdf.php");
    
    date_default_timezone_set("Europe/Helsinki");

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
    $colour = $data[9]['colour'];
    $discount = $data[10]['discount'];
    $lift_to_roof = $data[11]['lift_to_roof'];
    $postal_code = $data[12]['postal_code'];
    $city = $data[13]['city'];
    $delivery_cost = $data[14]['delivery_cost'];
    $total_price = $data[15]['total_price'];
    $total_price_with_delivery = $data[16]['total_price_with_delivery'];
    $total_price_tax = $data[17]['total_price_tax'];
    $total_price_with_delivery_tax = $data[18]['total_price_with_delivery_tax'];

    if ($type == 'mail') {
        $mark_identifier = $mail_mark_identifier;
        $sql_type = 'email ('. $mail_address1 .')';
    } else if  ($type == 'download') {
        $mark_identifier = $download_mark_identifier;
        $sql_type = 'lataus';
    } else {
        $mark_identifier = $print_mark_identifier;
        $sql_type = 'tulostus';
    }

    if ($discount == '') {
        $discount = '0';
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
                    '. $tile .' - '. $colour .'</span>
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

    if($user != 'ormax' && $user != 'asentaja' && $user != 'laskuri') { 
        if($user == 'rautia') { $logged_in_header_style = 'style="background-color: #00599e; text-align: left;"'; }
        if($user == 'krauta') { $logged_in_header_style = 'style="background-color: #e6e6e6; text-align: left;"'; }
        if($user == 'rautakesko') { $logged_in_header_style = 'style="background-color: #e6e6e6; text-align: left;"'; }
        if($user == 'rautanet') { $logged_in_header_style = 'style="background-color: #004fa1; text-align: left;"'; }
        if($user == 'stark') { $logged_in_header_style = 'style="background-color: #255797; text-align: left;"'; }
        if($user == 'hankkija') { $logged_in_header_style = 'style="background-color: #0c9859; text-align: left;"'; }
        if($user == 'sok') { $logged_in_header_style = 'style="background-color: #0d469d; text-align: left;"'; }
        if($user == 'puumerkki') { $logged_in_header_style = 'style="background-color: #484848; text-align: left;"'; }
        if($user == 'carlson') { $logged_in_header_style = 'style="background-color: #0096d1; text-align: left;"'; }
        if($user == 'rtv') { $logged_in_header_style = 'style="background-color: #feed01; text-align: left;"'; }
        if($user == 'hartman') { $logged_in_header_style = 'style="background-color: #d5efff; text-align: left;"'; }
        if($user == 'lakkapaa') { $logged_in_header_style = 'style="background-color: #4d6fbb; text-align: left;"'; }

        $logged_in_header .= "<tr id='logged_in_header'>";
            $logged_in_header .= "<td colspan='5' ". $logged_in_header_style .">";
                $logged_in_header .= '<img height="20px" src="../../img/users/'. $user .'.png"></img>';
            $logged_in_header .= '</td>';
        $logged_in_header .= '</tr>';
    }

    $product_table = '';

    for($i = 0; $i < Count($data) + 1; ++$i){
        if ($data[$i]['category']) {
            $product_table .= '<tr>';
                $product_table .= '<td class="product_number" style="text-align: center;">';
                    $product_table .= $data[$i]['product_number'];
                $product_table .= '</td>';
                $product_table .= '<td class="product_name" style="text-align: left;">';
                    $product_table .= $data[$i]['product_name'];
                $product_table .= '</td>';
                $product_table .= '<td class="product_amount">';
                    $product_table .= $data[$i]['product_amount'];
                $product_table .= '</td>';
                $product_table .= '<td class="product_price">';
                    $product_table .= $data[$i]['product_price'];
                $product_table .= '</td>';
                $product_table .= '<td class="product_sumprice">';
                    $product_table .= $data[$i]['product_sumprice'];
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
                            <th>Tuotenumero</th>
                            <th>Tuote</th>
                            <th>Määrä</th>
                            <th>Kappalehinta €</th>
                            <th>Hinta €</th>
                        </tr>
                        '. $product_table . '
                        <tr id="product_table_total_price">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>'. $total_price .' €</td>
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
                            <td class="label">Väri:</td>
                            <td class="info">'. $colour .'</td>
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
                            <td class="label">Alennusprosentti:</td>
                            <td class="info">'. $discount .' %</td>
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
    
    $query = 'SELECT MAX(id) FROM valmiit_laskennat'; 
    $result =  mysqli_query($con, $query) or die(mysqli_error($con));
    $id = mysqli_fetch_array($result);
    $id = $id[0] + 1;

    $filename = $header_text . ' - ' . $id . ' - ' . $tile . ' - ' . $colour . '.pdf'; 
    $filename = sanitize_filename($filename);

    if ($type == 'mail') {
        $mpdf->Output('../../pdf/' . $user . '/'  . $filename,'F');
        $emailAttachment = $mpdf->Output($filename,'S');  
        include("send_mail.php");
    } else if  ($type == 'download') {
        $pdf = $mpdf->Output('../../pdf/' . $user . '/'  . $filename,'F');

        $query="UPDATE kayttajat SET tallennuskerrat = tallennuskerrat + 1, viimeksikaynyt = DATE_ADD(now(), INTERVAL 9 HOUR) WHERE nimi='$user'";
        mysqli_query($con, $query) or die(mysqli_error($con));
        
        echo $filename;
    } else {
        $mpdf->SetJS('this.print();');
        $pdf = $mpdf->Output('../../pdf/' . $user . '/' . $filename,'F');
        
        $query="UPDATE kayttajat SET tulostuskerrat = tulostuskerrat + 1, viimeksikaynyt = DATE_ADD(now(), INTERVAL 9 HOUR) WHERE nimi='$user'";
        mysqli_query($con, $query) or die(mysqli_error($con));
        
        echo $filename;  
    }

    $total_price = floatval($total_price);
    $total_price_tax = floatval($total_price_tax);
    $total_price_with_delivery = floatval($total_price_with_delivery);
    $total_price_with_delivery_tax = floatval($total_price_with_delivery_tax);
    $delivery_cost = floatval($delivery_cost);
    $sql_order = 'Ei';

    $query="INSERT INTO valmiit_laskennat(tekija, pvm, tiedostonimi, tiili, vari, postinumero, paikkakunta, tuotteiden_hinta, tuotteiden_hinta_alv, loppusumma, loppusumma_alv, toimituskustannukset, alennusprosentti, katollenosto, merkki, tarjouksen_tyyppi, tilaus) 
    values('$user', DATE_ADD(now(), INTERVAL 9 HOUR), '$filename', '$tile', '$colour', '$postal_code', '$city', '$total_price', '$total_price_tax', '$total_price_with_delivery', '$total_price_with_delivery_tax', '$delivery_cost', '$discount', '$lift_to_roof', '$mark_identifier', '$sql_type', '$sql_order')";
    mysqli_query($con, $query) or die(mysqli_error($con));

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