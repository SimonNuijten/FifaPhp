<?php
require 'Config.php';
session_start();
$id = $_GET['id'];
$sql = "SELECT * FROM team WHERE id = :Id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':Id' => $id
]);
$team = $prepare->fetch(PDO::FETCH_ASSOC);



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Recipe</title>
</head>
<body background="Background.jpg">
<div class="container">
    <h1>Delete Team :</h1>
    <div class="login-page">
        <div class="form">
    <form action="configController.php?id=<?php echo $id; ?>" method="post">
        <input type="hidden" name="type" value="delete">
        <input type="submit" value="delete">
    </form>
        </div>
    </div>
    <div class="container">
        <h1>Edit Team :</h1>
        <div class="login-page">
            <div class="form">
                <form action="configController.php?id=<?php echo $id; ?>" method="post">
                    <input type="hidden" name="type" value="edit">
                    <input type="text" name="name" value="<?=$team['name']?>" required>
                    <input type="text" name="description" value="<?=$team['description']?>" required>
                    <input type="text" name="creator" value="<?=$team['teamCreator']?>" required>
                    <input type="submit" value="edit">
                </form>
            </div>
        </div>
</div>
</body>
</html>
