<?php
$appNaam = "Healthylife";
$pageTitle = "Item succesvol ontvangen - $appNaam";
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';

$isPosted = $_SERVER['REQUEST_METHOD'] === 'POST';
$titel = $isPosted ? trim($_POST['titel'] ?? '') : '';
$genre = $isPosted ? trim($_POST['genre'] ?? '') : '';
?>
<main>
    <?php if (! $isPosted || $titel === ''): ?>
        <h2>Formulier niet verzonden</h2>
        <p>Het formulier is niet correct verzonden. Ga terug en probeer het opnieuw.</p>
        <p><a href="toevoegen.php">Terug naar Toevoegen</a></p>
    <?php else: ?>
        <h2>Item succesvol ontvangen</h2>
        <p>Je ingevoerde gegevens zijn ontvangen:</p>
        <ul>
            <li><strong>Titel:</strong> <?= htmlspecialchars($titel) ?></li>
            <li><strong>Genre:</strong> <?= htmlspecialchars($genre) ?></li>
        </ul>
        <p>
            <a href="home.php">Terug naar Home</a> |
            <a href="toevoegen.php">Nog een item toevoegen</a>
        </p>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>