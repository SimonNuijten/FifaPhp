<?php
require 'Config.php';
session_start();
if($_POST['type'] == 'create'){
    $usernameWhite = $_POST['username'];
    $username = trim($usernameWhite," ");

    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $emailWhite = $_POST['email'];
    $email = trim($emailWhite," ");

    $sql = "INSERT INTO users ( username, password, email) 
        VALUES ( :Username, :Password, :Email)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':Username' => $username,
        ':Password' => $hashed_password,
        ':Email' => $email
    ]);
    header("refresh:6;url=index.php");
    exit;
}
if ($_POST ['type'] == 'score') {

    $score1 = $_POST['score1'];
    $Score2 = $_POST['score2'];
	$team1 = 0;
	$team2 = 0;
	$teamAwayPoints = 0;
	$teamHomePoints = 0;
    $id = $_GET['id'];
    
	
    if($score1 > $score1){
        $team1 += 3;
        $team2 += 0;
    }
    else if($score1 < $Score2){
        $team1 += 0;
        $team2 += 3;
    }
    else if ($score1 == $Score2){
        $team1 += 1;
        $team2 += 1;
    }
	

    $teamNames = "SELECT * FROM matches WHERE id = '$id'";
    $query = $db->query($teamNames);
    $teams = $query->fetch(PDO::FETCH_ASSOC);

    $teamHome = $teams['team1'];
    $teamAway = $teams['team2'];

    $TeamHomeName = "SELECT * FROM team WHERE name = '$teamHome'";
    $queryHomeTeam = $db->query($TeamHomeName);
    $teamsHomeList = $queryHomeTeam->fetch(PDO::FETCH_ASSOC);

    $pointsHome = $teamsHomeList['points'];
    $teamHomePoints = $pointsHome += $team1;

    $sql1 = "UPDATE team SET points = :Points WHERE name = '$teamHome'";
    $prepare1 = $db->prepare($sql1);
    $prepare1->execute([
        ':Points' => $teamHomePoints
    ]);

	$TeamName�way = "SELECT * FROM team WHERE name = '$teamAway'";
    $queryTeamAway = $db->query($TeamName�way);
    $teamsListAway = $queryTeamAway->fetch(PDO::FETCH_ASSOC);

    $points2 = $teamsListAway['points'];
    $teamAwayPoints = $points2 += $team2;

    $sql2 = "UPDATE team SET points = :Title WHERE name = '$teamAway'";
    $prepare2 = $db->prepare($sql2);
    $prepare2->execute([
        ':Title'     => $teamAwayPoints
    ]);
  

    
    $sql = 'UPDATE `matches` SET
              score1      = :score1,
              score2      = :score2       
            WHERE id = :id';
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':score1'         => $score1,
        ':score2'         => $Score2,
        ':id'           => $id
    ]);

	echo $team1;
	echo $team2;
    	echo $teamAwayPoints;
	echo $teamHomePoints;
    exit;
};
if($_POST['type'] == 'login') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "Je wachtwoord of gebruikersnaam is leeg";
        header("refresh:6;url=index.php");
    } else {

        $sql = "SELECT * FROM users WHERE username = :Username";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':Username' => $username
        ]);

        $user = $prepare->fetch(PDO::FETCH_ASSOC);


        $hashedPassword = $user['password'];


        if (password_verify($password, $hashedPassword)) {


            $id = $user['userId'];

            header("Location: page.php?userId=".$id);
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $user['userId'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['loginCheck'] = true;
        } else {
            echo "Je wachtwoord of gebruikersnaam is onjuist";
            header("refresh:6;url=index.php");
        }
    }
}
if($_POST['type'] == 'edit') {

    $id = $_GET['id'];
    $sql = "SELECT * FROM team WHERE id = :Id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':Id' => $id
    ]);

    $team = $prepare->fetch(PDO::FETCH_ASSOC);

    if($_SESSION['username'] == $team['teamCreator']) {
        $username = $_POST['name'];
        $description = $_POST['description'];
        $id = $_GET['id'];
        $sql = "UPDATE team SET name = :Title, description = :Description WHERE id = :Id";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':Title'     => $username,
            ':Description'   => $description,
            ':Id' => $id
        ]);
        header('Location: page.php');
    }
    else{
        echo 'U bent niet de eigenaar van dit team!';
    }

}
if($_POST['type'] == 'delete'){

    $Userid = $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE userId = :Id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':Id' => $Userid
    ]);
    $users = $prepare->fetch(PDO::FETCH_ASSOC);
    if($users['adminRights'] == 1){
        if($_POST['type'] == 'delete'){
            $id = $_GET['id'];
            $sqlDelete = "DELETE  FROM team WHERE id = :Id";
            $prepareDelete = $db->prepare($sqlDelete);
            $prepareDelete->execute([
                ':Id' => $id
            ]);
            header('Location: page.php');
            exit;
        }
    }
    else{
        echo 'U bent niet rechtvaardigt dit te doen ';
    }
}
if($_POST['type'] == 'teamCreate'){ 
    $description = $_POST['TeamDescription'];
    $name = $_POST['teamName'];
    $userID = $_SESSION['id'];
    $sql2 = "SELECT * FROM users WHERE userId = :Id";
    $prepare2 = $db->prepare($sql2);
    $prepare2->execute([
        ':Id' => $userID
    ]);
    $users = $prepare2->fetch(PDO::FETCH_ASSOC);
    $Name = $users['username'];

    $sql = "INSERT INTO team ( name, description, teamCreator) 
        VALUES ( :Name, :Description, :TeamCreator)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':Name' => $name,
        ':Description' => $description,
        ':TeamCreator' => $Name,
    ]);

    header('Location: page.php?id='.$id);
    exit;
}
if($_POST['type'] == 'teamCreateLink'){
    header('Location: teamAdd.php');
}
if($_POST['type'] == 'Forget'){
    header('Location: index.php');
    $email = $_POST['Email'];

    $msg = "Yeah boi\nSecond line of text";

    $msg = wordwrap($msg,70);

    $headers .= 'From: <NoReply@gmail.com>' . "\r\n";

    mail("$email","Password forgotten",$msg,$headers    );
}
if($_POST['type'] == 'Logout'){
    header('Location: index.php');
    session_destroy();
}
if($_POST['type'] == 'addPlayer'){

    $id = $_GET['id'];
    $player = $_POST['nameAdd'];


    $sql = "UPDATE users SET Team = :team WHERE username = :Id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':team'     => $id,
        ':Id' => $player
    ]);
    header('Location: page.php');

}
if($_POST['type'] == 'timeSet'){


    $Userid = $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE userId = :Id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':Id' => $Userid
    ]);
    $users = $prepare->fetch(PDO::FETCH_ASSOC);
    if($users['adminRights'] == 1){
        $time = $_POST['timeSet'];
        $_SESSION['time'] = $time;
        header('Location: bracket.php');
        $playTime = $_POST['playTime'];
        $_SESSION['playTime'] = $playTime;
        $rust = $_POST['Rust'];
        $_SESSION['Rust'] = $rust;
    }
    else{
        echo 'U bent niet rechtvaardigt dit te doen ';
    }

}
if ($_POST['type'] == 'selctedField'){
    $max = $_POST['field'];
    $_SESSION['max'] = $max;

    header ('location: bracket.php');

}
if ($_POST['type'] == 'goals'){
   $name = $_POST['username'];


    $sql = "INSERT INTO goals ( idTeam, nameTeam) 
        VALUES ( :id, :Name)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $_SESSION['idName'],
        ':Name' => $name
    ]);


}
if ($_POST['type'] == 'competitie'){
    header ('location: competitieController.php');
}
