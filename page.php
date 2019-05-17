<?php
require 'Config.php';

//header("Acces-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UFT=8");
session_start();
$sql = "SELECT * FROM team";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);


$id = $_SESSION['id'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="page.css">
    <title>Document</title>
</head>
<body>
<header>
    <ul>
        <li><a class="active" href="page.php">Home</a></li>
        <li><a href="bracket.php">Team Programma</a></li>
    </ul>
</header>
</div>
<div class="form">
    <form class="login-form" action="configController.php" method="post">
        <input type="hidden" name="type" value="teamCreateLink">
        <input type="submit" placeholder="Login" name="submitLogin" value="Add">
    </form>
</div>

<div class="login-page">
        <?php
        echo '<ul>';
        foreach ($teams as $team) {
            $name = htmlentities($team['name']);
            $description = htmlentities($team['description']);
            echo "<div class='form'>
                    <a href='detail.php?id={$team['id']}'>$name</a>
                   </div>";
        }
        echo '</ul>';
        ?>

    <div class="form">
        <form class="login-form" action="configController.php" method="post">
            <input type="hidden" name="type" value="teamCreateLink">
            <input type="submit" placeholder="Login" name="submitLogin" value="Add">
        </form>
    </div>
</div>

</body>
</html>
