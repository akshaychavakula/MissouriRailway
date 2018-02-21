<?php

     if(isset($_POST['submit'])){
        include "../../dbconfig.php";
        $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
        
        if($mysqli->connect_errno){
            echo "Failed to connect to database";
            exit();
        }
        
        $query = "UPDATE `conductor_history` SET `startDate`=?, `endDate`=?,`trainNumber`=? WHERE `id`=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            echo "Failed";
            exit();
        }
        
        $stmt->bind_param("ssss", $_POST['startDate'], $_POST['endDate'], $_POST['trainNumber'], $_POST['id']);
        $stmt->execute() or die ($mysqli->error);
        echo ("Conductor history has been updated!");
    }


?>

<br><hr>
<a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchCondHistory.php">Search Conductor History</a>