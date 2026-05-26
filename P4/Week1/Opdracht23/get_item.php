<?php
// Verbinding maken met de database
$conn = new mysqli("localhost", "root", "", "p3");

// Controleer of de verbinding werkt
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Haal het ID op uit de URL
$id = $_GET['id'] ?? null;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Water item</title>
</head>
<body>

<?php if ($id === null): ?>
    <p>Geen ID opgegeven in de URL.</p>

<?php else: ?>
    <?php
    // Prepared statement: veilig het item ophalen
    $stmt = $conn->prepare("SELECT * FROM water WHERE ID = ?");
    $stmt->bind_param("i", $id); // "i" = integer
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    ?>

    <?php if ($item): ?>
        <h2>Water item gevonden</h2>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($item['ID']); ?></p>
        <p><strong>Hoeveelheid:</strong> <?php echo htmlspecialchars($item['hoeveelheid']); ?></p>
        <p><strong>Eenheid:</strong> <?php echo htmlspecialchars($item['eenheid']); ?></p>
        <p><strong>Datum:</strong> <?php echo htmlspecialchars($item['datum']); ?></p>

    <?php else: ?>
        <p>Geen item gevonden met ID: <?php echo htmlspecialchars($id); ?></p>
    <?php endif; ?>

    <?php $stmt->close(); ?>
<?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>