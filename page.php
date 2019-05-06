<?php
require 'Config.php';
session_start();
$sql = "SELECT * FROM team";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);
/*
$id = $_GET['userId'];
$sqlUser = "SELECT * FROM users WHERE userId = :Id";
$prepareUser = $db->prepare($sql);
$prepareUser->execute([
    ':Id' => $id
]);

$id = $_GET['userId'];
$idUser = $_SESSION['idUser'] = $id;
*/
$id = $_SESSION['id'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="page.css">
    <title>Document</title>
</head>
<body background="Background.jpg">
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
            echo "<div class='form' <li><a href='detail.php?id={$team['id']}'> <h1>$name</h1>  <h3>$description</h3></a></div> </div> </li>";
        }
        echo '</ul>';
        ?>


</div>

</body>
</html>
