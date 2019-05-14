<?php
require 'Config.php';
session_start();
$sql = "SELECT * FROM team";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);
/*
$id = $_GET['userId'];
$sqlUser = "SELECT * FROM users WHERE userId = :Id";
$prepareUser = $db->prepare($sql);
$prepareUser->execute([
    ':Id' => $id
]);

$id = $_GET['userId'];
$idUser = $_SESSION['idUser'] = $id;
*/


$num_team = 6;
$num_week = 5;

if ($num_team % 2 != 0){
    $num_team++;
}

$n2 = ($num_team-1)/2;

for($x = 0; $x < $num_team; $x++){
    $teams[$x] = $x+1;
}

for ($x = 0; $x < $num_week; $x++){
    for($i = 0; $i < $n2; $i++){
        $team1 = $teams['name'];
        $team2 = $teams['name'];
        $results[$team1][$x] = $team2;
        $results[$team2][$x] = $team1;
        echo $results[$team1] [ $x] . " vs " . $results[$team2][$x] . "<br>";
    }
    echo "<br>";
    $tmp = $teams [1];
    for ($i = 1; $i < sizeof($teams)-1; $i++){
        $teams[$i] = $teams[$i+1];
    }
    $teams[sizeof($teams)-1] = $tmp;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="page.css">
    <title>Document</title>
</head>
<body>



</body>
</html>

