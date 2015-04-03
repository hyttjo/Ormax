<?php
    $tile_info_node = $xml->Tiilitiedot;

    $pallet_size = $tile_info_node->Info[0]['lavakoko'];
    $ridge_pallet_size = $tile_info_node->Info[1]['harjatiilien_lavakoko'];
    $verge_pallet_size = $tile_info_node->Info[2]['päätyreunatiilien_lavakoko'];
    $min_sold_size = $tile_info_node->Info[3]['minimimyyntierä'];
    $max_tiles_without_pallet = $tile_info_node->Info[4]['maksimi_tiilet_ilman_lavaa'];
    $square_meter_demand = $tile_info_node->Info[5]['neliömenekki'];
    $ridge_demand = $tile_info_node->Info[6]['harjatiilimenekki'];
    $verge_demand = $tile_info_node->Info[7]['päätyreunatiilimenekki'];
    $tile_fixing_demand = $tile_info_node->Info[8]['lapetiilikiinnikemenekki'];
    $ridge_fixing_demand = $tile_info_node->Info[9]['harjatiilikiinnikemenekki'];
    $verge_fixing_demand = $tile_info_node->Info[10]['päätykiinnikemenekki'];
    $ridge_tightening_materials = $tile_info_node->Info[11];
    $verge_materials = $tile_info_node->Info[12];
    $underlayer_materials = $tile_info_node->Info[13]; 
?>

<!DOCTYPE html>

<html>
    <body>
        <table id="calc_amounts_table">
            <tr>
                <th colspan="2">Laske määrät mitoilla</th>
            </tr>
            <tr>
                <td>Katon muoto:</td>
                <td>
                    <select id="roof_shape">
                        <option>Harjakatto</option>
                        <option>Pulpettikatto</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Kattoneliöt:</td>
                <td><input id="roof_area" type="number"></input><span> m<sup>2</sup></span></td>
            </tr>
            <tr>
                <td>Harjan pituus:</td>
                <td><input id="ridge_length" type="number"></input> <span>m</span></td>
            </tr>
            <?php if (count($ridge_tightening_materials) > 1) { ?>
                <tr>
                    <td>Harjatiiviste:</td>
                    <td>
                        <select id="ridge_tightening_material">
                            <?php foreach($ridge_tightening_materials as $tightening_material) { ?>
                                <option><?php echo $tightening_material; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            <?php }
                if (count($verge_materials) > 1) { ?>
            <tr>
                <td>Päätymateriaali:</td>
                <td>
                    <select id="verge_material">
                            <?php foreach($verge_materials as $verge_material) { ?>
                                <option><?php echo $verge_material; ?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td>Päätyjen pituus:</td>
                <td><input id="verge_length" type="number"></input> <span>m</span></td>
            </tr>
            <?php if (count($underlayer_materials) > 1) { ?>
            <tr>
                <td>Aluskate:</td>
                <td>
                    <select id="underlayer">
                            <?php foreach($underlayer_materials as $underlayer_material) { ?>
                                <option><?php echo $underlayer_material; ?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <?php } ?> 
            <tr>
                <td class="center" colspan="2">
                    <button id="calc_amounts">
                        <img src="img/calculator_icon.png" alt="laske"></img>
                        <span>Laske</span>
                    </button>
                </td>
            </tr>  
        </table>

        <table id="discount_table">
            <tr>
                <th>Alennusprosentti</th>
            </tr>
            <tr>
                <td class="center">
                    <input id="discount" data-cell="H1" type="number" min="0" max="100"><b>%</b></input>
                </td>
            </tr>
        </table>

        <table id="delivery_cost_table">
            <tr>
                <th colspan="2">Toimituskustannukset</th>
            </tr>
            <tr>
                <td>Katolle nosto:</td>
                <td>
                    <select id="lift_to_roof">
                        <option>Ei</option>
                        <option>Kyllä</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Postinumero:</td>
                <td>
                    <input id="postal_code" type="text" pattern="[0-9]{5}"></input>
                </td>
            </tr>
            <tr>
                <td>Kunta:</td>
                <td>
                    <input id="city" readonly></input>
                </td>
            </tr>
            <tr>
                <td>Rahtihinta:</td>
                <td>
                    <input id="delivery_cost" data-cell="H2" data-format="0[.]00 $" readonly></input>
                </td>
            </tr>
            <tr>
                <td class="center" colspan="2">
                    <button id="calc_delivery_cost">
                        <img src="img/delivery_icon.png" alt="laske"></img>
                        <span>Laske</span>
                    </button>
                </td>
            </tr>
        </table>

        <table id="total_cost_table">
            <tr>
                <th>Tuotteiden <br>hinta</th>
                <th>Loppusumma <br>toimituskuluineen</th>
            </tr>
            <tr>
                <td class="alv_row" colspan="2">Arvonlisävero 0 %</td>
            </tr>
            <tr>
                <td data-cell ="H3" data-formula="D100" data-format="0[.]00 $"></td>
                <td data-cell ="H4" data-formula="H3+H2" data-format="0[.]00 $"></td>
            </tr>
            <tr>
                <td  class="alv_row" colspan="2">Sis. arvonlisäveron 24 %</td>
            </tr>
            <tr>
                <td data-cell ="H5" data-formula="H3*1.24" data-format="0[.]00 $"></td>
                <td data-cell ="H6" data-formula="H4*1.24" data-format="0[.]00 $"></td>
            </tr>
        </table>

        <div class="center">
            <button id="open_send_mail_window">
                <img src="img/email_icon.png" alt="lähetä"></img>
                <span>Lähetä tarjous</span>
            </button>
        </div>

        <div class="center">
            <button id="open_download_window">
                <img src="img/download_icon.png" alt="lataa"></img>
                <span>Lataa tarjous</span>
            </button>
        </div>

        <div class="center">
            <button id="open_print_window">
                <img src="img/print_icon.png" alt="tulosta"></img>
                <span>Tulosta tarjous</span>
            </button>
        </div>

        <div class="center">
            <button id="empty_table">
                <img src="img/trashcan_icon.png" alt="tyhjennä"></img>
                <span>Tyhjennä taulukko</span>
            </button>
        </div>

        <table id="tile_info_table">
            <tr>
                <th colspan="2">Teknisiä tietoja</th>
            </tr>
            <tr>
                <td>Tiilikoodi:</td>
                <td id="tile_code"><?php echo $tile_selection; ?></td>
            </tr>
            <tr>
                <td>Lavakoko:</td>
                <td id="tile_pallet_size"><?php echo $pallet_size; ?></td>
            </tr>
            <tr>
                <td>Harjatiili lavakoko:</td>
                <td id="ridge_pallet_size"><?php echo $ridge_pallet_size; ?></td>
            </tr>
            <tr>
                <td>Päätyreunatiili lavakoko:</td>
                <td id="verge_pallet_size"><?php echo $verge_pallet_size; ?></td>
            </tr>
            <tr>
                <td>Minimimyyntierä:</td>
                <td id="min_sold_size"><?php echo $min_sold_size; ?></td>
            </tr>
            <tr>
                <td>Max. tiilet ilman lavaa:</td>
                <td id="max_tiles_without_pallet"><?php echo $max_tiles_without_pallet; ?></td>
            </tr>
            <tr>
                <td>Neliömenekki:</td>
                <td id="square_meter_demand"><?php echo $square_meter_demand; ?></td>
            </tr>
            <tr>
                <td>Harjatiilimenekki:</td>
                <td id="ridge_demand"><?php echo $ridge_demand; ?></td>
            </tr>
            <tr>
                <td>Päätyreunatiilimenekki:</td>
                <td id="verge_demand"><?php echo $verge_demand; ?></td>
            </tr>
            <tr>
                <td>Lapekiinnike menekki:</td>
                <td id="tile_fixing_demand"><?php echo $tile_fixing_demand; ?></td>
            </tr>
            <tr>
                <td>Harjakiinnike menekki:</td>
                <td id="ridge_fixing_demand"><?php echo $ridge_fixing_demand; ?></td>
            </tr>
            <tr>
                <td>Reunakiinnike menekki:</td>
                <td id="verge_fixing_demand"><?php echo $verge_fixing_demand; ?></td>
            </tr>
        </table>
    </body>
</html>