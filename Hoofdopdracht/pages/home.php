<?php
session_start();

$appNaam   = "Healthylife";
$pageTitle = "Home - $appNaam";

require_once __DIR__ . '/../includes/db.php';


$flashSucces = $_SESSION['succes'] ?? '';
$flashFout   = $_SESSION['fout']   ?? '';
unset($_SESSION['succes'], $_SESSION['fout']);

$items   = [];
$dbError = '';

if ($pdo) {
    try {
        $stmt = $pdo->prepare('SELECT id, naam, hoeveelheid, eenheid, datum FROM water ORDER BY id ASC');
        $stmt->execute();
        $items = $stmt->fetchAll();
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

    <?php if ($flashSucces): ?>
        <div class="alert alert-succes">
            <p><?= htmlspecialchars($flashSucces) ?></p>
        </div>
    <?php endif; ?>

    <?php if ($flashFout): ?>
        <div class="alert alert-error">
            <p><?= htmlspecialchars($flashFout) ?></p>
        </div>
    <?php endif; ?>

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
                    <th>Datum</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id']) ?></td>
                        <td><?= htmlspecialchars($item['naam']) ?></td>
                        <td><?= htmlspecialchars($item['hoeveelheid']) ?></td>
                        <td><?= htmlspecialchars($item['eenheid']) ?></td>
                        <td><?= htmlspecialchars($item['datum']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= (int) $item['id'] ?>">Bewerken</a>
                            <a href="delete.php?id=<?= (int) $item['id'] ?>"
                               onclick="return confirm('Weet je zeker dat je dit item wilt verwijderen?')">Verwijderen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Er zijn nog geen items toegevoegd.</p>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
