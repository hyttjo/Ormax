<?php
    $loading_message = $_GET['message'];
?>

<!DOCTYPE html>

<html lang="fi">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../../css/ormax_style18.css">
        <title>Loading</title>
    </head>
    <body>
        <div id="loading">
            <img src="../../img/loading_big.gif" alt="loading">
            <br>
            <?php echo $loading_message; ?>
        </div>
    </body>
</html>