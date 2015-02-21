<?php
    session_start();
    include 'scripts/mysql.php'; 

    $id = 0;
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/main_table.css">
    </head>
    <body>  
        <table id="main_table">
                <tr>
                <th>Tuotenumero</th>
                <th>Tuote</th>  
                <th>Määrä</th>
                <th>Hinta</th> 
                <th>Yksikkö hinta</th>
                <th>Paino</th> 
                <th>Yksikkö paino</th>  
                <th></th>    
            </tr>
            <?php 
                foreach ($xml -> children() as $category) {
            ?>
            <tr>
                <td colspan="7" id="product_category"><?php echo $category['kategoria']; ?></td>
            </tr>
                <?php 
                    foreach ($category -> children() as $product) {
                        $id++;

                        $product_id = $product['tuotenumero'];
                        $product_name = $product['nimi'];

                        $query = "SELECT DISTINCT * FROM tuotteet WHERE tuotenumero = '$product_id'";
                        $sql_result = mysqli_query($con, $query) or die(mysqli_error($con));
                            
                        while($row = mysqli_fetch_array($sql_result)) {
                            $amount_id = "A" . $id;
                            $calc_price_id = "B" . $id; 
                            $price_id = "C" . $id;
                            $calc_weight_id = "D" . $id;
                            $price_formula = $amount_id . "*" . $price_id . "*((100-F1)/100)";
                            $weight_id = "E" . $id;             
                            $weight_formula = $amount_id . "*" . $weight_id;
                ?>
            <tr>
                <td><?php echo $product_id ?></td>
                <td><?php echo $product_name; ?></td> 
                <td><input data-cell="<?php echo $amount_id; ?>"></input></td>
                <td data-cell="<?php echo $calc_price_id; ?>" data-formula="<?php echo $price_formula; ?>" data-format="0[.]00"></td>
                <td data-cell="<?php echo $price_id; ?>" data-format="0[.]00"><?php echo $row['hinta']; ?></td> 
                <td data-cell="<?php echo $calc_weight_id; ?>" data-formula="<?php echo $weight_formula; ?>" data-format="0[.]00"></td>
                <td data-cell="<?php echo $weight_id; ?>" data-format="0[.]00"><?php echo $row['paino']; ?></td>
                <?php if ($id == 1) { ?>
                    <td id="side_area" rowspan="100"><?php include 'php/side_area.php'; ?></td>
                <?php }?> 
            </tr>
            <?php 
                        }
                    } 
                }
            ?>
            <tr>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Yhteensä:</td>
                <td data-cell="G1" data-formula="SUM(B1:B100)" data-format="€ 0[.]00"></td>
                <td></td>
                <td data-cell="G2" data-formula="SUM(D1:D100)" data-format="0[.]00"></td>
                <td></td>
            </tr>
        </table>
    </body>
</html>
