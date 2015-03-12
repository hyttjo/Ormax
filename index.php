<?php
    session_start();

    if($_SESSION['logged_in']) {
       $user = $_SESSION['username'];
    } else {
       header("Location: php/login.php"); 
    }

    if($_SERVER['HTTP_REFERER'] == '') {
        header("Location: http://www.ormax.fi/ammattilaisille/hinnastolaskenta/");  
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
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8">

        <title>Ormax Monier Oy - Hinnastolaskenta 2015</title>

        <link rel="stylesheet" type="text/css" href="css/ormax_style2.css">

        <script src="../js/libs/head.min.js"></script>

        <script>
            head.js(["https://code.jquery.com/jquery-1.9.1.min.js",
                     "js/libs/numeral.min.js",
                     "js/libs/jquery-calx-2.0.5.min.js",
                     "js/script3.js",
                     "js/google_analytics.js"]);
        </script>
    </head>
    <body onload="parent.postMessage(document.body.scrollHeight, 'http://www.ormax.fi/ammattilaisille/hinnastolaskenta/');">
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