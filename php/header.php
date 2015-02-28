<?php
    session_start();    

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
    <body>
        <table>
            <tr id="logged_in_header" class="<?php echo $user ?>">
                <td colspan="2">
                    <img src="img/<?php echo $user ?>.png" alt="Käyttäjän logo"></img> 
                </td>
                <td id="logout">
                    <a href="php/scripts/logout.php">KIRJAUDU ULOS</a>
                </td>
            </tr>
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
                <td id="tile_image">
                    <img src="img/<?php echo $tile_selection ?>.jpg" alt="Tiilikuva"></img>
                </td>
                </tr>
        </table>     
    </body>
</html>
