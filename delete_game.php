<?php

use Doctrine\DBAL\DriverManager;

$connectionParams = [
    'url' => 'sqlite:///../db.sqlite',
];

if (isset($_POST['deleteId'])) {
    try {
        $conn = DriverManager::getConnection($connectionParams);

        $conn->delete('runde', [
            'rundeId' => $_POST['deleteId'],
        ]);
        header('Location: /index.php');
    } catch (\Doctrine\DBAL\Exception $e) {
        echo $e->getMessage();
    }
}

$games = null;
try {
    $conn = DriverManager::getConnection($connectionParams);

    $games = $conn->fetchAllAssociative('SELECT * FROM RUNDE');
} catch (\Doctrine\DBAL\Exception $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>USRPS Championship 2020 Delete</title>

    <style>
        body {
            padding: 25px;
        }
    </style>
</head>
<body>
<h1>Lösche Runden anhand deren IDs</h1>
<form action="delete_game.php" method="post">
    <select class="form-select" name="deleteId" aria-label="Lösche eine Runde" required>
        <option disabled selected>Wähle eine Runde aus</option>
        <?php
        foreach ($games as $game) {
            echo '<option value="' . $game['rundeId'] . '"> ID: ' . $game['rundeId'] . ', Zeitpunkt: ' . $game['zeitpunkt'] . '</option>';
        }
        ?>
    </select>
    <br>
    <button type="submit" class="btn btn-danger">Löschen</button>
    <a href="../index.php">
        <button type="button" class="btn btn-secondary">Zurück</button>
    </a>
</form>
</body>
</html>