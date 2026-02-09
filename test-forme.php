<?php
session_start();

require_once 'db.php';
require_once './includes/header.php';

$message = "";

if (isset($_POST["event_title"])) {

    $event_title = $_POST["event_title"];
    $date        = $_POST["date"];
    $start_time  = $_POST["start_date"];  // CORRECTION: renommé pour cohérence
    $end_time    = $_POST["end_date"];    // CORRECTION: renommé pour cohérence
    $description = $_POST["description"];

    // CORRECTION: utiliser $start_time et $end_time au lieu de variables non définies
    $start_datetime = $date . " " . $start_time . ":00";
    $end_datetime   = $date . " " . $end_time . ":00";

    // Jour de la semaine (0 = dimanche, 6 = samedi)
    $jour = date('w', strtotime($date));

    if ($jour == 0 || $jour == 6) {
        $message = "Les réservations se font du lundi au vendredi et de 8h à 19h.";
    }
    // CORRECTION: comparer les heures au format time
    elseif ($start_time < "08:00" || $end_time > "19:00") {
        $message = "Les réservations se font du lundi au vendredi et de 8h à 19h.";
    }
    else {

        $sql = $pdo->prepare(
            "INSERT INTO event (event_title, start_date, end_date, description)
             VALUES (:event_title, :start_date, :end_date, :description)"
        );

        // CORRECTION: utiliser les datetimes complets au lieu des heures seules
        if ($sql->execute([
            ':event_title' => $event_title,
            ':start_date'  => $start_datetime,  // CORRECTION: utiliser datetime complet
            ':end_date'    => $end_datetime,    // CORRECTION: utiliser datetime complet
            ':description' => $description
        ])) {
            $message = "Réservation envoyée";
        } else {
            $message = "La réservation est annulée";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Réservation</title>
<link rel="stylesheet" href="reservation.css">

</head>
<body>
<div class="reservation">
    <h1>Formulaire De Réservation</h1>

    <div class="container">

        <form method="post">
            
            <?php
            if ($message != "") {
                echo "<p class='message'>$message</p>";
            }
            ?>
            <label>Titre :</label>
            <input type="text" name="event_title" required>

            <label>Heure début :</label>
            <input type="time" name="start_date" required>

            <label>Heure fin :</label>
            <input type="time" name="end_date" required>

            <label>Date :</label>
            <input type="date" name="date" required>

            <label>Description :</label>
            <textarea name="description" required></textarea>

            <button type="submit">Soumettre la réservation</button>

        </form>
    </div>
</div>

<?php
require_once './includes/footer.php';
?>