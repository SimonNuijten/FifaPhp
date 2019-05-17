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

</body>
</html>
<?php
require 'Config.php';
session_start();

        $sql = "SELECT name FROM team;";
        $prepare = $db->prepare($sql);
        $prepare->execute();

        $teams = $prepare->fetchAll(PDO::FETCH_ASSOC);

        $teamsLength = count($teams);
        ?>
        <table align="center">
            <tr>
                <th>Team 1</th>
                <th>Team 2</th>
            </tr>
            <?php

            foreach ($teams as $team) {
                $teams = array_slice($teams, 1, $teamsLength);

                foreach ($teams as $otherTeam) {
                    $teamName = $team['name'];
                    $otherTeamName = $otherTeam['name'];
                    ?>
                    <tr>
                    <?php

                    echo "<td>$teamName</td>";
                    echo "<td>$otherTeamName</td>";

                }
                ?>
                </tr>
                <?php

            }
            ?> </table>
<?php
$s = 1;
if($s == 2){

}
else {

}
?>

