<?php
session_start();

$appNaam   = "Healthylife";
$pageTitle = "Registreren - $appNaam";


$host    = 'localhost';
$db      = 'users';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    $pdo = null;
    $dbFout = $e->getMessage();
}

$fout   = '';
$succes = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $fout = 'Vul een gebruikersnaam en wachtwoord in.';
    } elseif (!$pdo) {
        $fout = $dbFout ?? 'Kan geen verbinding maken met de database.';
    } else {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

       
        try {
            $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $stmt->execute([$username, $hashedPassword]);
            $succes = 'Registratie geslaagd! Je account is aangemaakt.';
        } catch (\PDOException $e) {
            if ($e->getCode() === '23000') {
                $fout = 'Deze gebruikersnaam is al in gebruik.';
            } else {
                $fout = 'Er is iets misgegaan. Probeer het opnieuw.';
            }
        }
    }
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>
<main>
    <h2>Registreren</h2>

    <?php if ($succes): ?>
        <p style="color: green;"><?= htmlspecialchars($succes) ?></p>
    <?php endif; ?>

    <?php if ($fout): ?>
        <p style="color: red;"><?= htmlspecialchars($fout) ?></p>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <div>
            <label for="username">Gebruikersnaam:</label><br>
            <input type="text" id="username" name="username"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                   required>
        </div>
        <br>
        <div>
            <label for="password">Wachtwoord:</label><br>
            <input type="password" id="password" name="password" required>
        </div>
        <br>
        <div>
            <button type="submit">Registreren</button>
        </div>
    </form>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
