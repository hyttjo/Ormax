<?php
    header('P3P: CP="NOI ADM DEV COM NAV OUR STP"');
?>

<!DOCTYPE html>

<html lang="fi">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8">

        <title>Ormax Monier Oy - Tarjouspyyntölomake</title>

        <link rel="stylesheet" type="text/css" href="css/style.css">

        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="js/jquery.chained.min.js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div id="container">
            <form id="quotation" method="post" action="php/send_mail.php" enctype="multipart/form-data" accept-charset="utf-8">
                <div id="contact">
                    <p>Yhteystiedot</p>
                    <div class="left">
                        <label>Etunimi<span>*</span></label>
                        <input name="firstname" type="text" required></input>
                    </div>
                    <div class="right">
                        <label>Sukunimi<span>*</span></label>
                        <input name="lastname" type="text" required></input>
                    </div>
                    <div class="both">
                        <label>Osoite<span>*</span></label>
                        <input name="address" type="text" required></input>
                    </div>
                    <div class="left">
                        <label>Postinumero<span>*</span></label>
                        <input name="postal_code" pattern="[0-9]{5}" type="text" required></input>
                    </div>
                    <div class="right">
                        <label>Postitoimipaikka<span>*</span></label>
                        <input name="city" type="text" required></input>
                    </div>
                    <div class="left">
                        <label>Puhelin<span>*</span></label>
                        <input name="phone" type="text" required></input>
                    </div>
                    <div class="right">
                        <label>Sähköposti<span>*</span></label>
                        <input name="email" type="email" required></input>
                    </div>
                </div>
                <div id="product">
                    <p>Tuotteen tiedot</p>
                    <div class="left">
                        <label>Tiilimalli</label>
                        <select id="tile" name="tile">
                            <option value=""></option>
                            <option value="ormax">Ormax</option>
                            <option value="protector">Ormax Protector+</option>
                            <option value="minster">Minster</option>
                            <option value="turmalin">Turmalin</option>
                            <option value="granat">Granat</option>
                            <option value="nortegl">Nortegl</option>
                            <option value="nova">Nova</option>
                            <option value="rubin">Rubin</option>
                            <option value="vittinge_e13">Vittinge E13</option>
                            <option value="vittinge_t11">Vittinge T11</option>
                        </select>
                    </div>
                    <div class="right">
                        <label>Väri</label>
                        <select id="colour" name="colour">
                            <option class=""></option>
                            <option class="ormax">Savitiilenpunainen</option>
                            <option class="ormax">Tupapunainen</option>
                            <option class="ormax">Harmaa</option>
                            <option class="ormax">Tummanharmaa</option>
                            <option class="ormax">Musta</option>
                            <option class="ormax">Ruskea</option>
                            <option class="ormax">Antiikki</option>
                            <option class="protector">Savitiilenpunainen</option>
                            <option class="protector">Tupapunainen</option>
                            <option class="protector">Tummanharmaa</option>
                            <option class="protector">Musta</option>
                            <option class="protector">Ruskea</option>
                            <option class="minster">Savitiilenpunainen</option>
                            <option class="minster">Tupapunainen</option>
                            <option class="minster">Tummanharmaa</option>
                            <option class="minster">Antrasiitti</option>
                            <option class="minster">Tummanruskea</option>
                            <option class="minster">Vaaleanharmaa</option>
                            <option class="turmalin">Savitiilenpunainen</option>
                            <option class="turmalin">Enkopoitu Kuparinpunainen</option>
                            <option class="turmalin">Enkopoitu Harmaa</option>
                            <option class="turmalin">Enkopoitu Antrasiitti</option>
                            <option class="turmalin">Lasitettu Koralli</option>
                            <option class="turmalin">Lasitettu Harmaa</option>
                            <option class="turmalin">Lasitettu Musta</option>
                            <option class="granat">Savitiilenpunainen</option>
                            <option class="granat">Enkopoitu Kuparinpunainen</option>
                            <option class="granat">Enkopoitu Antrasiitti</option>
                            <option class="granat">Lasitettu Punainen</option>
                            <option class="granat">Lasitettu Koralli</option>
                            <option class="nortegl">Savitiilenpunainen</option>
                            <option class="nortegl">Enkopoitu Antrasiitti</option>
                            <option class="nortegl">Enkopoitu Antiikki</option>
                            <option class="nortegl">Lasitettu Koralli</option>
                            <option class="nortegl">Lasitettu Musta</option>
                            <option class="nova">Savitiilenpunainen</option>
                            <option class="nova">Enkopoitu Antrasiitti</option>
                            <option class="nova">Lasitettu Musta</option>
                            <option class="rubin">Savitiilenpunainen</option>
                            <option class="rubin">Enkopoitu Kuparinpunainen</option>
                            <option class="rubin">Enkopoitu Antrasiitti</option>
                            <option class="rubin">Enkopoitu Ruskea</option>
                            <option class="rubin">Lasitettu Punainen</option>
                            <option class="rubin">Lasitettu Kastanja</option>
                            <option class="rubin">Lasitettu Koralli</option>
                            <option class="rubin">Lasitettu Musta</option>
                            <option class="rubin">Enkopoitu Vihreä</option>
                            <option class="vittinge_e13">Savitiilenpunainen</option>
                            <option class="vittinge_t11">Savitiilenpunainen</option>
                        </select>
                    </div>
                </div>
                <div id="message">
                    <p>Viesti</p>
                    <div>
                        <label>Sinun viestisi</label>
                        <textarea name="message_text"></textarea>
                    </div>
                </div>
                <div id="attachment">
                    <p>Liitäthän mahdolliset julkisivukuvat .pdf tai .dwg muodossa</p>
                    <div>
                        <label for="attachment_1">Liite 1</label>
                        <input name="attachment_1" type="file"></input>
                    </div>
                    <div>
                        <label for="attachment_2">Liite 2</label>
                        <input name="attachment_2" type="file"></input>
                    </div>
                    <div>
                        <label for="attachment_3">Liite 3</label>
                        <input name="attachment_3" type="file"></input>
                    </div>
                    <div>
                        <label for="attachment_4">Liite 4</label>
                        <input name="attachment_4" type="file"></input>
                    </div>
                    <div>
                        <label for="attachment_5">Liite 5</label>
                        <input name="attachment_5" type="file"></input>
                    </div>
                </div>
                <div id="submit">
                    <button type="submit">Lähetä</button>
                </div>
            </form>
        </div>
    </body>
</html>