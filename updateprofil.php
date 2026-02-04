<?php
session_start();
require_once 'db.php';
// il permet de sécriser les input
function secrityInput($nameInput) {
    return trim(htmlspecialchars($nameInput));
}


if (isset($_POST['submit'])) {
    // vérification des input 
   $firstName =  secrityInput($_POST['firstName']);
   $lastName =  secrityInput($_POST['lastName']);
   $email =  secrityInput($_POST['email']);
   $password =  secrityInput($_POST['password']);
   $confirm_password =  secrityInput($_POST['confirm_password']);
    $message = '';

    // vérification si les champs sont remplie
    // if (!empty($prenom) && !empty($nom) && !empty($adresse) && !empty($sexe)) {
        $mdphaching = password_hash($password, PASSWORD_DEFAULT);
        $insertData = $pdo->prepare(' UPDATE user SET firstName = :firstName, lastName = :lastName, email = :email, password = :password WHERE id = :id');
        $insertData->bindValue(':firstName', $firstName);
        $insertData->bindValue(':lastName', $lastName);
        $insertData->bindValue(':email', $email);
        $insertData->bindValue(':password', $mdphaching);
        $insertData->bindValue(':id', $_SESSION["id"]);
        if ($insertData->execute()) {
            echo "modification avec succés";
        }else{
            echo"erreur à la modification";
        }
    // }else{
    //     echo"tous les champs sont sont requits";
    // }
}


?>

<form action="" method="post">
    <label for="firstName">Prénom</label>
    <input type="text" name="firstName" value="<?= $_SESSION['firstName'] ?>"><br/><br/>
    <label for="lastName">Nom</label>
    <input type="text" name="lastName"  value="<?= $_SESSION['lastName'] ?>"><br/><br/>
    <label for="email">Email</label>
    <input type="email" name="email"  value="<?= $_SESSION['email'] ?>"><br/><br/>
    <label for="password">Mot de pass</label>
    <input type="password" name="password"><br/><br/>
    <label for="confirm_password">confirme password</label>
    <input type="password" name="confirm_password"><br/><br/>

    <input type="submit" name="submit" value="mettre à jour ">
    <p> <a href="profil.php">Annuler</a></p>
</form>