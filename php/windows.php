<?php
    session_start();
?>

<html>
    <body>
        <div id="send_mail_window" title="Lähetä tarjous sähköpostiin">
            <form id="send_mail_form" onsubmit="return false" accept-charset="utf-8">
                <p>Sähköpostiosoitteet:</p>
                <input id="mail_address1" type="email" placeholder="1. sähköpostiosoite (pakollinen)" required></input>
                <input id="mail_address2" type="email" placeholder="2. sähköpostiosoite"></input>
                <input id="mail_address3" type="email" placeholder="3. sähköpostiosoite"></input>
                <p>Tarjouksen merkki:</p>
                <input id="mail_mark_identifier" type="text" maxlength="50"></input>
                <p>Saateviesti:</p>
                <textarea id="mail_message"></textarea>
                <div>
                    <button id="send_mail" type="submit">Lähetä</button>
                    <div id="mail_loading_container">
                        <img src="img/loading.gif" alt="loading"></img>
                    </div>
                </div>
            </form>
        </div>

        <div id="download_window" title="Lataa tarjous PDF-muodossa">
            <form id="download_form" onsubmit="return false" accept-charset="utf-8">
                <p>Tarjouksen merkki:</p>
                <input id="download_mark_identifier" type="text" maxlength="50"></input>
                <div>
                    <button id="download" type="submit">Lataa</button>
                    <div id="download_loading_container">
                        <img src="img/loading.gif" alt="loading"></img>
                    </div>
                </div>
            </form>
        </div>

        <div id="print_window" title="Tulosta tarjous">
            <form id="print_form" onsubmit="return false" accept-charset="utf-8">
                <p>Tarjouksen merkki:</p>
                <input id="print_mark_identifier" type="text" maxlength="50"></input>
                <div>
                    <button id="print" type="submit">Tulosta</button>
                    <div id="print_loading_container">
                        <img src="img/loading.gif" alt="loading"></img>
                    </div>
                </div>
            </form>
        </div>

        <div id="info_window" title="Info">
            <p id="info_window_message"></p>
            <button id="info_window_ok">Ok</button>
        </div>

        <div id="product_window" title="Tuotetiedot">
            <div id="product_loading_container">
                <img src="img/loading.gif" alt="loading"></img>
            </div>
            <table id="product_info_table">
                <tr>
                    <td id="product_info_image" rowspan="9">
                        <img src="" alt="product_info_image"></img>
                    </td>
                    <td>Tuotenumero: </td>
					<td id="product_info_number"></td>
                </tr>
				<tr>
                    <td>Hinta: </td>
					<td id="product_info_price"></td>
                </tr>
				<tr>
                    <td>Paino: </td>
					<td id="product_info_weight"></td>
                </tr>
				<tr>
                    <td>Tuoteryhmä: </td>
					<td id="product_info_group"></td>
                </tr>
				<tr>
                    <td>Tuoteluokka: </td>
					<td id="product_info_class"></td>
                </tr>
				<tr>
                    <td>Lavakoko: </td>
					<td id="product_info_palletsize"></td>
                </tr>
				<tr>
                    <td>Pakkauskoko: </td>
					<td id="product_info_packagesize"></td>
                </tr>
				<tr>
                    <td>Pakkausyksikkö: </td>
					<td id="product_info_packageunit"></td>
                </tr>
                <tr>
                    <td>EAN: </td>
					<td id="product_info_ean"></td>
                </tr>
				<tr>
                    <td colspan="3">
                        <div id="product_info_description"></div>
                    </td>
                </tr>
            </table>
            <button id="product_window_close">Sulje</button>
        </div>

        <div id="statistics_window" title="Käyttötilastot">
            <button id="user_statistics_show">
                <img src="img/icons/user_icon.png" alt="käyttäjät"></img>
                <span>Käyttäjät</span>
            </button>
            <button id="amount_calc_statistics_show">
                <img src="img/icons/calculator_icon.png" alt="määrälaskennat"></img>
                <span>Määrälaskennat</span>
            </button>
            <button id="delivery_cost_statistics_show">
                <img src="img/icons/delivery_icon.png" alt="toimituskustannukset"></img>
                <span>Toimituskululaskennat</span>
            </button>
            <button id="pdf_statistics_show">
                <img src="img/icons/document_icon.png" alt="tarjoukset"></img>
                <span>Valmiit tarjoukset</span>
            </button>
            <button id="chart_statistics_show">
                <img src="img/icons/charts_icon.png" alt="kaaviot"></img>
                <span>Kaaviot</span>
            </button>
            <div id="user_statistics_container">
                <table id="user_statistics_table"></table>
            </div>
            <div id="amount_calc_statistics_container">
                <table id="amount_calc_statistics_table"></table>
            </div>
            <div id="delivery_cost_statistics_container">
                <table id="delivery_cost_statistics_table"></table>
            </div>
            <div id="pdf_statistics_container">
                <table id="pdf_statistics_table"></table>
            </div>
            <div id="chart_statistics_container">
                <table id="chart_statistics_table">
                    <tr>
                        <td id="chart_statistics_tiles_and_colour">
                            Valmiit tarjoukset<br>
                            Tiilet / Värit
                        </td>
                        <td rowspan="3" id="chart_statistics_img_area">
                            <img id="chart_statistics_img_secondary" src="img/blank.png" alt="kaavio 2"></img>
                            <img id="chart_statistics_img_primary" src="img/loading.gif" alt="kaavio 1"></img>
                        </td>
                    </tr>
                    <tr>
                        <td id="chart_statistics_delivery_map">
                            Valmiit tarjoukset<br>
                            postinumeroalueittain
                        </td>
                    </tr>
                    <tr>
                        <td id="chart_statistics_empty_tab_space"></td>
                    </tr>
                </table>
            </div>
            <button id="statistics_window_close">Sulje</button>
        </div>
    </body>
</html>