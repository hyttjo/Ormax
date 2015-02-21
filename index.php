<?php
    $xml = simplexml_load_file("xml\ormax.xml") or die("XML tiedostoa ei pysty lukemaan");
?>

<!DOCTYPE html>

<html class="no-js" lang="fi">
    <head>
        <meta charset="utf-8">

        <title>Ormax Monier Oy - Hinnastolaskenta 2015</title>

        <link rel="stylesheet" type="text/css" href="css/style.css">

        <script src="js/libs/jquery-2.1.3.min.js"></script>
        <script src="js/libs/numeral.min.js"></script>
        <script src="js/libs/jquery-calx-2.0.5.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <header>
        </header>
        <div id="ormax_laskentataulukko" class="container">
            <img class="ormax_logo" src="img/ormax_logo.png" alt="Ormax tiilikatot logo"></img>
            <div class="hinnasto_teksti">Hinnastolaskenta 2015</div>
            <div class="tiiliteksti">Ormax-betonikattotiili</div>
            <table class="taulukko"> 
                <tr class="teksti_valkoinen">
                    <th id="taulukko_otsikot" class="tuotenumero taulukko_otsikko gradient_punainen">Tuotenumero</th>
                    <th class="tuotenimi taulukko_otsikko gradient_punainen">Tuote</th>  
                    <th class="maara taulukko_otsikko gradient_punainen">M&auml;&auml;r&auml;</th>
                    <th class="hinta taulukko_otsikko gradient_punainen">Hinta &euro;</th> 
                    <th class="yksikko_hinta taulukko_otsikko gradient_punainen">Yksikk&ouml; hinta</th>
                    <th class="paino taulukko_otsikko gradient_punainen">Paino<br>&#40;kg&#41;</th> 
                    <th class="yksikko_paino taulukko_otsikko gradient_punainen">Yksikk&ouml; paino</th>      
                </tr>

                @{
                    var id = 0;

                    foreach(var kategoria in ormax_tuotteet.Root.Elements("Kategoria"))
                    {
                        var tuote_ryhma = kategoria.Attribute("kategoria").Value;

                        <tr>
                            <td colspan="7" class="tuoteryhma">@tuote_ryhma</td>
                        </tr>

                        foreach (var tuote in kategoria.Descendants()) 
                        {
                            id++;

                            var tuotenumero = tuote.Attribute("tuotenumero").Value;
                            var tuotenimi = tuote.Attribute("nimi").Value;
                
                            foreach (var tuote_sql in db.Query("SELECT DISTINCT * FROM tuotteet WHERE tuotenumero = @0", tuotenumero))
                            {
                                var maara_solu_id = "A" + id.ToString();
                                var laskettu_hinta_id = "B" + id.ToString();
                                var hinta_solu_id = "C" + id.ToString();
                                var laskettu_hinta = maara_solu_id + "*" + hinta_solu_id + "*((100-F1)/100)";
                                var laskettu_paino_id = "D" + id.ToString(); 
                                var paino_solu_id = "E" + id.ToString();
                                var laskettu_paino = maara_solu_id + "*" + paino_solu_id;

                                <tr class="tuote_rivi">
                                    <td class="tuotenumero taulukko_solu" >@tuotenumero</td>
                                    <td class="tuotenimi taulukko_solu">@tuotenimi</td> 
                                    <td class="maara taulukko_solu"><input data-cell=@maara_solu_id class="maara input"/></td>
                                    <td class="hinta taulukko_solu" style="text-overflow:clip" data-cell=@laskettu_hinta_id data-formula=@laskettu_hinta data-format="0[.]00"></td>
                                    <td class="yksikko_hinta taulukko_solu" data-cell=@hinta_solu_id data-format="0[.]00">@tuote_sql.hinta.ToString().Replace(",", ".")</td> 
                                    <td class="paino taulukko_solu" data-cell=@laskettu_paino_id data-formula=@laskettu_paino data-format="0[.]00"></td>
                                    <td class="yksikko_paino taulukko_solu" data-cell=@paino_solu_id data-format="0[.]00">@tuote_sql.paino.ToString().Replace(",", ".")</td> 
                                </tr>
                            }
                        }
                    }
                }
                <tr>
                    <td colspan="7" class="taulukko_alarivi"></td>
                </tr>
                <tr class="taulukko_alarivi">
                    <td class="tuotenumero gradient_harmaa"></td>
                    <td class="tuotenimi gradient_harmaa"></td>
                    <td class="maara yhteensa vasen_kehys gradient_harmaa teksti_tumma">Yhteens&auml;:</td>
                    <td class="hinta yhteensa oikea_kehys gradient_harmaa teksti_tumma" data-cell="G1" data-formula="SUM(B1:B100)" data-format="€ 0[.]00"></td>
                    <td class="yksikko_hinta gradient_harmaa"></td>
                    <td class="paino yhteensa gradient_harmaa teksti_tumma" data-cell="G2" data-formula="SUM(D1:D100)" data-format="0[.]00"></td>
                    <td class="yksikko_paino gradient_harmaa"></td>
                </tr>
            </table>
        </div>

        <footer>
        </footer>
    </body>
</html>