<?php

// Mijn mini-app wordt een: Waterinnametracker tracker.

$appNaam = "Healthylife";
$trackerType = "Waterinnametracker";
$tagline = "3 Liter water is alles voor je gezond leven.";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoofdopdracht 1</title>
</head>
<body>
    <h1>Hoi, welkom bij <?= $appNaam ?></h1> 
    <h1>Dit is jouw <?= $trackerType ?></h1> 
    <h1><?= $tagline ?></h1> 

    <footer>
        <hr>
        <p>&copy; <?= date("Y") ?> <?= $appNaam ?></p>
    </footer>
    
</body>
</html>