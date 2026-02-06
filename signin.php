<?php
session_start();
require_once 'db.php';

require_once './includes/header.php';

function secrityInput($inputName){
    return trim(htmlspecialchars($inputName));
}

if (isset($_POST['submit'])) {
    $email = secrityInput($_POST['email']);
    $password = secrityInput($_POST['password']);
    $_SESSION['message']= "";

    if (!empty($email) && !empty($password)){
        $verifyEmail = $pdo->prepare('SELECT * FROM user WHERE email = ?');
        $verifyEmail->execute([$email]);
        $data_User = $verifyEmail->fetch(PDO::FETCH_ASSOC);

        if ($data_User && password_verify($password, $data_User['password'])) {
            $_SESSION['id'] = $data_User['id'];
            $_SESSION['firstName'] = $data_User['firstName'];
            $_SESSION['lastName'] = $data_User['lastName'];
            $_SESSION['email'] = $data_User['email'];
            $_SESSION['message'] = "connexion réussie avec succès";
            header("Location: profil.php");
            exit();
         
        } else {
            $_SESSION['message'] = "Email ou mot de passe incorrect";
        }
    } else {
        $_SESSION['message'] = "tous les champs sont requis";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <div class="auth">

        <h1 class="page-title">Connexion</h1>
        
        <div class="container">
            <section>
                
                
                <form action="" method="post">
                    <label for="email">Email</label>
                    <input type="text" name="email"> <br/><br/>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password"> <br/><br/>
                    <input type="submit" name="submit" value="connexion">
                    <?php if(isset($_SESSION['message'])) echo $_SESSION['message'];?>
                    <p>vous n'avez de compte <a href="signup.php">s'inscrire</a></p>
                </form>
            </section>
            
            <section class="image-section">
                <div class="image-section-content">
                    <img src="./image-auth/hotel2.avif" alt="Hôtel" class="hotel-image">
                    <h2>Bon retour!</h2>
                    <p>Nous sommes ravis de vous revoir. Connectez-vous pour accéder à votre espace personnel.</p>
                </div>
            </section>
        </div>
    </div>
    </body>
    </html>
    
<?php
require_once './includes/footer.php';
?>