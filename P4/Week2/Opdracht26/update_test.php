<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "p3_app";

$datum = "2026-06-02";
$id = 1;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE water SET datum = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$datum, $id]);

    echo "Update uitgevoerd. Aantal gewijzigde rijen: " . $stmt->rowCount();
} catch (PDOException $e) {
    echo "Fout bij uitvoeren van de query: " . $e->getMessage();
}

