<?php
    include("../mysql.php");
    
    $tiles = array('Ormax-betonikattotiili',
                   'Protector-betonikattotiili',
                   'Minster-betonikattotiili',
                   'Turmalin-savikattotiili',
                   'Granat-savikattotiili',
                   'Vittinge E13-savikattotiili',
                   'Vittinge T11-savikattotiili');

    $colours = array(array('Savitiilenpunainen'),
                     array('Tupapunainen'),
                     array('Tummanharmaa'),
                     array('Harmaa'),
                     array('Musta', 'Lasitettu Musta'),
                     array('Ruskea'),
                     array('Antiikki'),
                     array('Antrasiitti', 'Enkopoitu Antrasiitti'),
                     array(''));

    $tile_colour_results = get_tile_statistics($con, $tiles, $colours);

    include("statistics_tile_and_color_chart.php");

    function get_tile_statistics($con, $tiles, $colours) {
        $tiles_colours = array();

        for ($i = 0; $i < count($tiles); $i++) {
            array_push($tiles_colours, get_tile_colours($con, $tiles[$i], $colours));
        }
        return $tiles_colours;
    }

    function get_tile_colours($con, $tile, $colours) {
        $tile_colours = array();

        for ($i = 0; $i < count($colours); $i++) {
            array_push($tile_colours, get_tile_colour_count($con, $tile, $colours[$i]));
        }
        return $tile_colours;
    }

    function get_tile_colour_count($con, $tile, $colour) {
        if (isset($colour[1])) {
            $colour0 = $colour[0];
            $colour1 = $colour[1];
            $query = "SELECT COUNT(vari) FROM valmiit_laskennat WHERE tiili='$tile' AND vari='$colour0' OR '$colour1'";
        } else {
            $colour0 = $colour[0];
            $query = "SELECT COUNT(vari) FROM valmiit_laskennat WHERE tiili='$tile' AND vari='$colour0'";  
        }
        $result_colour = mysqli_query($con, $query) or die(mysqli_error($con));
        $colour_count = mysqli_fetch_array($result_colour);

        return $colour_count[0]; 
    }
?>