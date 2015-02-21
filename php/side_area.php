<?php

?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/side_area.css">
    </head>
    <body>
        <table id="discount_table">
            <tr>
                <th colspan="2">Alennusprosentti</th>
            <tr>
            <tr>
                <td>
                    <input data-cell="F1" type="number"></input>
                </td>
                <td>
                    <b>%</b>
                </td>
            </tr>
        </table>

        <table id="delivery_cost_table">
            <tr>
                <th colspan="2">Toimituskustannukset</th>
            </tr>
            <tr>
                <td>Postinumero:</td>
                <td>
                    <input id="postal_code" data-cell="F2" type="text"></input>
                </td>
            <tr>
            <tr>
                <td>Kunta:</td>
                <td>
                    <p id="city"></p>
                </td>
            <tr>
            <tr>
                <td>Rahtihinta:</td>
                <td>
                    <p id="delivery_cost"></p>
                </td>
            <tr>
            <tr>
                <td colspan="2">
                    <button id="calc_delivery_cost">Laske</button>
                </td>
            <tr>
        </table>

        <table id="total_cost_table">
            <tr>
                <th>Tuotteiden <br>hinta</th>
                <th>Loppusumma <br>toimituskuluineen</th>
            </tr>
            <tr>
                <td colspan="2">Arvonlisävero 0 %</td>
            </tr>
            <tr>
                <td data-cell ="F5" data-formula="G1" data-format="€ 0[.]00"></td>
                <td data-cell ="F6" data-formula="F5" data-format="€ 0[.]00"></td>
            </tr>
            <tr>
                <td colspan="2">Sis. arvonlisäveron 24%</td>
            </tr>
            <tr>
                <td data-cell ="F7" data-formula="F5*1.24" data-format="€ 0[.]00"></td>
                <td data-cell ="F8" data-formula="F6*1.24" data-format="€ 0[.]00"></td>
            </tr>
        </table>
        <button id="empty_table">Tyhjennä taulukko</button>
    </body>
</html>