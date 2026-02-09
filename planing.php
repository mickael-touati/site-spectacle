<?php
require_once 'db.php';

// Récupérer les événements
$data = $pdo->prepare("SELECT * FROM event");
$data->execute();
$events = $data->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Planning</title>
</head>
<body>
    <h1>Planning</h1>
    
    <?php foreach ($events as $event): ?>
        
        <p>
            <?= $event["event_title"] ?>
            <br>
            <?php
            $date = new DateTime($event["start_date"]);
            echo $date->format('d/m/Y à H:i');
            ?>
        </p>
        
    <?php endforeach; ?>
    
