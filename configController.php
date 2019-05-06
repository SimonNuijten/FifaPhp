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
    var_dump(password_hash($password, PASSWORD_DEFAULT));
    var_dump($password);
    header("refresh:6;url=Index.php");
    exit;
}
if($_POST['type'] == 'login') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "Je wachtwoord of gebruikersnaam is leeg";
        header("refresh:6;url=Index.php");
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
        } else {
            echo "Je wachtwoord of gebruikersnaam is onjuist";
            header("refresh:6;url=Index.php");
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
        echo 'hoi';
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