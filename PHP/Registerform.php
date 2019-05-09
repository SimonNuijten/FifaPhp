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

        <form class="login-form" method="post" action="configController.php">
            <input type="hidden" name="type" value="create">
            <input type="text" placeholder="username" name="username">
            <input type="password" placeholder="password" name="password">
            <input type="text" placeholder="Email" name="email">
            <input type="submit" placeholder="Login" name="submitLogin" value="create">
        </form>
    </div>
</div>

</body>
</html>
