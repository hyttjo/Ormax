<?php
    $area_00_10 = get_00_10_area();
    $area_11_14 = get_11_14_area();
    $area_15_19 = get_15_19_area();
    $area_20_27 = get_20_27_area();
    $area_22100_22950 = get_22100_22950_area();
    $area_28_29 = get_28_29_area();
    $area_30_32 = get_30_32_area();
    $area_33_39 = get_33_39_area();
    $area_40_44 = get_40_44_area();
    $area_45_47 = get_45_47_area();
    $area_48_49 = get_48_49_area();
    $area_50_52 = get_50_52_area();
    $area_53_56 = get_53_56_area();
    $area_57_59 = get_57_59_area();
    $area_60_64 = get_60_64_area();
    $area_65_66 = get_65_66_area();
    $area_67_69 = get_67_69_area();
    $area_70_75 = get_70_75_area();
    $area_76_79 = get_76_79_area();
    $area_80_83 = get_80_83_area();
    $area_84_86 = get_84_86_area();
    $area_87_89 = get_87_89_area();
    $area_90_93 = get_90_93_area();
    $area_94_95 = get_94_95_area();
    $area_96_99 = get_96_99_area();

    $map = imagecreatetruecolor(444, 804);
    $background = imagecolorallocate($map, 255, 255, 255);
    imagecolortransparent($map, $background);
    imagefill($map, 0, 0, $background);
    $border_colour = imagecolorallocate($map, 100, 100, 100);
    $text_colour = imagecolorallocate($map, 0, 0, 0);
    $text_size = 14;

	fill_postal_area($map, $area_00_10, get_area_color($map, $color_range, $result_00_10[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_11_14, get_area_color($map, $color_range, $result_11_14[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_15_19, get_area_color($map, $color_range, $result_15_19[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_20_27, get_area_color($map, $color_range, $result_20_27[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_22100_22950, get_area_color($map, $color_range, $result_22100_22950[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_28_29, get_area_color($map, $color_range, $result_28_29[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_30_32, get_area_color($map, $color_range, $result_30_32[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_33_39, get_area_color($map, $color_range, $result_33_39[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_40_44, get_area_color($map, $color_range, $result_40_44[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_45_47, get_area_color($map, $color_range, $result_45_47[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_48_49, get_area_color($map, $color_range, $result_48_49[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_50_52, get_area_color($map, $color_range, $result_50_52[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_53_56, get_area_color($map, $color_range, $result_53_56[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_57_59, get_area_color($map, $color_range, $result_57_59[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_60_64, get_area_color($map, $color_range, $result_60_64[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_65_66, get_area_color($map, $color_range, $result_65_66[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_67_69, get_area_color($map, $color_range, $result_67_69[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_70_75, get_area_color($map, $color_range, $result_70_75[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_76_79, get_area_color($map, $color_range, $result_76_79[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_80_83, get_area_color($map, $color_range, $result_80_83[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_84_86, get_area_color($map, $color_range, $result_84_86[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_87_89, get_area_color($map, $color_range, $result_87_89[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_90_93, get_area_color($map, $color_range, $result_90_93[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_94_95, get_area_color($map, $color_range, $result_94_95[0], $min_max_counts[0], $min_max_counts[1]));
	fill_postal_area($map, $area_96_99, get_area_color($map, $color_range, $result_96_99[0], $min_max_counts[0], $min_max_counts[1]));

	draw_postal_area_borders($map, $area_00_10, $border_colour);
	draw_postal_area_borders($map, $area_11_14, $border_colour);
	draw_postal_area_borders($map, $area_15_19, $border_colour);
	draw_postal_area_borders($map, $area_20_27, $border_colour);
	draw_postal_area_borders($map, $area_22100_22950, $border_colour);
	draw_postal_area_borders($map, $area_28_29, $border_colour);
	draw_postal_area_borders($map, $area_30_32, $border_colour);
	draw_postal_area_borders($map, $area_33_39, $border_colour);
	draw_postal_area_borders($map, $area_40_44, $border_colour);
	draw_postal_area_borders($map, $area_45_47, $border_colour);
	draw_postal_area_borders($map, $area_48_49, $border_colour);
	draw_postal_area_borders($map, $area_50_52, $border_colour);
	draw_postal_area_borders($map, $area_53_56, $border_colour);
	draw_postal_area_borders($map, $area_57_59, $border_colour);
	draw_postal_area_borders($map, $area_60_64, $border_colour);
	draw_postal_area_borders($map, $area_65_66, $border_colour);
	draw_postal_area_borders($map, $area_67_69, $border_colour);
	draw_postal_area_borders($map, $area_70_75, $border_colour);
	draw_postal_area_borders($map, $area_76_79, $border_colour);
	draw_postal_area_borders($map, $area_80_83, $border_colour);
	draw_postal_area_borders($map, $area_84_86, $border_colour);
	draw_postal_area_borders($map, $area_87_89, $border_colour);
	draw_postal_area_borders($map, $area_90_93, $border_colour);
	draw_postal_area_borders($map, $area_94_95, $border_colour);
	draw_postal_area_borders($map, $area_96_99, $border_colour);

	print_postal_area_text($map, $area_00_10, $result_00_10[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_11_14, $result_11_14[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_15_19, $result_15_19[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_20_27, $result_20_27[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_22100_22950, $result_22100_22950[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_28_29, $result_28_29[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_30_32, $result_30_32[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_33_39, $result_33_39[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_40_44, $result_40_44[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_45_47, $result_45_47[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_48_49, $result_48_49[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_50_52, $result_50_52[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_53_56, $result_53_56[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_57_59, $result_57_59[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_60_64, $result_60_64[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_65_66, $result_65_66[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_67_69, $result_67_69[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_70_75, $result_70_75[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_76_79, $result_76_79[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_80_83, $result_80_83[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_84_86, $result_84_86[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_87_89, $result_87_89[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_90_93, $result_90_93[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_94_95, $result_94_95[1] . '%', $text_colour, $text_size);
	print_postal_area_text($map, $area_96_99, $result_96_99[1] . '%', $text_colour, $text_size);

    print_city($map, array(210,765), 'Helsinki', array(230,770), $text_colour, $text_size);
    print_city($map, array(100,740), 'Turku', array(85,760), $text_colour, $text_size);
    print_city($map, array(210,390), 'Oulu', array(200,370), $text_colour, $text_size);
    print_city($map, array(150,660), 'Tampere', array(167,655), $text_colour, $text_size);
    print_city($map, array(240,600), 'Jyväskylä', array(155,600), $text_colour, $text_size);
    print_city($map, array(80,540), 'Vaasa', array(70,520), $text_colour, $text_size);
    print_city($map, array(270,550), 'Kuopio', array(230,530), $text_colour, $text_size);
    print_city($map, array(370,560), 'Joensuu', array(355,575), $text_colour, $text_size);
    print_city($map, array(290,450), 'Kajaani', array(310,450), $text_colour, $text_size);
    print_city($map, array(230,260), 'Rovaniemi', array(220,240), $text_colour, $text_size);

    imagepng($map, 'pdfs_delivery_map.png');
    imagedestroy($map);
    
    function fill_postal_area($image, $postal_area, $area_colour) {
        imagefilledpolygon($image, $postal_area, count($postal_area) / 2, $area_colour);   
    }

    function draw_postal_area_borders($image, $postal_area, $border_colour) {
        $length = count($postal_area) / 2;
        
        for ($i = 0; $i < $length; $i++) {
            if ($i == ($length - 1)) {
                imageline($image, $postal_area[$i * 2], $postal_area[$i * 2 + 1], $postal_area[0], $postal_area[1], $border_colour);
            } else {
                imageline($image, $postal_area[$i * 2], $postal_area[$i * 2 + 1], $postal_area[$i * 2 + 2], $postal_area[$i * 2 + 3], $border_colour);   
            }
        }
    }

    function print_postal_area_text($image, $postal_area, $text, $text_colour, $text_size) {
        $center_point = get_area_center($postal_area);
        imagettftext($image, $text_size, 0, $center_point[0] - $text_size / 2, $center_point[1] + $text_size / 2, -$text_colour, "ARIAL", $text);
    }

    function print_city($image, $city_coord, $city_name, $name_coord, $text_colour, $text_size) {
        imagefilledellipse($image, $city_coord[0], $city_coord[1], $text_size, $text_size, $text_colour);
        imagettftext($image, $text_size, 0, $name_coord[0] - $text_size / 2, $name_coord[1] + $text_size / 2, -$text_colour, "ARIAL", $city_name);
    }

    function get_area_color($image, $color_range, $area_count, $min_count, $max_count) {
        $count_difference = $max_count - $min_count;
        $area_delta = $area_count / $count_difference;

        $r_difference = $color_range[3] - $color_range[0];
        $g_difference = $color_range[4] - $color_range[1];
        $b_difference = $color_range[5] - $color_range[2];

        $r = $color_range[3] - $r_difference * $area_delta;
        $g = $color_range[4] - $g_difference * $area_delta;
        $b = $color_range[5] - $b_difference * $area_delta;

        return imagecolorallocate($image, round($r), round($g), round($b));
    }

    function get_random_colour($image) {
        return imagecolorallocate($image, rand(40, 255), rand(40, 255), rand(40, 255));
    }

    function get_area_center($area) {
        $x_coord_sum;
        $y_coord_sum;

        for ($i = 0; $i < count($area); $i++) {
            if ($i % 2 == 0) {
                $x_coord_sum += $area[$i];
            } else {
                $y_coord_sum += $area[$i];
            }
        }
        return array($x_coord_sum / (count($area) / 2), $y_coord_sum / (count($area) / 2)); 
    }

    function get_00_10_area() { 
        return array(
            230,760,
            190,770,
            140,790,
            130,770,
            170,740,
            180,730,
            200,730,
            210,720,
            250,720,
            260,740
        );
    } 

	function get_11_14_area() { 
        return array(
            170,710,
            170,690,
            200,680,
            210,720,
            200,730,
            180,730
        ); 
    } 

	function get_15_19_area() {
        return array(
            260,670,
            250,690,
            250,720,
            210,720,
            200,680,
            200,630,
            240,640
        );
    }

	function get_20_27_area() {
        return array(
            130,770,
            120,750,
            80,730,
            80,710,
            90,680,
            110,680,
            130,720,
            170,740
        );
    }

	function get_22100_22950_area() {
        return array(
            30,740,
            40,750,
            40,770,
            30,770,
            20,760,
            10,760,
            10,750
        );
    }

	function get_28_29_area() {
        return array(
            90,680,
            80,660,
            80,630,
            110,620,
            120,670,
            110,680
        );
    }
	
	function get_30_32_area() {
        return array(
            150,730,
            130,720,
            120,700,
            110,680,
            120,670,
            170,690,
            170,710,
            180,730,
            170,740
        );
    }

	function get_33_39_area() {
        return array(
            200,680,
            170,690,
            120,670,
            110,620,
            130,600,
            150,590,
            160,610,
            190,600,
            200,630
        );
    }

	function get_40_44_area() {
        return array(
            190,520,
            200,490,
            240,500,
            230,530,
            240,550,
            260,610,
            240,620,
            240,640,
            200,630,
            190,600,
            160,610,
            150,590,
            180,570,
            170,540
        );
    }

	function get_45_47_area() {
        return array(
            270,720,
            250,720,
            250,690,
            260,670,
            290,670,
            300,700
        );
    }

	function get_48_49_area() {
        return array(
            290,730,
            260,740,
            250,720,
            270,720,
            300,700,
            330,710,
            320,730
        );
    }

	function get_50_52_area() {
        return array(
            290,670,
            260,670,
            240,640,
            240,620,
            260,610,
            320,620,
            330,650
        );
    }

	function get_53_56_area() {
        return array(
            350,690,
            330,710,
            300,700,
            290,670,
            330,650,
            350,640,
            380,650
        );
    }

	function get_57_59_area() {
        return array(
            390,640,
            380,650,
            350,640,
            330,650,
            320,620,
            320,600,
            350,580,
            400,610
        );
    }

	function get_60_64_area() {
        return array(
            130,600,
            110,620,
            80,630,
            70,590,
            110,580,
            110,550,
            140,520,
            150,510,
            170,520,
            190,520,
            170,540,
            180,570,
            150,590
        );
    }

	function get_65_66_area() {
        return array(
            70,550,
            90,530,
            120,510,
            140,520,
            110,550,
            110,580,
            70,590
        );
    }
	
	function get_67_69_area() {
        return array(
            150,510,
            140,520,
            120,510,
            130,490,
            150,480,
            160,460,
            200,490,
            190,520,
            170,520
        );
    }

	function get_70_75_area() {
        return array(
            340,560,
            280,570,
            240,550,
            230,530,
            240,500,
            250,460,
            270,460,
            380,480,
            360,490,
            340,520,
            360,540
        );
    }

	function get_76_79_area() {
        return array(
            320,600,
            320,620,
            260,610,
            240,550,
            280,570,
            340,560,
            350,580
        );
    }

	function get_80_83_area() {
        return array(
            430,530,
            400,610,
            350,580,
            340,560,
            360,540,
            340,520,
            360,490,
            380,480,
            410,500
        );
    }

	function get_84_86_area() {
        return array(
            240,500,
            200,490,
            160,460,
            190,420,
            230,430,
            250,460
        );
    }

	function get_87_89_area() {
        return array(
            390,430,
            380,480,
            270,460,
            280,430,
            300,410,
            290,370,
            350,340,
            350,390
        );
    }

	function get_90_93_area() {
        return array(
            350,340,
            290,370,
            300,410,
            280,430,
            270,460,
            250,460,
            230,430,
            190,420,
            210,390,
            210,350,
            240,330,
            310,320,
            310,290,
            340,280,
            360,310
        );
    }

    function get_94_95_area() {
        return array(
            210,350,
            180,330,
            160,300,
            160,260,
            150,200,
            180,190,
            200,290,
            230,300,
            240,330
        );
    }

    function get_96_99_area() {
        return array(
            260,10,
            300,40,
            290,120,
            300,150,
            330,170,
            320,240,
            340,280,
            310,290,
            310,320,
            240,330,
            230,300,
            200,290,
            180,190,
            150,200,
            150,170,
            130,150,
            90,120,
            70,90,
            90,70,
            120,110,
            160,110,
            190,120,
            210,70,
            210,50,
            230,20
        );
    }
?>