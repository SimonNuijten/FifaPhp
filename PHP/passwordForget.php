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
<body background="Background.jpg">
<div class="login-page">
    <div class="form">
        <form class="login-form" action="configController.php" method="post">
            <input type="hidden" name="type" value="Forget">
            <input type="email" placeholder="Email" name="Email">
            <input type="submit" placeholder="Login" name="submitLogin" value="Forget">
        </form>
    </div>
</div>


</body>
</html>
