<?php
    $xml = simplexml_load_file("xml\ormax.xml") or die("XML tiedostoa ei pysty lukemaan");
?>

<!DOCTYPE html>

<html lang="fi">
    <head>
        <meta charset="utf-8">

        <title>Ormax Monier Oy - Hinnastolaskenta 2015</title>

        <link rel="stylesheet" type="text/css" href="css/general_style.css">

        <script src="js/libs/jquery-2.1.3.min.js"></script>
        <script src="js/libs/numeral.min.js"></script>
        <script src="js/libs/jquery-calx-2.0.5.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/google_analytics.js"></script>
    </head>
    <body>
        <div id="container">
            <header>
                <?php include 'php/header.php'; ?>
            </header>
        
            <?php include 'php/main_table.php'; ?>
        </div>

        <footer>
        </footer>
    </body>
</html>