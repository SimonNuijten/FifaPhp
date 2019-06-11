
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
$teamsLong = $teamsLength / 2;

$sql2 = "SELECT name FROM team LIMIT 100 OFFSET $teamsLong;";
$prepare2 = $db->prepare($sql2);
$prepare2->execute();
$list = $prepare2->fetchAll(PDO::FETCH_ASSOC);

$teamBool = false;
?>
<?php

if($teamBool == false)
{
?>
<table>
    <tr>
        <th>Poule 1</th>
    </tr>
    <?php
	
	$teamCount = 0;
	$teamnameCount;
    foreach ($teams as $team) {
        foreach ($teams as $otherTeam) {
            $teamName = $team['name'];
            ?>
            <tr>
            <?php
			if($teamName != $teamnameCount && $teamBool == false){
				
				if($teamCount < $teamsLong){
					$teamCount += 1;
					$teamnameCount = $teamName;
					echo "<td>$teamName</td>";
				}
				else if($teamCount == $teamsLong){
				$teamBool = true;
}		
			}
			else {
			}
        }
        ?>
        </tr>

        <?php
    }
    ?> </table>
<?php
}
if($teamBool == true){
	?>
<table>
    <tr>
        <th>Poule 2</th>
    </tr>
    <?php
	$teamCount = 0;
	$teamnameCount;
    foreach ($list as $list) {
        foreach ($teams as $otherTeam) {
            $teamName = $list['name'];
            ?>
            <tr>
            <?php
			if($teamName != $teamnameCount && $teamBool == true ){
				
				
					$teamCount += 1;
					$teamnameCount = $teamName;
					echo "<td>$teamName</td>";		
			}
			else {
			
			} 
        }
        ?>
        </tr>

        <?php
    }
    ?> </table> <?php
}



$s = 1;
if($s == 2){
}
else {
}
var_dump($list);

?>