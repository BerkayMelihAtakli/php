<?php
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST Test</title>
</head>
<body>
    <h1>POST Test</h1>
    
    <form method="POST">
        <label for="titel">Titel:</label>
        <input type="text" name="titel" id="titel">
        <button type="submit">Versturen</button>
    </form>
    
    <hr>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h2>POST Gegevens:</h2>";
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        
        if (isset($_POST['titel'])) {
            echo "<h3>Waarde van titel: " . htmlspecialchars($_POST['titel']) . "</h3>";
        }
    }
    ?>
</body>
</html>
