<?php

    
    echo "<h1>RPS</h1>";

try{
    include 'readDB.php';
$stmtGames = $conn->prepare("
select pk_gameID gameID, p.username user1, h1.hand hand1, p2.username user2, h2.hand hand2, datum datum, zeit zeit
    from game
            join player p on game.fk_userID1 = p.pk_playerID
            join player p2 on game.fk_userID2 = p2.pk_playerID
            join hand h1 on game.fk_handValue1 = h1.pk_handID
            join hand h2 on game.fk_handValue2 = h2.pk_handID
    order by pk_gameID;");
            $stmtGames->execute();
            while ($lines = $stmtGames->fetch()) {
               echo "<h2>Game".$lines['gameID']."</h2>";
               echo ' <p>Player '.$lines['user1'].' vs Player '.$lines['user2'].'  | '.$lines['datum'].' '.$lines['zeit'].'</p>'.
               '<p>'.$lines['user1'].': '.$lines['hand1'].' | '.$lines['user2'].': '.$lines['hand2'];
            }

        
        echo '<form method="post">
        <label for="pid1">Player1</label>
        <input type="text" id="pid1" name="pid1"><br><br>

        <label for="hid1">Hand1</label>
        <input type="text" id="hid1" name="hid1"><br><br>

        <label for="pid2">Player2</label>
        <input type="text" id="pid2" name="pid2"><br><br>

        <label for="hid2">Hand2</label>
        <input type="text" id="hid2" name="hid2"><br><br>

        <input type="submit" value="Submit">
      </form>';

      if (isset($_POST["submit"])) {
        $pid1 = $_POST["pid1"];
        $pid2 = $_POST["pid2"];
        $hid1 = $_POST["hid1"];
        $hid2 = $_POST["hid2"];

        $stmtGames = $conn->prepare("insert into game(fk_userID1, fk_handValue1, fk_userID2, fk_handValue2, datum, zeit)
        values (".$pid1.",".$hid1.",".$pid1.",".$hid1.",\'2022-05-31\', \'02:01\');");
            $stmtGames->execute();
        echo "insert into game(fk_userID1, fk_handValue1, fk_userID2, fk_handValue2, datum, zeit)
        values (".$pid1.",".$hid1.",".$pid1.",".$hid1.",\'2022-05-31\', \'02:01\');";
        
      }
        }catch (Exception $e) {
            die("Error somewhere");
        }

