<?php
    session_start();
    include 'mysql.php';

    $user = $_SESSION['username'];
    $query="UPDATE kayttajat SET tuotekatselukerrat = tuotekatselukerrat + 1, viimeksikaynyt = DATE_ADD(now(), INTERVAL 9 HOUR) WHERE nimi='$user'";
    mysqli_query($con, $query) or die(mysqli_error($con));

    $product_number = $_POST["product_number"];

    $query = "SELECT * FROM tuotteet WHERE tuotenumero = '$product_number'";

    $product_result = mysqli_query($con, $query);
    
    while ($row = mysqli_fetch_array($product_result)) { 
        $rows = array('img_src' => 'img/products/' . $product_number . '.jpg',
                      'name' => $row['tuotenimi'], 
                      'short_name' => $row['lyhyt_tuotenimi'],
                      'price' => $row['hinta'],
                      'weight' => $row['paino'],
                      'group' => $row['tuoteryhma'],
                      'class' => $row['tuoteluokka'],
                      'palletsize' => $row['lavakoko'],
                      'packagesize' => $row['pakkauskoko'],
                      'packageunit' => $row['pakkausyksikko'],
                      'description' => $row['kuvaus'],
                      'ean' => $row['ean']);
    }

    echo json_encode($rows);
?>