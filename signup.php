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
   if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password) && !empty( $confirm_password)) {
        // verification des mot de pass
        if ($password === $confirm_password ) {
            // vérifier si l'email existe ou bien 
            $verifyEmail = $pdo->prepare("SELECT * FROM user WHERE email =?");
            $verifyEmail->execute([$email]);
            if ($verifyEmail->rowCount() === 0) {
                $passwordHaching = password_hash($password, PASSWORD_DEFAULT);
                // insertion des données à la basse de données 
                $insertData = $pdo->prepare('INSERT INTO user(firstName, lastName, email, password ) VAlUES (:firstName, :lastName, :email, :password)');
                $insertData->bindValue(':firstName', $firstName, PDO::PARAM_STR);
                $insertData->bindValue(':lastName', $lastName);
                $insertData->bindValue(':email', $email);
                $insertData->bindValue(':password', $passwordHaching);
                // vérifier si les données sont bien inserer à la basse de données 
                if ($insertData->execute()){
                    $message = "inscription reuissi avec succés";
                    // redirection à la page de connexion 
                    header("location: signin.php");
                }else{
                    $message = "erreur lors de l'inscription";
                }
            }else{
                $message = "l'email existe déja";
            }
        }else{
            $message = "les mot de passes ne sont pas identiques !";
        }
   }else{
         $message = "tous les champs sont requis !";
   }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="auth.css">
</head>

<body >
    <div class="auth">

        <h1 class="page-title">Inscription</h1>
        
        <div class="container">
            <section>
                
                
                <form action="" method="post">
                    <label for="firstName">Prénom</label>
                    <input type="text" name="firstName"><br/><br/>
                    <label for="lastName">Nom</label>
                    <input type="text" name="lastName"><br/><br/>
                    <label for="email">Email</label>
                    <input type="email" name="email"><br/><br/>
                    <label for="password">Mot de pass</label>
                    <input type="password" name="password"><br/><br/>
                    <label for="confirm_password">confirme password</label>
                    <input type="password" name="confirm_password"><br/><br/>
                    
                    <input type="submit" name="submit" value="inscrire">
                    <p>Avez-vous déja un compte <a href="signin.php">connecter</a></p>
                </form>
            </section>
            
            <section class="image-section">
                <div class="image-section-content">
                    <img src="./image-auth/hotel3.webp" alt="Hôtel" class="hotel-image">
                    <h2>Ravi de vous voir!</h2>
                    <p>Rejoignez-nous et découvrez une expérience unique dans nos établissements d'exception.</p>
                </div>
            </section>
        </div>
    </div>
    </body>
    </html>