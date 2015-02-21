<?php

?>

<!DOCTYPE html>

<html lang="fi">
    <body>
        <div id="sivualue_otsikko" class="sivualue_otsikko gradient_punainen"></div>
    
        <div class="sivualue">
            <div class="sivu_laatikko">
                <div class="sivu_otsikko gradient_punainen teksti_valkoinen">Alennusprosentti</div>
                <div class="rivi">
                    <input data-cell="F1" class="input laatikko_keskella" type="number"><b>%</b></input>
                </div>
            </div>

            <div class="sivu_laatikko">
                <div class="sivu_otsikko gradient_punainen teksti_valkoinen">Toimituskustannukset</div>
                <div class="rivi">
                    <p class="teksti_vasemmalla">Postinumero:</p><input id="postinumero" data-cell="F2" class="input input_oikealla" type="text"></input>
                </div>
                <div class="rivi">
                    <p class="teksti_vasemmalla">Kunta:</p><div id="kunta" data-cell ="F3" class="tietoalue"></div>
                </div>
                <div class="rivi">
                    <p class="teksti_vasemmalla">Rahtihinta:</p><div id="rahtihinta" data-cell="F4" data-format="0[.]00" class="tietoalue"></div>
                </div>
                <button id="laske_toimituskustannukset" onclick="laske_toimituskustannukset(this)" class="painike teksti_valkoinen laatikko_keskella">Laske</button>
            </div>

            <div class="sivu_laatikko loppusumma">
                <div class="rivi">
                    <div class="sivu_otsikko_vasen gradient_tummanharmaa teksti_valkoinen">Tuotteiden hinta</div>
                    <div class="sivu_otsikko_oikea gradient_tummanharmaa teksti_valkoinen">Loppusumma toimituskuluineen</div>
                </div>
                <div class="alv_vaakarivi">Arvonlis&auml;vero 0 %</div>
                <div class="rivi teksti_tumma">
                    <div data-cell ="F5" data-formula="G1" data-format="0[.]00" class="sivu_vasen"></div>
                    <div data-cell ="F6" data-formula="F5 + $rahti.hinta" data-format="0[.]00" class="sivu_oikea"></div>
                </div>
                <div class="alv_vaakarivi">Sis. arvonlis&auml;veron 24 %</div>
                <div class="rivi teksti_tumma">
                    <div data-cell ="F7" data-formula="F5*1.24" data-format="0[.]00" class="sivu_vasen"></div>
                    <div data-cell ="F8" data-formula="F6*1.24" data-format="0[.]00" class="sivu_oikea"></div>
                </div>
            </div>

            <button id="tyhjenna" class="painike teksti_valkoinen sivu_keskella">Tyhjenn&auml; taulukko</button>
            </div>
        </div>
    </body>
</html>
