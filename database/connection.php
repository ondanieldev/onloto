<?php
$server = "localhost";
// $server = "162.241.2.131:3306";
$user = "voceal51_lotofacildominanteadmin";
$pass = "wu*fG7HEKOTc";
$db = "voceal51_lotofacildominante";
$conn = new mysqli($server, $user, $pass, $db);
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>