<!DOCTYPE html>
<html>
    <head>
        <title>Assign to Train</title>
    </head>
    <body>
        <a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchEquipment.php">Search Equipment</a>
        <hr>
        
        <?php
        
            if(isset($_POST['assign'])){
                $serialNumber = $_POST['serialNumber'];
                include "../../dbconfig.php";
                $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
                
                if($mysqli->connect_errno){
                    echo "Failed to connect to database.";
                    exit();
                }
                
                $sql = "SELECT * FROM `equipment` WHERE `serialNumber` =  '$serialNumber'";
                $result = $mysqli->query($sql) or die ($mysqli->error);
                $row = $result->fetch_array(MYSQLI_NUM) or die ($mysqli->error);
        ?>
        <form action="adminHandleAssign.php" method="POST">
            Serial Number: <br>
            <input type="text" readonly name="serialNumber" value="<?= $row[0] ?>">
            <br>
            Load Capacity: <br>
            <input type="text" name="loadCapacity" value="<?= $row[1]?>">
            <br>
            Type: <br>
            <input type="text" name="type" value="<?= $row[2]?>">
            <br>
            Location: <br>
            <input type="text" name="location" value="<?= $row[3]?>">
            <br>
            Manufacurer: <br>
            <input type="text" name="manufacturer" value="<?= $row[4]?>">
            <br>
            Price: <br>
            <input type="text" name="price" value="<?= $row[5]?>">
            <br>
            Id: <br>
            <input type="text" name="id" value="<?= $row[7]?>">
            <br>
            Train Number: <br>
            <input type="text" name="trainNumber" value="<?= $row[6]?>">
            <br><br>
            <input type="submit" name="submit" value="Update">
        <?php
            }  
        ?>
        </form>
    </body>
</html>