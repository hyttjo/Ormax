<?php
    include 'mysql.php';

    $postal_code = $_POST['postal_code'];

    $query="SELECT * FROM osoitteisto WHERE postinumero = '$postal_code'";

    $delivery_result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($delivery_result)) { 
        $city = $row['kunta'];
        $delivery_area = $row['rahtihinta'];  
    }

    echo json_encode(array($city, $delivery_area));
?>