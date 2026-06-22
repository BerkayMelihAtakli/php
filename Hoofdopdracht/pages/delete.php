<?php
session_start();

require_once __DIR__ . '/../includes/db.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    header('Location: home.php');
    exit;
}

if ($pdo) {
    $stmt = $pdo->prepare('DELETE FROM water WHERE id = ?');
    $stmt->execute([(int) $id]);
}

$_SESSION['succes'] = 'Drinkmoment succesvol verwijderd!';
header('Location: home.php');
exit;
