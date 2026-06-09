<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'p3_app';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = 1; 
    $sql = 'DELETE FROM water WHERE id = ?';

    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    echo "Delete uitgevoerd voor id = $id";
} catch (PDOException $e) {
    echo 'Fout bij verwijderen: ' . $e->getMessage();
}
