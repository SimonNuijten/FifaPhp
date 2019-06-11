<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 18-4-2019
 * Time: 12:02
 */

require 'Config.php';

header("Acces-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UFT=8");

$sql = "SELECT * FROM team";

$query = $db->query($sql);

$teams = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset( $_GET['token'] ) && !empty( $_GET['token'])) {
   if ($_GET['token'] == 570724329) {

if (isset( $_GET['id'] ) && !empty( $_GET['id'])){

    $id = $_GET['id'] - 1;

    $team = new stdClass;

    $team->name = "";

    $team->players = "";

    $team->id = "";

    $team->name = $teams[$id]['name'];

    $team->players = $teams[$id]['description'];

    $team->id = $teams[$id]['teamCreator'];

    header('Content-Type: application/json');

    echo json_encode($team);

}

else {

    $teamNames['names'] = array();

    $length = count($teams) - 1;

    for($i=0;$i<=$length;$i++){

        $teamNames['names'][] = $teams[$i]['name'];

    }

    header('Content-Type: application/json');

    echo json_encode($teamNames);

}

}
}

