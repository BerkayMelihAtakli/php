<?php
$pageTitle = $pageTitle ?? "Healthylife Tracker";
$appNaam = $appNaam ?? "Healthylife";
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
</head>
<body>
<header>
    <h1><?= htmlspecialchars($appNaam) ?></h1>
</header>
