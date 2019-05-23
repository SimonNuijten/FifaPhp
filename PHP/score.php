<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21-May-19
 * Time: 08:51
 */

require 'Config.php';
$id = $_GET['id'];
$sql = "SELECT * FROM `matches` WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id' => $id
]);
$match = $prepare->fetch(PDO::FETCH_ASSOC);
?>

<body>
<h1>score:</h1>
<form action="score.php?id=<?=$id?>" method="post">
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

<?php
require 'config.php';
if ($_POST ['type'] == 'score') {
    $id = $_GET['id'];
    $sql = 'UPDATE `match` SET
              score1      = :score1,
              score2      = :score2       
            WHERE id = :id';
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':score1'         => $_POST['score1'],
        ':score2'         => $_POST['score2'],
        ':id'           => $id
    ]);

    header("location: competitie.php");
    exit;
};