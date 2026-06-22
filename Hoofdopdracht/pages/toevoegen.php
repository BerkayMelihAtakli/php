<?php
$appNaam   = "Healthylife";
$pageTitle = "Toevoegen - $appNaam";

$fouten  = [];
$succes  = false;
$naam     = '';
$hoeveelheid = '';
$eenheid  = 'ml';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam        = trim($_POST['naam'] ?? '');
    $hoeveelheid = trim($_POST['hoeveelheid'] ?? '');
    $eenheid     = trim($_POST['eenheid'] ?? '');

    
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
    } elseif (strlen($eenheid) < 1) {
        $fouten[] = 'Eenheid moet minimaal 1 teken bevatten.';
    } elseif (strlen($eenheid) > 10) {
        $fouten[] = 'Eenheid mag maximaal 10 tekens bevatten.';
    }

    if (empty($fouten)) {
        $succes = true;
    }
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>
<main>
    <h2>Drinkmoment toevoegen</h2>

    <?php if (!empty($fouten)): ?>
        <div class="fouten">
            <p><strong>Controleer de volgende punten:</strong></p>
            <ul>
                <?php foreach ($fouten as $fout): ?>
                    <li><?= htmlspecialchars($fout) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($succes): ?>
        <div class="succes">
            <p><strong>Drinkmoment succesvol toegevoegd!</strong></p>
            <ul>
                <li><strong>Naam:</strong> <?= htmlspecialchars($naam) ?></li>
                <li><strong>Hoeveelheid:</strong> <?= htmlspecialchars($hoeveelheid) ?> <?= htmlspecialchars($eenheid) ?></li>
            </ul>
            <p><a href="toevoegen.php">Nog een drinkmoment toevoegen</a></p>
        </div>
    <?php else: ?>
        <form method="POST" action="toevoegen.php">
            <div>
                <label for="naam">Naam</label>
                <input type="text" id="naam" name="naam"
                       value="<?= htmlspecialchars($naam) ?>">
            </div>

            <div>
                <label for="hoeveelheid">Hoeveelheid</label>
                <input type="text" id="hoeveelheid" name="hoeveelheid"
                       value="<?= htmlspecialchars($hoeveelheid) ?>">
            </div>

            <div>
                <label for="eenheid">Eenheid</label>
                <input type="text" id="eenheid" name="eenheid"
                       value="<?= htmlspecialchars($eenheid) ?>">
            </div>

            <button type="submit">Verstuur</button>
        </form>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
