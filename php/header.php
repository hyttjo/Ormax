<?php
    $tile_selection = $_GET['tiili'];

    if ($tile_selection == 'ormax') {
        $ormax_selected = 'selected';
    } else if ($tile_selection == 'protector') {
        $protector_selected = 'selected';
    } else {
        $tile_selection = 'ormax';
    }    
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/header.css">
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <img id="ormax_logo" src="img/ormax_logo.png" alt="Ormax tiilikatot logo"></img>
                </td>
                <td>
                    <h1>Hinnastolaskenta 2015</h1>
                    <select id="tile_selection">
                        <option value="ormax" <?php echo $ormax_selected; ?>>Ormax-betonikattotiili</option>
                        <option value="protector" <?php echo $protector_selected; ?>>Protector-betonikattotiili</option>
                    </select>
                </td>
                <td>
                    <img id="tile_image" src="img/<?php echo $tile_selection ?>.jpg" alt="Tiilikuva"></img>
                </td>
                </tr>
        </table>     
    </body>
</html>
