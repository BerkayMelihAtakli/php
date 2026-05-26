<?php
$appNaam = "Healthylife";
$pageTitle = "Home - $appNaam";

include __DIR__ . '/../includes/db.php';

$stmt = $pdo->prepare("SELECT hoeveelheid, eenheid, datum FROM water");
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>
<main>
    <h2>Healthylife</h2>
    <p>WaterTracker</p>
    <?php if (empty($items)): ?>
        <p>Er zijn nog geen items toegevoegd.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($items as $item): ?>
                <li>
                    <?= htmlspecialchars($item['hoeveelheid']) ?> <?= htmlspecialchars($item['eenheid']) ?> — <?= htmlspecialchars($item['datum']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
