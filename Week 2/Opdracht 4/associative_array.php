<?php 

$games = [
[
    "Gamenaam" => "God Of War",
    "Platform" => "PC & PS",
    "Uur gespeeld" => "14 uur",
],
[
    "Gamenaam" => "Elden Ring",
    "Platform" => "PC & PS",
    "Uur gespeeld" => "100 uur",
]
];

?>      

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opdracht 4</title>
</head>
<body>

<h1>Mijn Games</h1>

    <h2><?php echo $games[0]['Gamenaam']; ?></h2>
    <p>Platform: <?php echo $games[0]['Platform']; ?></p>
    <p>Uur gespeeld: <?php echo $games[0]['Uur gespeeld']; ?></p>
    
    <hr>

    <h2><?php echo $games[1]['Gamenaam']; ?></h2>
    <p>Platform: <?php echo $games[1]['Platform']; ?></p>
    <p>Uur gespeeld: <?php echo $games[1]['Uur gespeeld']; ?></p>

</body>
</html>





