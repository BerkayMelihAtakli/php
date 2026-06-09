<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'p3_app';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('DELETE FROM water WHERE id = ?');
    $stmt->execute([$id]);
} catch (PDOException $e) {
    echo 'Fout bij verwijderen: ' . $e->getMessage();
    exit;
}

header('Location: index.php');
exit;
