<?php

session_start();
require_once 'db.php';
// if (isset($_SESSION['id'])) {
//     header("Location : signin.php");
//     exit();
// }

echo" Bienvenue" ."<br/> " . $_SESSION['firstName'] . " <br/>" .$_SESSION['lastName'] . " <br/>" .$_SESSION['email'] . " <br/>" .$_SESSION['password'];


?>
 <a href="updateprofil.php=? $_SESSION['id'] ">Modifier ton profil</a>