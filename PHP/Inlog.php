<?php
require 'Config.php';
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if(empty($email) || empty($password))
{
    echo "Je wachtwoord of gebruikersnaam is leeg";
    header("refresh:6;url=Index.php");
}
else {
    $sql = "SELECT * FROM users WHERE username = :Username";

    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':Username' => $username
    ]);
    $user = $prepare->fetch(PDO::FETCH_ASSOC);


    $hashedPassword = $user['password'];

    if (password_verify($password, $hashedPassword)) {

        header("Location: page.php");
    }

    else {
        echo "Je wachtwoord of gebruikersnaam is onjuist";
        header("refresh:6;url=Index.php");
    }
}