<?php
    $con = mysqli_connect('mysql1.gear.host','ormax','monier!','Ormax');

    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
?>