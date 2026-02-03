<?php


$dsn = 'mysql:host=localhost; dbname=test-authentification; charset=utf8mb4';
$username = 'lamali-abdallah_room-reservation';
$password = 'Lamali26100';
 
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $th) {
    die("erreur à la base de données : " .$th->getMessage());
}

?>