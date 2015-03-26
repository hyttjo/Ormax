<?php
    session_start();
    include 'mysql.php';

    $postal_code = $_POST['postal_code'];
    $product_price = $_POST['product_price'];
    $tile_amount = $_POST['tile_amount'];
    $other_product_weight = $_POST['other_product_weight'];
    $pallet_amount = $_POST['pallet_amount']; 
    $pallet_size = $_POST['pallet_size'];
    $lift_true_false = $_POST['lift'];

    $tiles_delivery_cost = 0;
    $other_product_delivery_cost = 0;
    $insurance = 0;
    $packaging_cost = 0;
    $can_lift_to_roof; 
    $lift_to_roof = 0;

    $weight_range = '0-50';

    if ($other_product_weight > 51)
        $weight_range = '50-100';
    if ($other_product_weight > 101)
        $weight_range = '100-200';
    if ($other_product_weight > 201)
        $weight_range = '200-300';
    if ($other_product_weight > 301)
        $weight_range = '300-400';
    if ($other_product_weight > 401)
        $weight_range = '400-700';
    if ($other_product_weight > 701)
        $weight_range = '700-1000';

    $user = $_SESSION['username'];
    $query = "SELECT * FROM kayttajat WHERE nimi = '$user'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
    $nimi = $row["nimi"];
    $query="UPDATE kayttajat SET laskentakerrat = laskentakerrat + 1, viimeksikaynyt = DATE_ADD(now(), INTERVAL 9 HOUR) WHERE nimi='$nimi'";
    mysqli_query($con, $query) or die(mysqli_error($con));

    $query="SELECT * FROM osoitteisto WHERE postinumero = '$postal_code'";

    $delivery_result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($delivery_result)) { 
        if ($row) {
            $city = $row['kunta'];
            $delivery_area = $row['rahtihinta'];
            $can_lift_to_roof = $row['katollenosto']; 
        }
    }

    if ($tile_amount == 0 && $other_product_weight > 0) {
        $query="SELECT * FROM rahtitaulukko WHERE rahtialue = '$delivery_area'";
        $other_product_delivery_result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($other_product_delivery_result)) { 
            $other_product_delivery_cost = $row[$weight_range];  
        }
    } else if ($tile_amount > 0 && $tile_amount < 1000) {
        $tiles_delivery_cost = $delivery_area;
    } else {
        $tiles_delivery_cost = $tile_amount * $delivery_area / 1000;
    }

    $packaging_cost_true = $other_product_delivery_cost + $tiles_delivery_cost;

    if ($pallet_amount == 0 && $packaging_cost_true != 0) {
        $packaging_cost = 17;
    }

    $insurance = $product_price * 0.008;

    if ($lift_true_false == 'Kyllä') {
        if ($tile_amount < $pallet_size * 4) {
            $tile_amount = $pallet_size * 4;
        }
        $lift_to_roof = $tile_amount / 1000 * 149;
    }

    $delivery_cost = number_format($tiles_delivery_cost + $other_product_delivery_cost + $insurance + $packaging_cost + $lift_to_roof, 2);

    if($can_lift_to_roof == null && $lift_true_false == 'Kyllä') {
        $fail_message = 'Katolle nosto ei mahdollista kyseiselle postinumeroalueelle.';
    }

    if($delivery_area == null) {
        $fail_message = 'Postinumerolle ei ole määritelty rahtihintaa, kokeile toista postinumeroa.';
    }

    if($city == null) {
        $fail_message = 'Postinumerolla ei löydy kuntaa.';
    }

    echo json_encode(array(
        $fail_message,
        $city, 
        $delivery_cost, 
        $tiles_delivery_cost, 
        $other_product_delivery_cost, 
        $insurance, 
        $packaging_cost, 
        $lift_to_roof, 
        $delivery_area, 
        $tile_amount,
        $weight_range,
        $pallet_amount,
        $product_price,
        $can_lift_to_roof));
?>