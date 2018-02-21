<?php

    if(isset($_POST['delete'])){
        include "../../dbconfig.php";
        $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
        
        if($mysqli->connect_errno){
            echo "Failed to connect to database";
            exit();
        }
        
        $query = "DELETE FROM `trains` WHERE `trainNumber`=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            echo"Failed";
            exit();
        }
        $stmt->bind_param("s", $_POST['trainNumber']);
        $stmt->execute() or die ($mysql->error);
        
        echo "Delete Successful!";
    }

?>

<br><hr>
<a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchTrain.php">Search Trains</a>