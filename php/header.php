<?php
    session_start();    

    $tile_selection = $_GET['tiili'];

    if ($tile_selection == 'ormax') {
        $ormax_selected = 'selected';
    } else if ($tile_selection == 'protector') {
        $protector_selected = 'selected';
    } else if ($tile_selection == 'minster') {
        $minster_selected = 'selected';
    } else if ($tile_selection == 'turmalin') {
        $turmalin_selected = 'selected';
    } else if ($tile_selection == 'granat') {
        $granat_selected = 'selected';
    } else if ($tile_selection == 'vittinge_t11') {
        $vittinge_t11_selected = 'selected';
    } else if ($tile_selection == 'vittinge_e13') {
        $vittinge_e13_selected = 'selected';
    } else {
        $tile_selection = 'ormax';
    }

    if ($_GET['vari']) {
        $colour_selection = $_GET['vari'];
    } else {
        $colour_selection = $tile_colours_filenames[0];
    }
    
    if ($_GET['from'] == 'ormax') {
        $to = 'ormax';
    } else {
        $to = '';
    }  
?>

<html>
    <body>
        <table>
            <tr id="logged_in_header" class="<?php echo $user ?>">
                <td>
                    <img src="img/users/<?php echo $user ?>.png" alt="Käyttäjän logo"></img> 
                </td>
                <td id="logout">
                    <a href="php/scripts/logout.php">KIRJAUDU ULOS</a>
                </td>
            </tr>
            <tr>
                <td>
                    <h1>Hinnastolaskenta 2015</h1>
                    <select id="tile_selection">
                        <option data-to="<?php echo $to ?>" value="ormax" <?php echo $ormax_selected; ?>>Ormax-betonikattotiili</option>
                        <option data-to="<?php echo $to ?>" value="protector" <?php echo $protector_selected; ?>>Protector-betonikattotiili</option>
                        <option data-to="<?php echo $to ?>" value="minster" <?php echo $minster_selected; ?>>Minster-betonikattotiili</option>
                        <option data-to="<?php echo $to ?>" value="turmalin" <?php echo $turmalin_selected; ?>>Turmalin-savikattotiili</option>
                        <option data-to="<?php echo $to ?>" value="granat" <?php echo $granat_selected; ?>>Granat-savikattotiili</option>
                        <option data-to="<?php echo $to ?>" value="vittinge_t11" <?php echo $vittinge_t11_selected; ?>>Vittinge T11-savikattotiili</option>
                        <option data-to="<?php echo $to ?>" value="vittinge_e13" <?php echo $vittinge_e13_selected; ?>>Vittinge E13-savikattotiili</option>
                    </select>
                    <select id="colour_selection">
                        <?php foreach($tile_colours as $tile_colour) { 
                            if ($colour_selection == $tile_colour['tiedostonimi']) { 
                                $colour_selected = 'selected'; 
                            } else {
                                $colour_selected = '';  
                            }
                        ?>
                        <option value="<?php echo $tile_colour['tiedostonimi']; ?>" <?php echo $colour_selected; ?>><?php echo $tile_colour; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td id="tile_image">
                    <img src="img/tiles/<?php echo $tile_selection ?>.jpg" alt="Tiilikuva"></img>
                </td>
                </tr>
        </table>     
    </body>
</html>
