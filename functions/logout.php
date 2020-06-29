<?php
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();
    header('Refresh:0');
    header("location: ../index.php");
    exit();
?>