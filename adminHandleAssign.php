<?php

    if(isset($_POST['submit'])){
        include "../../dbconfig.php";
        $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
        
        if($mysqli->connect_errno){
            echo "Failed to connect to database";
            exit();
        }
        
        $query = "UPDATE `equipment` SET `trainNumber`=?, `loadCapacity`=?, `type`=?, `location`=?, `manufacturer`=?, `price`=? WHERE `serialNumber`=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            echo "Failed";
            exit();
        }
        
        $stmt->bind_param("sssssss", $_POST['trainNumber'], $_POST['loadCapacity'], $_POST['type'], $_POST['location'], $_POST['manufacturer'], $_POST['price'], $_POST['serialNumber']);
        $stmt->execute() or die ($mysqli->error);
        echo ("Equipment has been updated!");
    }
?>

<br><hr>
<a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchEquipment.php">Search Equipment</a>