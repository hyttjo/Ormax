<?php
    session_start();
    include 'mysql.php';
    
    $username = str_replace("'", "", $_POST["username"]);
    $password = str_replace("'", "", $_POST["password"]);
    
    $query = "SELECT * FROM kayttajat WHERE nimi = '$username' AND salasana = '$password'";
    
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);

    $num_rows = mysqli_num_rows($result);
    
    if($num_rows == 1) {
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $row["nimi"];
        header('Location: ../../index.php');
    } else {
        header('Location: ../login.php?failed');
    }
?>