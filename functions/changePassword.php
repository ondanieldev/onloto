<?php
session_start();

if(isset($_POST['password']) && isset($_SESSION['id'])){
    header('Content-Type: application/json');

    require('../database/connection.php');

    $password = $_POST['password'];
    $id = $_SESSION['id'];

    if($password == ''){
        echo json_encode(array("status"=>"error", "message"=>"Insira uma senha!"));
    }else{
        $updatePassword = "UPDATE users SET password = '" . $password . "' WHERE id = $id";

        if($conn->query($updatePassword) === TRUE){
            echo json_encode(array("status"=>"success", "message"=>"Senha alterada!"));
        }else{
            echo json_encode(array("status"=>"error", "message"=>"Senha não alterada: " . $conn->error));
        }
    }

    $conn->close();
}
?>