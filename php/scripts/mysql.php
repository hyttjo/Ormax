<?php
$q = intval($_GET['q']);

$con = mysqli_connect('mysql1.gear.host','ormax','monier!','Ormax');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"Ormax");
$sql="SELECT * FROM osoitteisto WHERE postinumero = '".$q."'";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {
    echo $row['kunta'] . '+' . $row['rahtihinta'];
}

mysqli_close($con);
?>