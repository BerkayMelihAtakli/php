<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "p3_games";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$games = $conn->prepare("SELECT title FROM games");
$games->execute();
$bakje_games = $games->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Games</h2>";
if (count($bakje_games) === 0) {
  echo "<p>Er zijn nog geen games gevonden.</p>";
} else {
  echo "<ul>";

  foreach ($bakje_games as $game) {
    echo "<li>" . htmlspecialchars($game['title']) . "</li>";
  }

  echo "</ul>";
}

?>