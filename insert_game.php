<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Game</title>
    <style>
        form {
            margin-left: 17%;
        }
        h1 {
            margin-top: 50px;
            font-family: Arial, serif;
            text-align: center;
            color: green;
        }
        .spieler {
            margin-top: 10px;
        }
        .auswahl {
            margin-top: 10px;
        }
        button{
            margin-top: 12px;
        }
    </style>
</head>
<body>

<h1>Füge einen neuen Eintrag hinzu</h1>

<form action="insert_game.php" method="post">
    <div class="spieler">
        <label for="spieler1">1. Spieler</label>
        <input type="text" id="spieler1" name="spieler1" required>
    </div>

    <div class="spieler">
        <label for="spieler2">2. Spieler</label>
        <input type="text" id="spieler2" name="spieler2" required>
    </div>

    <div class="auswahl">
        <span id="auswahlSpieler1">Auswahl des 1. Spielers: </span>
        <select name="symbol1" required>
            <option value="" selected disabled>Symbol des 1. Spielers</option>
            <option value="Schere">Schere</option>
            <option value="Stein">Stein</option>
            <option value="Papier">Papier</option>
        </select>
    </div>

    <div class="auswahl">
        <span id="auswahlSpieler1">Auswahl des 2. Spielers: </span>
        <select name="symbol2" required>
            <option value="" selected disabled>Symbol des 2. Spielers</option>
            <option value="Schere">Schere</option>
            <option value="Stein">Stein</option>
            <option value="Papier">Papier</option>
        </select>
    </div>

    <button type="submit">Hinzufügen</button>
    <a href="index.php">
        <button type="button">Zurück</button>
    </a>
</form>
</body>
</html>

<?php

use Doctrine\DBAL\DriverManager;

$connectionParams = [
    'url' => 'sqlite://db.sqlite',
];

if (isset($_POST['spieler1'])) {
    try {
        $conn = DriverManager::getConnection($connectionParams);

        $currentDate = new DateTime('now', new DateTimeZone('Europe/Vienna'));

        //Anpassung an db notwendig
        $conn->insert('RUNDE', [
            'zeitpunkt' => $currentDate->format('Y-m-d H:i'),
            'spieler1' => $_POST['spieler1'],
            'spieler2' => $_POST['spieler2'],
            'symbol1' => $_POST['symbol1'],
            'symbol2' => $_POST['symbol2']
        ]);
        header('Location: /index.php');
    } catch (\Doctrine\DBAL\Exception $e) {
        echo $e->getMessage();
    }
}