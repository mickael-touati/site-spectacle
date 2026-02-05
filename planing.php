<?php

require_once 'db.php';

$data = $pdo->prepare("SELECT * FROM event");
$data->execute();
$events = $data->fetchAll();

?>
<section>
    <?php  
    foreach ($events as $key => $value) {
        $title = $value["event_title"];
       $date_debut = date(
        "d/m/Y à H:i:m",
        strtotime($value["start_date"])
    );

        echo "$title  <br>" ;
        echo "$date_debut  <br>" ;
    }
    ?> 
</section>