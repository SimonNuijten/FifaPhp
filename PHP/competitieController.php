<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13-May-19
 * Time: 10:35
 */
require 'Config.php';
$sql = "SELECT * FROM team";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);
$amountOfTeams = count($teams);

echo "<ul>";
foreach ($teams as $team){
    $teams = array_slice($teams, 1, $amountOfTeams);

    foreach ($teams as $oppositeTeam){
        $team1 = $team['name'];
        $team2 = $oppositeTeam['name'];
        echo "<li>$team1" . "  - " . "$team2</a></li>";

        if ($_POST ['type'] == 'check') {
            $sql = "INSERT INTO `match` (team1, team2) 
values (:team1, :team2)";

            $prepare = $db->prepare($sql);
            $prepare->execute([
                ':team1'     => $team1,
                ':team2'     => $team2
            ]);
        }

    }
}

?>
<form action="competitieController.php" method="post">
    <input type="hidden" name="type" value="check">
    <div class="button">
        <input type="submit" value="bevestig" name="button">
    </div>
</form>
    <a href="competitie.php">vul uw score in</a>
<?php

//<form action="competitieController.php" method="post">
//            <input type="hidden" name="type" value="score">
//            <div class="form-group">
//                <input type="text" name="score1" id="score1">
//            </div>

