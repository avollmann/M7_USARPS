<?php
$server = 'localhost';
$user = 'root';
$password = 'root';
$dbname = 'USARPS';
try {

    $conn = new pdo("mysql:host=$server;dbname=$dbname", $user, $password);

}catch (PDOException $e){
    die("Error! while trying to read DB");
}

