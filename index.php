<?php
    session_start();

    if($_SESSION['logged_in']) {
       $user = $_SESSION['username'];
    } else {
       header("Location: php/login.php"); 
    }

    if($_GET['tiili']) {
        $tile = $_GET['tiili'];
    }else {
        $tile = "ormax";
    }
    
    $xml = simplexml_load_file('xml\\' . $tile . '.xml') or die("XML tiedostoa ei pysty lukemaan");
?>

<!DOCTYPE html>

<html lang="fi">
    <head>
        <meta charset="utf-8">

        <title>Ormax Monier Oy - Hinnastolaskenta 2015</title>

        <link rel="stylesheet" type="text/css" href="css/ormax_style.css">
        <!--[if IE]>
	        <link rel="stylesheet" type="text/css" href="css/ie9_and_older_style1.css">
        <![endif]-->

        <script src="../js/libs/head.min.js"></script>

        <script>
            head.js(["https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js",
                     "js/libs/numeral.min.js",
                     "js/libs/jquery-calx-2.0.5.min.js",
                     "js/script2.js",
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