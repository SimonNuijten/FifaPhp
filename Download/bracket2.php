<?php
require 'Config.php';
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UFT-8");
$sql = "SELECT name FROM team";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);

$teamsLength = count($teams);

$competition = array();
$competition['matches'] = array();
foreach ($teams as $team){
$teams = array_slice($teams, 1, $teamsLength);
    foreach ($teams as $opponoment) {
        if($team['name'] != $opponoment['name']){
            array_push($competition['matches'], $team['name'] . ' - ' . $opponoment['name']);
        }
    }
}
if (isset($competition)) {
    http_response_code(200);
    echo json_encode($competition);
}
else{
    http_response_code(404);
}
