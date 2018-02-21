<?php
    
    if(isset($_POST['submit'])){
        include "../../dbconfig.php";
        $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
        
        if($mysqli->connect_errno){
            echo "Failed to connect to database";
            exit();
        }
        
        $query = "UPDATE `trains` SET `destination`=?, `startLocation`=?, `days`=?, `departureTime`=?, `arrivalTime`=? WHERE `trainNumber`=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            echo "Failed";
            exit();
        }
        
        $stmt->bind_param("sssiis", $_POST['destination'], $_POST['startLocation'], $_POST['days'], $_POST['departureTime'], $_POST['arrivalTime'], $_POST['trainNumber']);
        $stmt->execute() or die ($mysqli->error);
        echo ("Update Sucessful!");
    }
?>

<br><hr>
<a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchTrain.php">Search Trains</a>