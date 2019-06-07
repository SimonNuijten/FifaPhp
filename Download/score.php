<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21-May-19
 * Time: 08:51
 */

require 'Config.php';
session_start();
$id = $_GET['id'];
$sql = "SELECT * FROM `matches` WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id' => $id
]);
$match = $prepare->fetch(PDO::FETCH_ASSOC);
$_SESSION['idName'] = $id;

$idName = $_GET['id'];
$playernames = "SELECT * FROM goals WHERE idTeam = $idName";
$query = $db->query($playernames);
$players = $query->fetchAll(PDO::FETCH_ASSOC);

$playernames2 = "SELECT * FROM team ORDER BY points DESC, name ASC";
$query2 = $db->query($playernames2);
$players2 = $query2->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
<h1>score:</h1>
<form action="configController.php?id=<?=$id?>" method="post">
    <input type="hidden" name="type" value="score">
    <div class="form-group">
        <label for="score1" > <?php echo htmlentities($match['team1']) ?></label>
        <input type="text" id="score1" name="score1" value="<?= htmlentities($match['score1']) ?>" >
    </div>
    <div class="form-group">
        <label for="score2" > <?php echo htmlentities($match['team2']) ?></label>
        <input type="text" id="score2" name="score2" value="<?= htmlentities($match['score2']) ?>">
    </div>
    <input type="submit" id='score_b' value="bevestig score">
</form>

<div class="form">

    <form class="login-form" method="post" action="configController.php">
        <input type="hidden" name="type" value="goals">
        <input type="text" placeholder="username" name="username" required>
        <input type="submit" placeholder="Login" name="submitLogin" value="goals">
    </form>
</div>
<div class="player-table" align="center">
    <p>Doelpunten makers</p>
    <table>
        <tr>
        </tr>
        <tr>
            <?php foreach ($players as $player) {
                $playername = $player['nameTeam'];

                echo "<td>$playername</td>";

            } ?>
        </tr>
    </table>
	

</div>
<?php
?>

