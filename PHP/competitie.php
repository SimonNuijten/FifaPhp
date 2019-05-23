<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21-May-19
 * Time: 10:01
 */
require 'Config.php';
$sql = "SELECT * FROM `match`";              //string even opslaan die we later gaan gebruiken
$query = $db->query($sql);                      //qurey verzoek data base sla ik op in variablke
$teams = $query->fetchAll(PDO::FETCH_ASSOC); //multie demensionale array //alle colomen wil ik fetchen -> binnen halen

echo "</ul>";
foreach ($teams as $team){
    $team1 = htmlentities($team['team1']); //zodat html tags worden gecancled
    $team2 = htmlentities($team ['team2']);
    $score2 = htmlentities($team ['score2']);
    $score1 = htmlentities($team ['score1']);
    echo "<li><a href='score.php?id={$team['id']}'>$team1:$score1 - $score2:$team2</a></li>"; //"" zijn smart cwods //gaan naar detail pagina nemen extra data mee om te weten wie we menemen
}