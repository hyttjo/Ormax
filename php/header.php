<?php
    session_start();    

    if ($tile == 'protector') {
        $tile_selected = 'Protector-betonikattotiili';
    } else if ($tile == 'minster') {
        $tile_selected = 'Minster-betonikattotiili';
    } else if ($tile == 'turmalin') {
        $tile_selected = 'Turmalin-savikattotiili';
    } else if ($tile == 'granat') {
        $tile_selected = 'Granat-savikattotiili';
    } else if ($tile == 'vittinge_t11') {
        $tile_selected = 'Vittinge T11-savikattotiili';
    } else if ($tile == 'vittinge_e13') {
        $tile_selected = 'Vittinge E13-savikattotiili';
    } else {
        $tile_selected = 'Ormax-betonikattotiili';
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
                    <div id="tile_selection" class="dropdown">
                        <a href="#">
                            <?php echo $tile_selected; ?>
                            <img src="img/icons/arrow_icon.png" alt="lista_nuoli"></img>
                        </a>
                        <ul>
                            <li>
                                <a href="index.php?from=<?php echo $to;?>&tiili=ormax">
                                    <img src="img/tiles/small_img/ormax.png" alt="Ormax"></img>
                                    Ormax-betonikattotiili</a>
                            </li>
                            <li>
                                <a href="index.php?from=<?php echo $to;?>&tiili=protector">
                                    <img src="img/tiles/small_img/protector.png" alt="Protector"></img>
                                    Protector-betonikattotiili</a>
                            </li>
                            <li>
                                <a href="index.php?from=<?php echo $to;?>&tiili=minster">
                                    <img src="img/tiles/small_img/minster.png" alt="Minster"></img>
                                    Minster-betonikattotiili</a>
                            </li>
                            <li>
                                <a href="index.php?from=<?php echo $to;?>&tiili=turmalin">
                                    <img src="img/tiles/small_img/turmalin.png" alt="Turmalin"></img>
                                    Turmalin-savikattotiili</a>
                            </li>
                            <li>
                                <a href="index.php?from=<?php echo $to;?>&tiili=granat">
                                    <img src="img/tiles/small_img/granat.png" alt="Granat"></img>
                                    Granat-savikattotiili</a>
                            </li>
                            <li>
                                <a href="index.php?from=<?php echo $to;?>&tiili=vittinge_t11">
                                    <img src="img/tiles/small_img/vittinge_t11.png" alt="Vittinge T11"></img>
                                    Vittinge T11-savikattotiili</a>
                            </li>
                            <li>
                                <a href="index.php?from=<?php echo $to;?>&tiili=vittinge_e13">
                                    <img src="img/tiles/small_img/vittinge_e13.png" alt="Vittinge E13"></img>
                                    Vittinge E13-savikattotiili</a>
                            </li>
                        </ul>
                    </div>
                     <?php foreach($tile_colours as $tile_colour) { 
                                $colour_name = $tile_colour['tiedostonimi'];
                                $colour_image_file = 'img/tiles/tile_colours/' . $tile . '_' . $colour_name . '.png';

                                if ($colour_selection == $colour_name) { 
                                    $colour_selected = $tile_colour;
                                    $default_colour_image_file = $colour_image_file;
                                }
                            }  ?>
                    <div id="colour_selection" class="dropdown">
                        <a href="#">
                            <img src="<?php echo $default_colour_image_file; ?>" alt="väri"></img>
                            <?php echo $colour_selected; ?>
                            <img src="img/icons/arrow_icon.png" alt="lista_nuoli"></img>
                        </a>
                        <ul>
                            <?php foreach($tile_colours as $tile_colour) { 
                                $colour_name = $tile_colour['tiedostonimi'];
                                $colour_image_file = 'img/tiles/tile_colours/' . $tile . '_' . $colour_name . '.png';
                                $colour_href = 'index.php?from=' . $to . '&tiili=' . $tile . '&vari=' . $colour_name;
                            ?>
                            <li>
                                <a href="<?php echo $colour_href; ?>">
                                    <img src="<?php echo $colour_image_file; ?>" alt="väri"></img>
                                    <?php echo $tile_colour; ?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </td>
                <td id="tile_image">
                    <img src="img/tiles/header_img/<?php echo $tile ?>.jpg" alt="Tiilikuva"></img>
                </td>
                </tr>
        </table>     
    </body>
</html>
