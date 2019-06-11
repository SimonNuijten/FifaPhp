<?php
require 'Config.php';
session_start();

$teamNames = "SELECT * FROM team";
$query = $db->query($teamNames);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);

$playernames2 = "SELECT * FROM team ORDER BY points DESC, name ASC";
$query2 = $db->query($playernames2);
$players2 = $query2->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

	<table align="center" id="score-table">
            <tr>
                <th>Plaats</th>
                <th>Teamnaam</th>
                <th>Punten</th>
            </tr>
            <?php
			$place = 1;
            foreach ($players2 as $team){
                $teamname = htmlentities($team['name']);
                $points = htmlentities($team['points']);
		
                ?>
                <tr>
                    <td><?php echo "#$place"?></td>
                    <td><?php echo $teamname ?></td>
                    <td><?php echo $points ?></td>
                </tr>

                <?php
                $place++;
            }
            ?>
        </table>

</div>
</body>
</html>
