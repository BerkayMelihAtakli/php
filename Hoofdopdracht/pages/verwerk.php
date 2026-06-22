<?php
$appNaam = "Healthylife";
$pageTitle = "Item succesvol ontvangen - $appNaam";
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';

$isPosted = $_SERVER['REQUEST_METHOD'] === 'POST';
$naam = $isPosted ? trim($_POST['naam'] ?? '') : '';
$hoeveelheid = $isPosted ? trim($_POST['hoeveelheid'] ?? '') : '';
$eenheid = $isPosted ? trim($_POST['eenheid'] ?? '') : '';
?>
<main>
    <?php if (! $isPosted || $naam === ''): ?>
        <h2>Formulier niet verzonden</h2>
        <p>Het formulier is niet correct verzonden. Ga terug en probeer het opnieuw.</p>
        <p><a href="toevoegen.php">Terug naar Toevoegen</a></p>
    <?php else: ?>
        <h2>Item succesvol ontvangen</h2>
        <p>Je ingevoerde gegevens zijn ontvangen:</p>
        <ul>
            <li><strong>Naam:</strong> <?= htmlspecialchars($naam) ?></li>
            <li><strong>Hoeveelheid:</strong> <?= htmlspecialchars($hoeveelheid) ?></li>
            <li><strong>Eenheid:</strong> <?= htmlspecialchars($eenheid) ?></li>
        </ul>
        <p>
            <a href="home.php">Terug naar Home</a> |
            <a href="toevoegen.php">Nog een item toevoegen</a>
        </p>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>