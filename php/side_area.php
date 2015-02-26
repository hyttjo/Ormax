<?php

?>

<!DOCTYPE html>

<html>
    <body>
        <table id="discount_table">
            <tr>
                <th>Alennusprosentti</th>
            </tr>
            <tr>
                <td class="center">
                    <input id="discount" data-cell="H1" type="number" min="0" max="100"><b>%</b></input>
                </td>
            </tr>
        </table>

        <table id="delivery_cost_table">
            <tr>
                <th colspan="2">Toimituskustannukset</th>
            </tr>
            <tr>
                <td>
                    <input id="insurance_delivery" type="checkbox" value="insurance" checked>Kuljetusvakuutus</input>
                </td>
                <td>
                    <input id="lift_to_roof" type="checkbox" value="lift">Katolle nosto</input>
                </td>
            </tr>
            <tr>
                <td>Postinumero:</td>
                <td>
                    <input id="postal_code" type="text" pattern="[0-9]{5}"></input>
                </td>
            </tr>
            <tr>
                <td>Kunta:</td>
                <td>
                    <input id="city" readonly></input>
                </td>
            </tr>
            <tr>
                <td>Rahtihinta:</td>
                <td>
                    <input id="delivery_cost" data-cell="H2" readonly></input>
                </td>
            </tr>
            <tr>
                <td class="center" colspan="2">
                    <button id="calc_delivery_cost">Laske</button>
                </td>
            </tr>
        </table>

        <table id="total_cost_table">
            <tr>
                <th>Tuotteiden <br>hinta</th>
                <th>Loppusumma <br>toimituskuluineen</th>
            </tr>
            <tr>
                <td class="alv_row" colspan="2">Arvonlisävero 0 %</td>
            </tr>
            <tr>
                <td data-cell ="H3" data-formula="D100" data-format="€ 0[.]00"></td>
                <td data-cell ="H4" data-formula="H3+H2" data-format="€ 0[.]00"></td>
            </tr>
            <tr>
                <td  class="alv_row" colspan="2">Sis. arvonlisäveron 24 %</td>
            </tr>
            <tr>
                <td data-cell ="H5" data-formula="H3*1.24" data-format="€ 0[.]00"></td>
                <td data-cell ="H6" data-formula="H4*1.24" data-format="€ 0[.]00"></td>
            </tr>
        </table>
        <div class="center">
            <button id="empty_table">Tyhjennä taulukko</button>
        </div>
    </body>
</html>