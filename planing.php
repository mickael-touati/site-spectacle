<?php

require_once 'db.php';

$data = $pdo->prepare("SELECT * FROM event");
$data->execute();
$events = $data->fetchAll();


require_once './includes/header.php';





$tab = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
 
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

    // Une cellule libre pour chaque jour
    
    foreach ($tab as $jour) {
        
        echo "<td><a href='reservation-form.php'>libre</a></td>";
    }
    
    echo "</tr>";
}

echo "</tbody>
</table>";
?>

<link rel="stylesheet" href="planing.css">
