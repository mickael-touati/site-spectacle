<?php
require_once 'db.php';

// Récupérer l'ID
$id = $_GET['id'];

$data = $pdo->prepare("SELECT * FROM event WHERE id = :id");
$data->bindValue(':id', $id, PDO::PARAM_INT);
$data->execute();
$event = $data->fetch();

if (!$event) {
    header('Location: index.php');
    exit;
}

require_once './includes/header.php';
?>
<link rel="stylesheet" href="detaill.css">
<section class="event-detail">
    <div class="event-detail-card">
        <h1><?= htmlspecialchars($event["event_title"]) ?></h1>
        
        <div class="event-info">
            <div class="info-item">
                <div>
                    <strong>Début</strong>
                    <p><?= date("d/m/Y à H:i", strtotime($event["start_date"])) ?></p>
                </div>
            </div>
            
            <div class="info-item">
                <div>
                    <strong>Fin</strong>
                    <p><?= date("d/m/Y à H:i", strtotime($event['end_date'])) ?></p>
                </div>
            </div>
        </div>
        
        <div class="event-description">
            <h2>Description</h2>
            <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
        </div>
        
      <div class="event-actions">
    <a href="shedule.php" class="btn-back">Retour au planning</a>
</div>
    </div>
</section>

<?php require_once './includes/footer.php'; ?>

