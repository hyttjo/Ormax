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
                    <input data-cell="H1" type="number"></input>
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
                    <input id="postal_code" type="text"></input>
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
                    <p id="delivery_cost" data-cell="H2"></p>
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
                <td data-cell ="H3" data-formula="F100" data-format="€ 0[.]00"></td>
                <td data-cell ="H4" data-formula="H3+H2" data-format="€ 0[.]00"></td>
            </tr>
            <tr>
                <td colspan="2">Sis. arvonlisäveron 24%</td>
            </tr>
            <tr>
                <td data-cell ="H5" data-formula="H3*1.24" data-format="€ 0[.]00"></td>
                <td data-cell ="H6" data-formula="H4*1.24" data-format="€ 0[.]00"></td>
            </tr>
        </table>
        <button id="empty_table">Tyhjennä taulukko</button>
    </body>
</html>