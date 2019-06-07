<?php
require 'Config.php';
session_start();

$sqlUser = "SELECT * FROM users";
$queryUser = $db->query($sqlUser);
$users = $queryUser->fetchAll(PDO::FETCH_ASSOC);


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
                <input type="hidden" name="type" value="login">
                <input type="text" placeholder="username" name="username">
                <input type="password" placeholder="password" name="password">
                <input type="submit" placeholder="Login" name="submitLogin" value="login">
                <p class="message">Not registered? <a href="Registerform.php">Create an account</a></p>
                <p class="message">Password <a href="passwordForget.php">Forgotten?</a></p>
            </form>
        </div>
    </div>
</body>
</html>
