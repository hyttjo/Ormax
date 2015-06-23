<?php
    include("pChart/class/pData.class.php");
    include("pChart/class/pDraw.class.php");
    include("pChart/class/pImage.class.php");

    $pChart = new pData();
    $pChart->addPoints(array($result_00_10[0],
	                         $result_11_14[0],
	                         $result_15_19[0],
	                         $result_20_27[0],
	                         $result_22100_22950[0],
	                         $result_28_29[0],
	                         $result_30_32[0],
	                         $result_33_39[0],
	                         $result_40_44[0],
	                         $result_45_47[0],
	                         $result_48_49[0],
	                         $result_50_52[0],
	                         $result_53_56[0],
	                         $result_57_59[0],
	                         $result_60_64[0],
	                         $result_65_66[0],
	                         $result_67_69[0],
	                         $result_70_75[0],
	                         $result_76_79[0],
	                         $result_80_83[0],
	                         $result_84_86[0],
	                         $result_87_89[0],
	                         $result_90_93[0],
	                         $result_94_95[0],
	                         $result_96_99[0]),"Serie1");
    $pChart->setSerieDescription("Serie1","Serie 1");
    $pChart->setSerieOnAxis("Serie1",0);

    $pChart->addPoints(array("00-10",
	                         "11-14",
	                         "15-19",
	                         "20-27",
	                         "22-23",
	                         "28-29",
	                         "30-32",
	                         "33-39",
	                         "40-44",
	                         "45-47",
	                         "48-49",
	                         "50-52",
	                         "53-56",
	                         "57-59",
	                         "60-64",
	                         "65-66",
	                         "67-69",
	                         "70-75",
	                         "76-79",
	                         "80-83",
	                         "84-86",
	                         "87-89",
	                         "90-93",
	                         "94-95",
	                         "96-99"),"Absissa");

    $pChart->setAbscissa("Absissa");

    $pChart->setAxisPosition(0,AXIS_POSITION_LEFT);
    $pChart->setAxisName(0,"Kappalemäärä / postinumeroalue");
    $pChart->setAxisUnit(0,"");

    $pChartPicture = new pImage(250,450,$pChart);
    $Settings = array("R"=>255, "G"=>255, "B"=>255);
    $pChartPicture->drawFilledRectangle(0,0,250,450,$Settings);

    $pChartPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>20));

    $pChartPicture->setFontProperties(array("FontName"=>"pChart/fonts/arial.ttf","FontSize"=>14));
    $TextSettings = array("Align"=>TEXT_ALIGN_TOPMIDDLE
    , "R"=>0, "G"=>0, "B"=>0);
    $pChartPicture->drawText(125,5,"Valmiit tarjoukset",$TextSettings);
    $pChartPicture->drawText(125,22,"postinumeroalueittain",$TextSettings);

    $pChartPicture->setShadow(FALSE);
    $pChartPicture->setGraphArea(40,70,243,440);
    $pChartPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>"pChart/fonts/arial.ttf","FontSize"=>8));

    $Settings = array("Pos"=>SCALE_POS_TOPBOTTOM
    , "Mode"=>SCALE_MODE_START0
    , "LabelingMethod"=>LABELING_ALL
    , "GridR"=>255, "GridG"=>255, "GridB"=>255, "GridAlpha"=>50, "TickR"=>0, "TickG"=>0, "TickB"=>0, "TickAlpha"=>50, "LabelRotation"=>0, "CycleBackground"=>1, "DrawXLines"=>1, "DrawSubTicks"=>1, "SubTickR"=>255, "SubTickG"=>0, "SubTickB"=>0, "SubTickAlpha"=>50, "DrawYLines"=>ALL);
    $pChartPicture->drawScale($Settings);

    $pChartPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>10));

    $Config = array("DisplayValues"=>1, "Gradient"=>1, "AroundZero"=>1);
    $pChartPicture->drawBarChart($Config);

    $pChartPicture->render("pdfs_postal_area_chart.png");
?>

