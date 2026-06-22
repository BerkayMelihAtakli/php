<?php
session_start();

$appNaam   = "Healthylife";
$pageTitle = "Bewerken - $appNaam";

require_once __DIR__ . '/../includes/db.php';

// ID ophalen en valideren
$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    header('Location: home.php');
    exit;
}

// POST: update verwerken
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId      = (int) ($_POST['id'] ?? 0);
    $naam        = trim($_POST['naam'] ?? '');
    $hoeveelheid = trim($_POST['hoeveelheid'] ?? '');
    $eenheid     = trim($_POST['eenheid'] ?? '');
    $datum       = trim($_POST['datum'] ?? '');

    if ($pdo && $postId) {
        $stmt = $pdo->prepare(
            'UPDATE water SET naam = ?, hoeveelheid = ?, eenheid = ?, datum = ? WHERE id = ?'
        );
        $stmt->execute([$naam, (int) $hoeveelheid, $eenheid, $datum, $postId]);
    }

    $_SESSION['succes'] = 'Drinkmoment succesvol bijgewerkt!';
    header('Location: home.php');
    exit;
}

// GET: bestaande data ophalen
$item = null;

if ($pdo) {
    $stmt = $pdo->prepare('SELECT id, naam, hoeveelheid, eenheid, datum FROM water WHERE id = ?');
    $stmt->execute([$id]);
    $item = $stmt->fetch();
}

if (!$item) {
    header('Location: home.php');
    exit;
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>
<main>
    <h2>Drinkmoment bewerken</h2>

    <form method="POST" action="edit.php?id=<?= (int) $item['id'] ?>">
        <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">

        <div>
            <label for="naam">Naam</label>
            <input type="text" id="naam" name="naam"
                   value="<?= htmlspecialchars($item['naam']) ?>">
        </div>

        <div>
            <label for="hoeveelheid">Hoeveelheid</label>
            <input type="text" id="hoeveelheid" name="hoeveelheid"
                   value="<?= htmlspecialchars($item['hoeveelheid']) ?>">
        </div>

        <div>
            <label for="eenheid">Eenheid</label>
            <input type="text" id="eenheid" name="eenheid"
                   value="<?= htmlspecialchars($item['eenheid']) ?>">
        </div>

        <div>
            <label for="datum">Datum</label>
            <input type="date" id="datum" name="datum"
                   value="<?= htmlspecialchars($item['datum']) ?>">
        </div>

        <button type="submit">Opslaan</button>
        <a href="home.php">Annuleren</a>
    </form>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
