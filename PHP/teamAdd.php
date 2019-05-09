<?php
session_start();
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
<div class="login-page">
    <div class="form">

        <form class="login-form" action="configController.php" method="post">
            <input type="hidden" name="type" value="teamCreate">
            <input type="text" placeholder="Naam" name="teamName">
            <input type="text" placeholder="Beschrijving" name="TeamDescription">
            <input type="submit" placeholder="Create" name="submitLogin" value="teamCreate">
        </form>
    </div>
</div>

</body>
</html>
