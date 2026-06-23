<?php

$wachtwoord = "geheim123";

$hash = password_hash($wachtwoord, PASSWORD_DEFAULT);

echo "Origineel wachtwoord: " . $wachtwoord . "<br>";
echo "Gehashte versie: " . $hash . "<br>";
echo "<br>";
echo "Laad de pagina opnieuw en kijk of de hash verandert!";

?>

