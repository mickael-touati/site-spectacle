<?php
session_start();
require_once 'db.php';
require_once './includes/header.php';

$message = "";

if (isset($_POST["event_title"])) {

    $event_title = $_POST["event_title"];
    $date        = $_POST["date"];
    $start_time  = $_POST["start_date"];
    $end_time    = $_POST["end_date"];
    $description = $_POST["description"];

    $jour = date('w', strtotime($date));

    if ($jour == 0 || $jour == 6) {
        $message = "Les réservations se font du lundi au vendredi et de 8h à 19h.";
    }
    elseif ($start_time < "08:00" || $end_time > "19:00") {
        $message = "Les réservations se font du lundi au vendredi et de 8h à 19h.";
    }
    else {
        $start_datetime = $date . ' ' . $start_time . ':00';
        $end_datetime   = $date . ' ' . $end_time . ':00';

        $sql = $pdo->prepare(
            "INSERT INTO event (event_title, start_date, end_date, description)
             VALUES (:event_title, :start_date, :end_date, :description)"
        );

        if ($sql->execute([
            ':event_title' => $event_title,
            ':start_date'  => $start_datetime,
            ':end_date'    => $end_datetime,
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
            <?php if ($message != "") { echo "$message"; } ?>
            
            <label>Titre :</label>
            <input type="text" name="event_title" required>

            <label>Date :</label>
            <input type="date" name="date" required>

            <label>Heure début :</label>
            <input type="time" name="start_date" required>

            <label>Heure fin :</label>
            <input type="time" name="end_date" required>

            <label>Description :</label>
            <textarea name="description" required></textarea>

            <button type="submit">Soumettre la réservation</button>
        </form>
    </div>
</div>
<?php require_once './includes/footer.php'; ?>