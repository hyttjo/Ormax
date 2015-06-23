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

    $query = "SELECT * FROM `maara_laskennat` ORDER BY `id` DESC LIMIT 1";
    $last_result = mysqli_query($con, $query) or die(mysqli_error($con));
    $lr_row = mysqli_fetch_array($last_result);
    
    if (mysqli_num_rows($last_result) == 1) {
        if ($user != $lr_row["tekija"] || 
            $tile != $lr_row["tiili"] || 
            $colour != $lr_row["vari"] || 
            $roof_shape != $lr_row["katonmuoto"] || 
            $roof_area != $lr_row["kattoneliot"] ||
            $ridge_length != $lr_row["harjan_pituus"] ||
            $ridge_tightening_material != $lr_row["harjatiiviste"] ||
            $verge_material != $lr_row["paatymateriaali"] ||
            $verge_length != $lr_row["paatyjen_pituus"] ||
            $underlayer != $lr_row["aluskate"]) {
                $query="INSERT INTO maara_laskennat(tekija, pvm, tiili, vari, katonmuoto, kattoneliot, harjan_pituus, harjatiiviste, paatymateriaali, paatyjen_pituus, aluskate) 
                values('$user', DATE_ADD(now(), INTERVAL 9 HOUR), '$tile', '$colour', '$roof_shape', '$roof_area', '$ridge_length', '$ridge_tightening_material', '$verge_material', '$verge_length', '$underlayer')";
                mysqli_query($con, $query) or die(mysqli_error($con));
        }
    }
?>
