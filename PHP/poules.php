<?php

require 'config.php';

session_start();
$sql = "SELECT * FROM team";
$prepare = $db->prepare($sql);
$prepare->execute();
$teams = $prepare->fetchAll(PDO::FETCH_ASSOC);
$teamsLength = count($teams);
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

<table>
    <tr>
        <th>poule A</th>
        <th>poule B</th>
    </tr>
    <?php
    foreach ($teams as $team) {
        $teams = array_slice($teams,1, $teamsLength );
        foreach ($teams as $otherTeam){
            $teamName = $team['name'];
            $otherTeams = $otherTeam['name'];

        }
    }
    echo "<td>$teamName</td>";
    echo "<td>$otherTeams</td>";

    ?>
</table>

</body>
</html>

