<?php
    session_start();

    include("../mysql.php");
    
    $color_range = array(200, 20, 0, 250, 250, 250);

    $result_total_count = mysqli_query($con, "SELECT COUNT(postinumero) FROM valmiit_laskennat") or die(mysqli_error($con));
    $total_count_array = mysqli_fetch_array($result_total_count);
    $total_count = $total_count_array[0];
    
    $result_00_10 = get_area_results($con, '00000', '10999', $total_count);
    $result_11_14 = get_area_results($con, '11000', '14999', $total_count);
    $result_15_19 = get_area_results($con, '15000', '19999', $total_count);
    $result_20_21099 = get_area_results($con, '20000', '21099', $total_count);
    $result_22951_27 = get_area_results($con, '22951', '27999', $total_count);
    $result_20_27 = array($result_20_21099[0] + $result_22951_27[0], $result_20_21099[1] + $result_22951_27[1]);
    $result_22100_22950 = get_area_results($con, '22100', '22950', $total_count);
    $result_28_29 = get_area_results($con, '28000', '29999', $total_count);
    $result_30_32 = get_area_results($con, '30000', '32999', $total_count);
    $result_33_39 = get_area_results($con, '33000', '39999', $total_count);
    $result_40_44 = get_area_results($con, '40000', '44999', $total_count);
    $result_45_47 = get_area_results($con, '45000', '47999', $total_count);
    $result_48_49 = get_area_results($con, '48000', '49999', $total_count);
    $result_50_52 = get_area_results($con, '50000', '52999', $total_count);
    $result_53_56 = get_area_results($con, '53000', '56999', $total_count);
    $result_57_59 = get_area_results($con, '57000', '59999', $total_count);
    $result_60_64 = get_area_results($con, '60000', '64999', $total_count);
    $result_65_66 = get_area_results($con, '65000', '66999', $total_count);
    $result_67_69 = get_area_results($con, '67000', '69999', $total_count);
    $result_70_75 = get_area_results($con, '70000', '75999', $total_count);
    $result_76_79 = get_area_results($con, '76000', '79999', $total_count);
    $result_80_83 = get_area_results($con, '80000', '83999', $total_count);
    $result_84_86 = get_area_results($con, '84000', '86999', $total_count);
    $result_87_89 = get_area_results($con, '87000', '89999', $total_count);
    $result_90_93 = get_area_results($con, '90000', '93999', $total_count);
    $result_94_95 = get_area_results($con, '94000', '95999', $total_count);
    $result_96_99 = get_area_results($con, '96000', '99999', $total_count);

    $area_results = array($result_00_10, 
                          $result_11_14, 
                          $result_15_19, 
                          $result_20_27, 
                          $result_22100_22950,
                          $result_28_29,
                          $result_30_32,
                          $result_33_39,
                          $result_40_44,
                          $result_45_47,
                          $result_48_49,
                          $result_50_52,
                          $result_53_56,
                          $result_57_59,
                          $result_60_64,
                          $result_65_66,
                          $result_67_69,
                          $result_70_75,
                          $result_76_79,
                          $result_80_83,
                          $result_84_86,
                          $result_87_89,
                          $result_90_93,
                          $result_94_95,
                          $result_96_99
                          );

    $min_max_counts = get_min_max_counts($area_results, $total_count);

    function get_area_results($con, $lowerbound, $upperbound, $total_count) {
        $query = "SELECT COUNT(postinumero) FROM valmiit_laskennat WHERE postinumero BETWEEN $lowerbound AND $upperbound";
        
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $area_count = mysqli_fetch_array($result);
        $area_percent = round($area_count[0] / $total_count * 100);

        return array($area_count[0], $area_percent);
    }

    function get_min_max_counts($areas, $total_count) {
        $temp_min = $total_count;
        $temp_max = 0;

        for ($i = 0; $i < count($areas); $i++) {
            if ($areas[$i][0] < $temp_min) {
                $temp_min = $areas[$i][0];
            }
            if ($areas[$i][0] > $temp_max) {
                $temp_max = $areas[$i][0];
            }
        }
        return array($temp_min, $temp_max);
    }
?>