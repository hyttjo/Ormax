<?php
    include("pChart/class/pData.class.php");
    include("pChart/class/pDraw.class.php");
    include("pChart/class/pImage.class.php");

    $pChart = new pData();
    $pChart->addPoints(array($tile_colour_results[0][0],
                             $tile_colour_results[1][0],
                             $tile_colour_results[2][0],
                             $tile_colour_results[3][0],
                             $tile_colour_results[4][0],
                             $tile_colour_results[5][0],
                             $tile_colour_results[6][0]),"Serie1");
    $pChart->setSerieDescription("Serie1","Savit.");
    $pChart->setSerieOnAxis("Serie1",0);
    $pChart->setPalette("Serie1", array("R"=>246,"G"=>113,"B"=>53,"Alpha"=>100));

    $pChart->addPoints(array($tile_colour_results[0][1],
                             $tile_colour_results[1][1],
                             $tile_colour_results[2][1],
                             $tile_colour_results[3][1],
                             $tile_colour_results[4][1],
                             $tile_colour_results[5][1],
                             $tile_colour_results[6][1]),"Serie2");
    $pChart->setSerieDescription("Serie2","Tupap.");
    $pChart->setSerieOnAxis("Serie2",0);
    $pChart->setPalette("Serie2", array("R"=>211,"G"=>60,"B"=>29,"Alpha"=>100));

    $pChart->addPoints(array($tile_colour_results[0][2],
                             $tile_colour_results[1][2],
                             $tile_colour_results[2][2],
                             $tile_colour_results[3][2],
                             $tile_colour_results[4][2],
                             $tile_colour_results[5][2],
                             $tile_colour_results[6][2]),"Serie3");
    $pChart->setSerieDescription("Serie3","Tummanh.");
    $pChart->setSerieOnAxis("Serie3",0);
    $pChart->setPalette("Serie3", array("R"=>80,"G"=>94,"B"=>97,"Alpha"=>100));

    $pChart->addPoints(array($tile_colour_results[0][3],
                             $tile_colour_results[1][3],
                             $tile_colour_results[2][3],
                             $tile_colour_results[3][3],
                             $tile_colour_results[4][3],
                             $tile_colour_results[5][3],
                             $tile_colour_results[6][3]),"Serie4");
    $pChart->setSerieDescription("Serie4","Harmaa");
    $pChart->setSerieOnAxis("Serie4",0);
    $pChart->setPalette("Serie4", array("R"=>131,"G"=>137,"B"=>129,"Alpha"=>100));

    $pChart->addPoints(array($tile_colour_results[0][4],
                             $tile_colour_results[1][4],
                             $tile_colour_results[2][4],
                             $tile_colour_results[3][4],
                             $tile_colour_results[4][4],
                             $tile_colour_results[5][4],
                             $tile_colour_results[6][4]),"Serie5");
    $pChart->setSerieDescription("Serie5","Musta");
    $pChart->setSerieOnAxis("Serie5",0);
    $pChart->setPalette("Serie5", array("R"=>42,"G"=>43,"B"=>45,"Alpha"=>100));

    $pChart->addPoints(array($tile_colour_results[0][5],
                             $tile_colour_results[1][5],
                             $tile_colour_results[2][5],
                             $tile_colour_results[3][5],
                             $tile_colour_results[4][5],
                             $tile_colour_results[5][5],
                             $tile_colour_results[6][5]),"Serie6");
    $pChart->setSerieDescription("Serie6","Ruskea");
    $pChart->setSerieOnAxis("Serie6",0);
    $pChart->setPalette("Serie6", array("R"=>116,"G"=>82,"B"=>73,"Alpha"=>100));

    $pChart->addPoints(array($tile_colour_results[0][6],
                             $tile_colour_results[1][6],
                             $tile_colour_results[2][6],
                             $tile_colour_results[3][6],
                             $tile_colour_results[4][6],
                             $tile_colour_results[5][6],
                             $tile_colour_results[6][6]),"Serie7");
    $pChart->setSerieDescription("Serie7","Antiikki");
    $pChart->setSerieOnAxis("Serie7",0);
    $pChart->setPalette("Serie7", array("R"=>190,"G"=>93,"B"=>72,"Alpha"=>100));

    $pChart->addPoints(array($tile_colour_results[0][7],
                             $tile_colour_results[1][7],
                             $tile_colour_results[2][7],
                             $tile_colour_results[3][7],
                             $tile_colour_results[4][7],
                             $tile_colour_results[5][7],
                             $tile_colour_results[6][7]),"Serie8");
    $pChart->setSerieDescription("Serie8","Antras.");
    $pChart->setSerieOnAxis("Serie8",0);
    $pChart->setPalette("Serie8", array("R"=>95,"G"=>83,"B"=>84,"Alpha"=>100));

    $pChart->addPoints(array($tile_colour_results[0][8],
                             $tile_colour_results[1][8],
                             $tile_colour_results[2][8],
                             $tile_colour_results[3][8],
                             $tile_colour_results[4][8],
                             $tile_colour_results[5][8],
                             $tile_colour_results[6][8]),"Serie9");
    $pChart->setSerieDescription("Serie9","Tyhjä");
    $pChart->setSerieOnAxis("Serie9",0);
    $pChart->setPalette("Serie9", array("R"=>220,"G"=>220,"B"=>220,"Alpha"=>100));

    $pChart->addPoints(array(get_tile_total_count($tile_colour_results, 0),
                             get_tile_total_count($tile_colour_results, 1),
                             get_tile_total_count($tile_colour_results, 2),
                             get_tile_total_count($tile_colour_results, 3),
                             get_tile_total_count($tile_colour_results, 4),
                             get_tile_total_count($tile_colour_results, 5),
                             get_tile_total_count($tile_colour_results, 6)),"Serie10");
    $pChart->setSerieDrawable("Serie10", FALSE);
    $pChart->setPalette("Serie10", array("Alpha"=>0));

    $pChart->addPoints(array("Ormax", "Protector+", "Minster", "Turmalin", "Granat", "E13", "T11"),"Absissa");
    $pChart->setAbscissa("Absissa");

    $pChart->setAxisPosition(0,AXIS_POSITION_LEFT);
    $pChart->setAxisName(0,"Laskentamäärät kpl");
    $pChart->setAxisUnit(0,"");

    $pChartPicture = new pImage(550,400,$pChart);
    $Settings = array("R"=>255, "G"=>255, "B"=>255);
    $pChartPicture->drawFilledRectangle(0,0,550,400,$Settings);

    $pChartPicture->setFontProperties(array("FontName"=>"pChart/fonts/arial.ttf","FontSize"=>14));
    $TextSettings = array("Align"=>TEXT_ALIGN_BOTTOMMIDDLE, "R"=>0, "G"=>0, "B"=>0);
    $pChartPicture->drawText(275,25,"Valmiit tarjoukset - Tiilet / Värit", $TextSettings);

    $pChartPicture->setGraphArea(50,35,525,345);
    $pChartPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>"pChart/fonts/arial.ttf","FontSize"=>10));

    $Settings = array("Pos"=>SCALE_POS_LEFTRIGHT, "Mode"=>SCALE_MODE_ADDALL_START0, "LabelingMethod"=>LABELING_DIFFERENT, 
    "GridR"=>240, "GridG"=>240, "GridB"=>240, "GridAlpha"=>50, 
    "TickR"=>0, "TickG"=>0, "TickB"=>0, "TickAlpha"=>50, 
    "LabelRotation"=>0, "CycleBackground"=>1, "DrawXLines"=>1, "DrawSubTicks"=>1, 
    "SubTickR"=>255, "SubTickG"=>0, "SubTickB"=>0, "SubTickAlpha"=>50, "DrawYLines"=>ALL);

    $pChartPicture->drawScale($Settings);

    $Config = array("DisplayValues"=>1, "AroundZero"=>1, "Gradient"=>1, "Surrounding"=>-15, "InnerSurrounding"=>15);

    $pChartPicture->drawStackedBarChart($Config);

    $Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>"pChart/fonts/arial.ttf", "FontSize"=>10, 
    "Margin"=>9, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER, "Mode"=>LEGEND_HORIZONTAL);

    $pChartPicture->drawLegend(40, 380, $Config);

    $pChart->setSerieDrawable('Serie10', TRUE);
    $pChart->setSerieDrawable('Serie9', FALSE);
    $pChart->setSerieDrawable('Serie8', FALSE);
    $pChart->setSerieDrawable('Serie7', FALSE);
    $pChart->setSerieDrawable('Serie6', FALSE);
    $pChart->setSerieDrawable('Serie5', FALSE);
    $pChart->setSerieDrawable('Serie4', FALSE);
    $pChart->setSerieDrawable('Serie3', FALSE);
    $pChart->setSerieDrawable('Serie2', FALSE);
    $pChart->setSerieDrawable('Serie1', FALSE);

    $pChartPicture->setGraphArea(50, 30, 525, 340);
    $pChartPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>"pChart/fonts/arialbd.ttf","FontSize"=>10));
    $pChartPicture->drawBarChart(array("DisplayValues" => TRUE, "DisplayColor"=>array('R'=>0, 'G'=>0, 'B'=>0)));

    $pChartPicture->render("pdfs_tile_colour.png");

    function get_tile_total_count($tile_colour_results, $tile) {
        $tile_total = 0;

        for ($i = 0; $i < count($tile_colour_results[$tile]); $i++) {
            $tile_total += $tile_colour_results[$tile][$i];
        }
        return $tile_total;
    }
?>