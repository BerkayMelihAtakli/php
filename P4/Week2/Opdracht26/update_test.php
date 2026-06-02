<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'p3_app';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Verbinding mislukt: ' . $conn->connect_error);
}

$hoeveelheid = 42;
$id = 1;


$stmt = $conn->prepare("UPDATE water SET hoeveelheid = ? WHERE ID = ?");
if (!$stmt) {
    die('Fout bij voorbereiden: ' . $conn->error);
}

$stmt->bind_param('ii', $hoeveelheid, $id);
$stmt->execute();

if ($stmt->error) {
    echo 'Fout bij uitvoeren: ' . $stmt->error;
} else {
    echo 'UPDATE uitgevoerd. Aantal rijen aangepast: ' . $stmt->affected_rows;
}

$stmt->close();
$conn->close();

?>