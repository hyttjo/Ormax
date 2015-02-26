<?php

?>

<!DOCTYPE html>

<html lang="fi">
    <head>
        <meta charset="utf-8">

        <title>Ormax Monier Oy - Hinnastolaskenta 2015</title>

        <script src="js/libs/head.min.js"></script>

        <script>
            head.load(["css/general_style.css",
                       "css/header.css",
                       "css/main_table.css",
                       "css/side_area.css",
                       "css/footer.css",
                       "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js",
                       "js/libs/numeral.min.js",
                       "js/libs/jquery-calx-2.0.5.min.js",
                       "js/script.js",
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
        </div>
    </body>
</html>