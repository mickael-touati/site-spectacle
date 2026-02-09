<?php

require_once 'db.php';

$data = $pdo->prepare("SELECT * FROM event");
$data->execute();
$events = $data->fetchAll();


require_once './includes/header.php';

?>

<section>
    <?php  
    foreach ($events as $key => $value) {
        $id = $value['id'];
        $title = $value["event_title"];
        $date_debut = date("d/m/Y à H:i", strtotime($value["start_date"]));
    ?>
        <div class="event-item">
            <h3><?= htmlspecialchars($title) ?></h3>
            <p> <?= $date_debut ?></p>
            <a href='reservation_detail.php?id=<?= $id ?>'>Voir plus</a>
        </div>
    <?php  
    }
    ?> 
</section>
<link rel="stylesheet" href="shedule.css">