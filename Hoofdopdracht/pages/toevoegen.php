<?php
session_start();

$appNaam   = "Healthylife";
$pageTitle = "Toevoegen - $appNaam";

require_once __DIR__ . '/../includes/db.php';

$fouten      = [];
$naam        = '';
$hoeveelheid = '';
$eenheid     = 'ml';
$datum       = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam        = trim($_POST['naam'] ?? '');
    $hoeveelheid = trim($_POST['hoeveelheid'] ?? '');
    $eenheid     = trim($_POST['eenheid'] ?? '');
    $datum       = trim($_POST['datum'] ?? '');

   
    if ($naam === '') {
        $fouten[] = 'Naam is verplicht.';
    } elseif (strlen($naam) < 3) {
        $fouten[] = 'Naam moet minimaal 3 tekens bevatten.';
    } elseif (strlen($naam) > 50) {
        $fouten[] = 'Naam mag maximaal 50 tekens bevatten.';
    }

   
    if ($hoeveelheid === '') {
        $fouten[] = 'Hoeveelheid is verplicht.';
    } elseif (!is_numeric($hoeveelheid)) {
        $fouten[] = 'Hoeveelheid moet een getal zijn (bijv. 250).';
    } elseif ((float)$hoeveelheid <= 0) {
        $fouten[] = 'Hoeveelheid moet groter zijn dan 0.';
    }

    
    if ($eenheid === '') {
        $fouten[] = 'Eenheid is verplicht.';
    } elseif (strlen($eenheid) > 10) {
        $fouten[] = 'Eenheid mag maximaal 10 tekens bevatten.';
    }

    if (!empty($fouten)) {
        $_SESSION['fouten'] = $fouten;
        header('Location: toevoegen.php');
        exit;
    }

    if (!$pdo) {
        $_SESSION['fouten'] = ['Kan geen verbinding maken met de database.'];
        header('Location: toevoegen.php');
        exit;
    }

    $stmt = $pdo->prepare(
        'INSERT INTO water (naam, hoeveelheid, eenheid, datum) VALUES (:naam, :hoeveelheid, :eenheid, :datum)'
    );
    $stmt->execute([
        ':naam'        => $naam,
        ':hoeveelheid' => (int) $hoeveelheid,
        ':eenheid'     => $eenheid,
        ':datum'       => $datum,
    ]);

    $_SESSION['succes'] = 'Drinkmoment succesvol opgeslagen!';
    header('Location: home.php');
    exit;
}

// Flash messages ophalen en wissen
$flashFouten = $_SESSION['fouten'] ?? [];
$flashSucces = $_SESSION['succes'] ?? '';
unset($_SESSION['fouten'], $_SESSION['succes']);

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>
<main>
    <h2>Drinkmoment toevoegen</h2>

    <?php if (!empty($flashFouten)): ?>
        <div class="alert alert-error">
            <p><strong>Controleer de volgende punten:</strong></p>
            <ul>
                <?php foreach ($flashFouten as $fout): ?>
                    <li><?= htmlspecialchars($fout) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($flashSucces): ?>
        <div class="alert alert-succes">
            <p><?= htmlspecialchars($flashSucces) ?></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="toevoegen.php">
        <div>
            <label for="naam">Naam</label>
            <input type="text" id="naam" name="naam" value="">
        </div>

        <div>
            <label for="hoeveelheid">Hoeveelheid</label>
            <input type="text" id="hoeveelheid" name="hoeveelheid" value="">
        </div>

        <div>
            <label for="eenheid">Eenheid</label>
            <input type="text" id="eenheid" name="eenheid" value="ml">
        </div>

        <div>
            <label for="datum">Datum</label>
            <input type="date" id="datum" name="datum"
                   value="<?= htmlspecialchars($datum) ?>">
        </div>

        <button type="submit">Opslaan</button>
    </form>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
