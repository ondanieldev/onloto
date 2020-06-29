<?php
    session_start();

    if(isset($_SESSION["id"])){
        require('./database/connection.php');

        $games = array();

        $getGames = "SELECT * FROM games WHERE userId = " . $_SESSION["id"];
        $gamesResult = $conn->query($getGames);
        if($gamesResult->num_rows > 0){
            while($gamesRow = $gamesResult->fetch_assoc()) {
                $gamesRow["bets"] = array();
                $getBets = "SELECT * FROM bets WHERE gameId = " . $gamesRow["id"];
                $betsResult = $conn->query($getBets);
                if($betsResult->num_rows > 0){
                    while($betsRow = $betsResult->fetch_assoc()){
                        array_push($gamesRow["bets"], $betsRow);
                    }
                }
                array_push($games, $gamesRow);
            }
        }

        $conn->close();
    }
?>