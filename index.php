<?php
    header('P3P: CP="NOI ADM DEV COM NAV OUR STP"');

    session_start();
    include 'php/scripts/mysql.php';
    
    if($_SESSION['logged_in']) {
        $user = $_SESSION['username'];
        $query = "SELECT * FROM kayttajat WHERE nimi = '$user'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $row = mysqli_fetch_array($result);
        $nimi = $row['nimi'];
        $query="UPDATE kayttajat SET kayntikerrat = kayntikerrat + 1, viimeksikaynyt = DATE_ADD(now(), INTERVAL 9 HOUR) WHERE nimi='$nimi'";
        mysqli_query($con, $query) or die(mysqli_error($con));
    } else {
       header("Location: php/login.php"); 
    }
    
    if ($_SERVER['HTTP_REFERER'] == '') {
        header("Location: http://www.ormax.fi/ammattilaisille/tarjouslaskuri/");  
    }

    if ($_GET['tiili']) {
        $tile = $_GET['tiili'];
    } else {
        $tile = "ormax";
    }

    $xml_tile = simplexml_load_file('xml\\' . $tile . '\\' . $tile . '.xml') or die("XML tiedostoa ei pysty lukemaan");

    $tile_colours = $xml_tile->Varivaihtoehdot->children();
    $tile_colours_filenames = array();

    foreach ($tile_colours as $tile_colour) { 
        array_push($tile_colours_filenames, $tile_colour['tiedostonimi']);
    }

    if ($_GET['vari']) {
        $colour_selection = $_GET['vari'];
    } else {
        $colour_selection = $tile_colours_filenames[0];
    }

    $xml_products = simplexml_load_file('xml\\' . $tile . '\\' . $tile . '_' . $colour_selection . '.xml') or die("XML tiedostoa ei pysty lukemaan");
?>
<!DOCTYPE html>

<html lang="fi">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8">

        <title>Ormax Monier Oy - Hinnastolaskenta 2015</title>

        <link rel="stylesheet" type="text/css" href="css/ormax_style16.css">

        <script src="../js/libs/head.min.js"></script>

        <script>
            head.js(["https://code.jquery.com/jquery-1.9.1.min.js",
                     "js/libs/jquery.cookie.js",
                     "js/libs/numeral.min.js",
                     "js/libs/jquery-calx-2.0.5.min.js",
                     "js/libs/jquery-ui.js",
                     "js/script23.js",
                     "js/google_analytics.js"]);
        </script>
    </head>
    <body>
        <div id="container">
            <header>
                <?php include 'php/header.php'; ?>
            </header>
        
            <?php include 'php/main_table.php'; ?>
        
            <footer>
                <?php include 'php/footer.php'; ?>
            </footer>

            <?php include 'php/windows.php'; ?>
        </div>
    </body>
</html>