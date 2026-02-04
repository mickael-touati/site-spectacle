<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>site de spectacle</title>
    <link rel="stylesheet" href="style.css">

</head>
<body class="lemenu">
   <header class="logo_spectacle">
    <div>
    <h1><img src="./images/icone bon site spectacle.png" alt="logo_spectacle"></h1>
    </div>
    <nav class="menu">
        <ul>
            <li><a href="index.php" class="active">Accueil</a></li>
            <li><a href="reservation-form.php" class="active">Creer une reservation de salle</a></li>
            <li><a href="shedule.php" class="active">Reservation</a></li>

            <?php
            if (isset($_SESSION['id'])) {
            echo '<li><a href="./profil.php">Profil</a></li>';
            echo '<li><a href="./deconnexion.php">Déconnexion</a></li>';
            } else {
            echo '<li><a href="./signin.php">Connexion</a></li>';
            echo '<li><a href="./signup.php">Inscription</a></li>';
            }
        ?>
        </ul>
    </nav>
</header>