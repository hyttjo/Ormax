<?php
    session_start();

    if($_SESSION['from'] == 'ormax') {
        $temp_from = 'ormax';
    }

    $_SESSION = array();
    session_destroy();

    header("Location: ../../index.php?from=$temp_from");
?>
