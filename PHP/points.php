<?php
require 'Config.php';
session_start();

$teamNames = "SELECT * FROM team";
$query = $db->query($teamNames);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="points.css">
    <title>Document</title>
</head>
<body>
<div class="player-table" align="center">
    <p>Punten</p>
    <table>
        <tr>
        </tr>
        <tr>
            <?php foreach ($teams as $player) {
                $playername = $player['name'];
                $teamPoints = $player['points'];

                echo "<td>$playername</td><td>$teamPoints</td>";

            } ?>
        </tr>
    </table>

</div>
</body>
</html>
