<?php
session_start();
if($_SESSION['loginCheck'] == true) {


    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Document</title>
    </head>
    <body>
    <header>
        <ul>
            <li><a class="active" href="page.php">Home</a></li>
            <li><a href="bracket.php">Team Programma</a></li>
        </ul>
    </header>
    <div class="login-page">
        <div class="form">

            <form class="login-form" action="configController.php" method="post">
                <input type="hidden" name="type" value="teamCreate">
                <input type="text" placeholder="Naam" name="teamName" required>
                <input type="text" placeholder="Beschrijving" name="TeamDescription" required>
                <input type="submit" placeholder="Create" name="submitLogin" value="teamCreate">
            </form>
        </div>
    </div>

    </body>
    </html>
    <?php
}
Else{
    echo "U bent nog niet ingelogt";
    header("refresh:6;url=index.php");
}