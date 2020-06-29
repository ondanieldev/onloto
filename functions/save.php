<?php
session_start();

if(isset($_POST['label']) && isset($_POST['games'])){
    header('Content-Type: application/json');

    require('../database/connection.php');

    $label = $_POST['label'];
    $games = explode(",", $_POST['games']);
    $id = $_SESSION["id"];

    $saveGame = "INSERT INTO games (label, userId) VALUES ('" . $label . "', " . $id . ")";

    if($conn->query($saveGame) === TRUE){
        $gameId = $conn->insert_id;
        $bets = array();
        $successCount = 0;

        for($i = 0; $i < 10; $i++){
            array_push($bets, array_slice($games, $i*15, 15));
            $saveBet = "INSERT INTO bets
            (number1,number2,number3,number4,number5,number6,number7,number8,number9,number10,number11,number12,number13,number14,number15,gameId)
            VALUES
            ("
            . $bets[$i][0] . ","
            . $bets[$i][1] . ","
            . $bets[$i][2] . "," 
            . $bets[$i][3] . "," 
            . $bets[$i][4] . "," 
            . $bets[$i][5] . "," 
            . $bets[$i][6] . "," 
            . $bets[$i][7] . "," 
            . $bets[$i][8] . "," 
            . $bets[$i][9] . "," 
            . $bets[$i][10] . "," 
            . $bets[$i][11] . "," 
            . $bets[$i][12] . "," 
            . $bets[$i][13] . "," 
            . $bets[$i][14] . ","
            . $gameId
            . ")";
            if($conn->query($saveBet) == TRUE){
                $successCount += 1;
            }
        }
    }else{
        echo json_encode(array("status"=>"error", "message"=>"Jogo não salvo: " . $conn->error));
    }

    if($successCount == 10){
        echo json_encode(array("status"=>"success", "message"=>"Jogo salvo com sucesso!"));
    }

    $conn->close();
}
?>