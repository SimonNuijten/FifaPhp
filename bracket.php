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
$minute = 0;
$time = $_SESSION['time'];
?>
<table>
        <tr>
        <th>Team 1</th>
        <th>Team 2</th>
            <th>Tijd</th>
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

        $minute += $_SESSION['Rust'];

        
         if($minute + $_SESSION['playTime'] > 60){
            $minute -  60;
            $time += 1;
        }
         else if($minute + $_SESSION['playTime'] == 60){
            $time += 1;
            $minute = 00;
        }
        else{
            $minute += $_SESSION['playTime'] ;
        }
        echo "<td>$teamName</td>";
        echo "<td>$otherTeamName</td>";
        echo "<td>$time:$minute</td>";


    }
    ?>
        </tr>

    <?php

}
?> </table>
<div class="login-page">
    <div class="form">
        <form action="configController.php" method="post">
            <input type="hidden" name="type" value="timeSet">
            <input type="text" name="timeSet" placeholder="Vul hier uw begin tijd in">
            <input type="text" name="playTime" placeholder="Hoelang duurt de wedstrijd?">
            <input type="text" name="Rust" placeholder="Hoelang zit pauze is er tussen de wedstrijden?">
            <input type="submit" value="timeSet">
        </form>
    </div>
</div>
<?php
$s = 1;
if($s == 2){
}
else {
}
?>