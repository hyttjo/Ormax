<?php
    session_start();
    include 'scripts/mysql.php'; 

    $id = 0;
?>

<html>
    <body>  
        <table id="main_table">
             <tr>
                <th class="A">Tuotenumero</th>
                <th class="B">Tuote</th>  
                <th class="C">Määrä</th>
                <th class="D">Hinta</th> 
                <th class="E">Yksikkö hinta</th>
                <th class="F">Paino</th> 
                <th class="G">Yksikkö paino</th>  
                <th class="H"></th>    
            </tr>
            <?php 
            foreach ($xml_products -> Tuotteet as $products) {
                foreach ($products -> children() as $category) {
                    $category_name = $category['kategoria'];
            ?>
            <tr>
                <td class="product_cat" colspan="3" id="product_category"><?php echo $category_name; ?></td>
            </tr>
                <?php 
                    foreach ($category -> children() as $product) {
                        $id++;

                        $product_id = $product['tuotenumero'];
                        $product_name = $product['nimi'];

                        $query = "SELECT DISTINCT * FROM tuotteet WHERE tuotenumero = '$product_id'";
                        $sql_result = mysqli_query($con, $query) or die(mysqli_error($con));
                            
                        while($row = mysqli_fetch_array($sql_result)) {
                            $amount_id = "C" . $id;
                            $calc_price_id = "D" . $id; 
                            $price_id = "E" . $id;
                            $calc_weight_id = "F" . $id;

                            if($category_name == 'Lavat') {
                                $price_formula = $amount_id . "*" . $price_id; 
                            } else {
                                $price_formula = $amount_id . "*" . $price_id . "*((100-H1)/100)";   
                            }
                            $weight_id = "G" . $id;

                            if ($category_name != 'Kattotiilet') {           
                                $weight_formula = $amount_id . "*" . $weight_id;
                            }

                            $input_product_class = str_replace(" ", "_", $product_name);
                            $input_product_class = str_replace(".", "", $input_product_class);
                            $input_product_class = str_replace(",", "", $input_product_class);
                ?>
            <tr>
                <td class="A product"><?php echo $product_id ?></td>
                <td class="B product"><a href="#"><?php echo $product_name; ?><img src="img/icons/information_icon.png" alt="product_info"></img></a></td> 
                <td class="C product"><input class="<?php echo $category_name . " " . $input_product_class; ?> product_input" data-cell="<?php echo $amount_id; ?>" min="0" max="999999" type="number"></input></td>
                <td class="D product" data-cell="<?php echo $calc_price_id; ?>" data-formula="<?php echo $price_formula; ?>" data-format="0[.]00"></td>
                <td class="E product" data-cell="<?php echo $price_id; ?>" data-format="0[.]00"><?php echo $row['hinta']; ?></td> 
                <td class="F product <?php echo $category_name; ?>" data-cell="<?php echo $calc_weight_id; ?>" data-formula="<?php echo $weight_formula; ?>" data-format="0[.]00"></td>
                <td class="G product" data-cell="<?php echo $weight_id; ?>" data-format="0[.]00"><?php echo $row['paino']; ?></td>
                <?php if ($id == 1) { ?>
                    <td class="H" id="side_area" rowspan="100"><?php include 'php/side_area.php'; ?></td>
                <?php }?> 
            </tr>
            <?php 
                        }
                    } 
                }
            }
            ?>
            <tr id="last_row">
                <td class="A"></td>
                <td class="B"></td>
                <td class="C">Yhteensä:</td>
                <td class="D" data-cell="D100" data-formula="SUM(D1:D99)" data-format="0[.]00 $"></td>
                <td class="E"></td>
                <td class="F" data-cell="F100" data-formula="SUM(F1:F99)" data-format="0[.]00"></td>
                <td class="G"></td>
            </tr>
        </table>
    </body>
</html>
