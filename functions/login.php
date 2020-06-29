<?php
session_start();

if(isset($_POST['email']) and isset($_POST['password'])){
    require('../database/connection.php');
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = "SELECT id, email, name FROM users WHERE email = '" . $email . "' and password = '" . $password . "'"; 
    $loginResult = $conn->query($login);
    if($loginResult->num_rows > 0){
        while($row = $loginResult->fetch_assoc()) {
            $_SESSION["id"] = $row["id"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["login"] = true;
        }
        echo json_encode(array("status"=>"success", "message"=>"Seja bem-vindo!"));
    }else{
        echo json_encode(array("status"=>"error", "message"=>"Credenciais incorretas!"));
        $_SESSION["login"] = false;
    }
}
?>