<?php
    session_start();

    if(isset($_GET['failed'])) {
        $message = 'Kirjautuminen ei onnistunut: <br>Käyttäjänimi tai salasana väärä.';
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">

        <title>Ormax Monier Oy - Hinnastolaskenta 2015</title>

        <link rel="stylesheet" type="text/css" href="../css/style1.css">
        <!--[if IE]>
	        <link rel="stylesheet" type="text/css" href="../css/ie9_and_older_style.css">
        <![endif]-->

        <script src="../js/libs/head.min.js"></script>

        <script>
            head.js(["https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js",
                     "../js/libs/numeral.min.js",
                     "../js/libs/jquery-calx-2.0.5.min.js",
                     "../js/script1.js",
                     "../js/google_analytics.js"]);
        </script>
    </head>
    <body>
        <div id="login_wrapper">
            <div id="login">
                <div id="login_header">Kirjaudu sisään:</div>
                <img src="../img/ormax_logo.png" alt="Ormax-tiilikatot logo"></img>
                <form method="post" action="scripts/login_auth.php" accept-charset="utf-8">
                    <div class="input_row">
                        <label>Käyttäjätunnus:</label>
                        <input name="username" type="text" pattern=".{3,14}" title="3-14 merkkiä" required></input>
                    </div>
                    <div class="input_row">
                        <label>Salasana:</label>
                        <input name="password" type="password" pattern=".{3,14}" title="3-14 merkkiä" required></input>
                    </div>
                    <button type="submit">Kirjaudu</button>
                </form>
                <div id="login_message"><?php echo $message ?></div>
            </div>
        </div>   
    </body>
</html>