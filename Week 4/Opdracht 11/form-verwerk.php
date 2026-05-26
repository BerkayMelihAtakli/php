<form method="POST" action="">
    <label for="title">Titel</label>
    <input id="title" name="title" type="text" required>
    
    <button type="submit" name="submit">Opslaan</button>
</form>

<?php
if (isset($_POST['submit'])) {
    
    
    $title = $_POST['title'];

    echo "<p>Ingevoerde titel: " . htmlspecialchars($title) . "</p>";
}
?>