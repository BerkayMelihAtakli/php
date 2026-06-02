<form method="GET" action="">
    <label for="title">Titel</label>
    <input id="title" name="title" type="text">
    <button type="submit">Opslaan</button>
</form>
<?php
$title = $_GET['title'] ?? '';
echo $title;
?>