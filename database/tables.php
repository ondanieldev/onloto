<?php
require('./database/connection.php');

$createTableUsers = "CREATE TABLE IF NOT EXISTS users (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
name VARCHAR(255) NOT NULL
)";

$createTableGames = "CREATE TABLE IF NOT EXISTS games (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
label VARCHAR(255) NOT NULL,
userId INT UNSIGNED NOT NULL,
FOREIGN KEY (userId) REFERENCES users(id)
)";

$createTableBets = "CREATE TABLE IF NOT EXISTS bets (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
number1 INT(2) NOT NULL,
number2 INT(2) NOT NULL,
number3 INT(2) NOT NULL,
number4 INT(2) NOT NULL,
number5 INT(2) NOT NULL,
number6 INT(2) NOT NULL,
number7 INT(2) NOT NULL,
number8 INT(2) NOT NULL,
number9 INT(2) NOT NULL,
number10 INT(2) NOT NULL,
number11 INT(2) NOT NULL,
number12 INT(2) NOT NULL,
number13 INT(2) NOT NULL,
number14 INT(2) NOT NULL,
number15 INT(2) NOT NULL,
gameId INT UNSIGNED NOT NULL,
FOREIGN KEY (gameId) REFERENCES games(id)
)";

$createTableTips = "CREATE TABLE IF NOT EXISTS tips (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
number INT(2) NOT NULL,
type VARCHAR(1) NOT NULL
)";

$conn->query($createTableUsers);
$conn->query($createTableGames);
$conn->query($createTableBets);
$conn->query($createTableTips);

$conn->close();
?>