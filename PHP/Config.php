<?php
$dbHost = 'localhost';
$dbName = 'u40085p35659_Fifa';
$dbUser = 'u40085p35659_FifaProject';
$dbPass = 'Simon4312';

$db = new PDO(
    "mysql:host=$dbHost;dbname=$dbName;",
    $dbUser,
    $dbPass
);
$db->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
