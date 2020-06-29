<?php
if(isset($_POST['gameId'])){
    header('Content-Type: application/json');
    header('Refresh:0');
    
    require('../database/connection.php');

    $gameId = $_POST['gameId'];

    $removeGame = "DELETE FROM games WHERE id = " . $gameId;
    $removeBets = "DELETE FROM bets WHERE gameId = " . $gameId;

    if($conn->query($removeGame) === TRUE and $conn->query($removeBets) === TRUE){
        echo json_encode(array("status"=>"success", "message"=>"Jogo removido!"));
    }else{
        echo json_encode(array("status"=>"error", "message"=>"Erro ao remover jogo: " . $conn->error));
    }

    $conn->close();
}
?>