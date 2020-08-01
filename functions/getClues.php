<?php
    session_start();

    if(isset($_SESSION["id"])){
        require('./database/connection.php');

        $clueMoreNumbers = array();
        $clueLessNumbers = array();

        $getClues = "SELECT * FROM tips";
        $cluesResult = $conn->query($getClues);
        if($cluesResult->num_rows > 0){
            while($cluesRow = $cluesResult->fetch_assoc()) {
                if($cluesRow["type"] == "m")
                    array_push($clueMoreNumbers, $cluesRow["number"]);
                else if($cluesRow["type"] == "l")
                    array_push($clueLessNumbers, $cluesRow["number"]);
            }
        }

        $conn->close();
    }
?>