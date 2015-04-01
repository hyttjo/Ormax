<?php
    session_start();
?>

<!DOCTYPE html>

<html>
    <body>
        <div id="send_mail_window" title="Lähetä tarjous sähköpostiin">
            <form id="send_mail_form" onsubmit="return false" accept-charset="utf-8">
                <p>Sähköpostiosoitteet:</p>
                <input id="mail_address1" type="email" placeholder="1. sähköpostiosoite (pakollinen)" required></input>
                <input id="mail_address2" type="email" placeholder="2. sähköpostiosoite"></input>
                <input id="mail_address3" type="email" placeholder="3. sähköpostiosoite"></input>
                <p>Merkki:</p>
                <input id="mail_mark_identifier" type="text" maxlength="50"></input>
                <p>Saateviesti:</p>
                <textarea id="mail_message"></textarea>
                <div>
                    <button id="send_mail" type="submit">Lähetä</button>
                    <div id="loading_container">
                        <img id="loading" src="img/loading.gif" alt="loading"></img>
                    </div>
                </div>
            </form>
        </div>

        <div id="info_window" title="Info">
            <p id="info_window_message"></p>
            <button id="info_window_ok">Ok</button>
        </div>
    </body>
</html>