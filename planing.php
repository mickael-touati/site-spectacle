<?php

require_once 'db.php';

$data = $pdo->prepare("SELECT * FROM event");
$data->execute();
$events = $data->fetchAll();

require_once './includes/header.php';

$tab = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

// Fonction pour vérifier si un événement existe à un jour et heure donnés
function getEventForSlot($events, $jour, $heure) {
    foreach ($events as $event) {
        $eventJour = strtolower(date('l', strtotime($event['start_date'])));
        $eventHeure = (int)date('H', strtotime($event['start_date']));
        
        if ($eventJour === $jour && $eventHeure === $heure) {
            return $event;
        }
    }
    return null;
}
 
echo "<table>
    <thead>
        <tr>
        <th scope='col'>Heures</th>";
    foreach ($tab as $jour) {
        echo "<th scope='col'>$jour</th>";
    }

echo "  </tr>
    </thead>
    <tbody>";

// Créer les lignes pour chaque heure
for ($i = 8; $i <= 19; $i++) { 
    echo "<tr>";
    echo "<th scope='row'>{$i}h</th>";

    // Une cellule pour chaque jour
    foreach ($tab as $jour) {
        $event = getEventForSlot($events, $jour, $i);
        
        if ($event) {
            // Afficher l'événement réservé
            echo "<td class='reserved'>";
            echo "<strong>" . htmlspecialchars($event['event_title']) . "</strong><br>";
            echo "<a href='reservation_form.php?id=" . $event['id'] . "' class='btn-detail'>Détails</a>";
            echo "</td>";
        } else {
            // Afficher le créneau libre
            echo "<td><a href='reservation_form.php?jour=$jour&heure=$i' class='btn-reserver'>libre</a></td>";
        }
    }
    
    echo "</tr>";
}

echo "</tbody>
</table>";
?>

<link rel="stylesheet" href="planing.css">
