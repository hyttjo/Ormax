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
    </body>
</html>