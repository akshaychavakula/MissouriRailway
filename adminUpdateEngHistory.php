<!DOCTYPE html>
<html>
    <head>
        <title>Update Engineer History</title>
    </head>
    <body>
        <a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchEngHistory.php">Search Engineer History</a>
        <hr>
        
        <?php
        
            if(isset($_POST['update'])){
                $id = $_POST['id'];
                include "../../dbconfig.php";
                $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
                
                if($mysqli->connect_errno){
                    echo "Failed to connect to database.";
                    exit();
                }
                
                $sql = "SELECT * FROM `engineer_history` WHERE `id` =  '$id'";
                $result = $mysqli->query($sql) or die ($mysqli->error);
                $row = $result->fetch_array(MYSQLI_NUM) or die ($mysqli->error);
            
        ?>
        
        <form action="adminHandleEngHistory.php" method="POST">
            Id: <br>
            <input type="text" readonly name="id" value="<?= $row[3]?>">
            <br>
            Start Date: <br>
            <input type="text" name="startDate" value="<?= $row[0]?>">
            <br>
            End Date: <br>
            <input type="text" name="endDate" value="<?= $row[1]?>">
            <br>
            Travel Time: <br>
            <input type="text" name="travelTime" value="<?= $row[2]?>">
            <br>
            Train Number: <br>
            <input type="text" name="trainNumber" value="<?= $row[4]?>">
            <br><br>
            <input type="submit" name="submit" value="Update">
        
        
        <?php
            }
        ?>
        
        </form>
        
    </body>
</html>