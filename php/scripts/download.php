<?php
    session_start();    

    $user = $_SESSION['username'];
    $dir = $_GET['dir'];
    $file = $_GET['filename'];
    $fileurl = '../../' . $dir . '/' . $user . '/' . $file;

    header('Cache-Control: public');
    header('Content-Description: application/download');
    header('Content-Disposition: attachment; filename="'.$file.'"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Type: binary/octet-stream');
    readfile($fileurl);
?>