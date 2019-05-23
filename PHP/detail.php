<?php
require 'Config.php';
session_start();

if($_SESSION['loginCheck'] == true) {


    $id = $_GET['id'];
    $sql = "SELECT * FROM team WHERE id = :Id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':Id' => $id
    ]);
    $team = $prepare->fetch(PDO::FETCH_ASSOC);
    $_SESSION['teamName'] = $team['name'];

    $teamName = $_SESSION['name'];
    $id = $_GET['id'];
    /*
    $sql2 = "SELECT * FROM users WHERE Team = :Id";
    $prepare2 = $db->prepare($sql2);
    $prepare2->execute([
        ':Id' => $id
    ]);
    $users = $prepare2->fetch(PDO::FETCH_ASSOC);
    */
    $playernames = "SELECT * FROM users WHERE Team = $id";
    $query = $db->query($playernames);
    $players = $query->fetchAll(PDO::FETCH_ASSOC);


    ?>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="edit.css">
        <title>Recipe</title>
    </head>
    <body>
    <header>
        <ul>
            <li><a class="active" href="page.php">Home</a></li>
            <li><a href="bracket.php">Team Programma</a></li>
        </ul>
    </header>
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
                        <input type="text" name="name" value="<?= $team['name'] ?>" required>
                        <input type="text" name="description" value="<?= $team['description'] ?>" required>
                        <input type="text" name="creator" value="<?= $team['teamCreator'] ?>" required>
                        <input type="submit" value="edit">
                    </form>
                </div>
            </div>
            <div class="login-page">
                <div class="form">
                    <form action="configController.php?id=<?php echo $id; ?>" method="post">
                        <input type="hidden" name="type" value="addPlayer">
                        <input type="text" name="nameAdd">
                        <input type="submit" value="addPlayer">
                    </form>
                </div>
            </div>
        </div>
        <div class="player-table" align="center">
            <p>Spelers</p>
            <table>
                <tr>
                </tr>
                <tr>
                    <?php foreach ($players as $player) {
                        $playername = htmlentities($player['username']);

                        echo "<td>$playername</td>";

                    } ?>
                </tr>
            </table>
        </div>
    </body>
    </html>
    <?php
}
else{
    echo "U bent nog niet ingelogt";
    header("refresh:6;url=index.php");
}
