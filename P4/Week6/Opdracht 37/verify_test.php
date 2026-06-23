<?php
$wachtwoord = "geheim123";
$hash = password_hash($wachtwoord, PASSWORD_DEFAULT);

echo "<p>Hash: " . $hash . "</p>";

$test = "geheim123";

if (password_verify($test, $hash)) {
    echo "<p style='color: green;'>Correct wachtwoord</p>";
} else {
    echo "<p style='color: red;'>Onjuist wachtwoord</p>";
}


$testFout = "verkeerd456";

if (password_verify($testFout, $hash)) {
    echo "<p style='color: green;'>Correct wachtwoord</p>";
} else {
    echo "<p style='color: red;'>Onjuist wachtwoord</p>";
}
?>
