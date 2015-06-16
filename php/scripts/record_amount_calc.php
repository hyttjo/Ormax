<?php
    session_start();
    include 'mysql.php';

    $user = $_SESSION['username'];
    $tile = $_POST['tile'];
    $colour = $_POST['colour'];
    $roof_shape = $_POST['roof_shape'];
    $roof_area = $_POST['roof_area'];
    $ridge_length = $_POST['ridge_length']; 
    $ridge_tightening_material = $_POST['ridge_tightening_material'];
    $verge_material = $_POST['verge_material'];
    $verge_length = $_POST['verge_length'];
    $underlayer = $_POST['underlayer'];

    if ($roof_area == '') {
        $roof_area = '0';
    } 
    if ($ridge_length == '') {
        $ridge_length = '0';
    }
    if ($verge_length == '') {
        $verge_length = '0';
    }

    $query="INSERT INTO maara_laskennat(tekija, pvm, tiili, vari, katonmuoto, kattoneliot, harjan_pituus, harjatiiviste, paatymateriaali, paatyjen_pituus, aluskate) 
    values('$user', DATE_ADD(now(), INTERVAL 9 HOUR), '$tile', '$colour', '$roof_shape', '$roof_area', '$ridge_length', '$ridge_tightening_material', '$verge_material', '$verge_length', '$underlayer')";
    mysqli_query($con, $query) or die(mysqli_error($con));
?>
