<?php
$id = $_GET['id'] ?? null;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Get ID</title>
</head>
<body>

<?php if ($id !== null): ?>
    <p>Geselecteerd item: <?php echo htmlspecialchars($id); ?></p>
<?php else: ?>
    <p>Geen ID opgegeven in de URL.</p>
<?php endif; ?>

</body>
</html>