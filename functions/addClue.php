<?php
session_start();

if(isset($_POST['number']) && isset($_POST['type']) && $_SESSION["id"] == 1){
    header('Content-Type: application/json');

    require('../database/connection.php');

    $number = $_POST['number'];
    $type = $_POST['type'];

    $saveClue = "INSERT INTO tips (number, type) VALUES ('" . $number . "', '" . $type . "')";

    if($conn->query($saveClue) === TRUE){
        echo json_encode(array("status"=>"success", "message"=>"Dica adicionada com sucesso!"));
    }else{
        echo json_encode(array("status"=>"error", "message"=>"Dica não salva: " . $conn->error));
    }

    $conn->close();
}
?>