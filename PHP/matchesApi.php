<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20-May-19
 * Time: 11:29
 */

require 'Config.php';

header('conectent-Type: application/json');

$sql ="SELECT * FROM `matches`";

$query = $db->query($sql);

$match = $query->fetchALL (PDO::FETCH_ASSOC);

$scores = array();
$scores['scores'] = array();

array_push($scores['scores'], $match['score1'] . $match['team1'] . ' - ' . $match['team2'] . $match['score2']);

echo json_encode($scores);