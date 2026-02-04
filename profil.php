<?php
session_start();
require_once 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: signin.php");
    exit();
}

// Récupérer les informations à jour de l'utilisateur depuis la base de données
try {
    $stmt = $pdo->prepare('SELECT firstName, lastName, email FROM user WHERE id = ?');
    $stmt->execute([$_SESSION['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['lastName'] = $user['lastName'];
        $_SESSION['email'] = $user['email'];
    }
} catch (PDOException $e) {
    error_log("Erreur profil : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="profil.css">
    <link rel="stylesheet" href="auth.css">
  
</head>
<body>
    <div class="profile-container">
        <h1 class="profile-title">Mon Profil</h1>
        <div class="profile-info">
            <p><strong>Bienvenue !</strong></p>
            <p><strong>Prénom :</strong> <?php echo htmlspecialchars($_SESSION['firstName']); ?></p>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($_SESSION['lastName']); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        </div>

        <div class="profile-actions">
            <a href="updateprofil.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-primary">Modifier mon profil</a>
            <a href="deconnexion.php" class="btn btn-secondary">Se déconnecter</a>
        </div>
    </div>
</body>
</html>