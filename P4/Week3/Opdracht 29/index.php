<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'p3_app';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('SELECT * FROM water');
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Fout bij ophalen: ' . $e->getMessage();
    exit;
}
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Waterlijst</title>
</head>
<body>
    <h1>Waterlijst</h1>
    <?php if (empty($items)): ?>
        <p>Geen items gevonden.</p>
    <?php else: ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <?php foreach (array_keys($items[0]) as $column): ?>
                        <th><?php echo htmlspecialchars($column); ?></th>
                    <?php endforeach; ?>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <?php foreach ($item as $value): ?>
                            <td><?php echo htmlspecialchars($value); ?></td>
                        <?php endforeach; ?>
                        <?php $rowId = $item['id'] ?? $item['ID'] ?? $item['Id'] ?? null; ?>
                        <td>
                            <?php if ($rowId !== null): ?>
                                <a href="delete.php?id=<?php echo urlencode($rowId); ?>">Verwijderen</a>
                            <?php else: ?>
                                Geen id
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
