<?php
    $dir = $_GET['dir'];
    $file = $_GET['filename'];
    $fileurl = '../../' . $dir . '/' . $file;

    header('Cache-Control: public');
    header('Content-Description: application/download');
    header('Content-Disposition: attachment; filename="'.$file.'"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Type: binary/octet-stream');
    readfile($fileurl);
?>