<?php
$appNaam = "Healthylife";
$pageTitle = "Home - $appNaam";

include __DIR__ . '/../includes/db.php';

$items = [];
$dbError = '';

if ($pdo) {
    try {
        $statement = $pdo->prepare('SELECT id, naam, hoeveelheid, eenheid FROM water ORDER BY id ASC');
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        $dbError = 'Er is iets mis met de database. Controleer of de tabel bestaat.';
    }
} else {
    $dbError = $dbConnectionError ?? 'Kan geen verbinding maken met de database.';
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>
<main>
    <h2>Healthylife Tracker</h2>
    <p>Hier zie je een overzicht van je drinkmomenten.</p>

    <?php if ($dbError): ?>
        <p class="error"><?= htmlspecialchars($dbError) ?></p>
    <?php elseif (!empty($items)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Hoeveelheid</th>
                    <th>Eenheid</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id']) ?></td>
                        <td><?= htmlspecialchars($item['naam']) ?></td>
                        <td><?= htmlspecialchars($item['hoeveelheid']) ?></td>
                        <td><?= htmlspecialchars($item['eenheid']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Er zijn nog geen items toegevoegd.</p>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
