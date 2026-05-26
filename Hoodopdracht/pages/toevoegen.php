<?php
$appNaam = "Healthylife";
$pageTitle = "Toevoegen - $appNaam";
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>
<main>
    <h2>Toevoegen</h2>
    <p>Vul hieronder je boekgegevens in. Deze week slaan we de data nog niet op in de database.</p>
    <form method="POST" action="verwerk.php">
        <div>
            <label for="titel">Titel</label>
            <input type="text" id="titel" name="titel" required>
        </div>
        <div>
            <label for="genre">Genre</label>
            <input type="text" id="genre" name="genre">
        </div>
        <button type="submit">Verstuur</button>
    </form>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
