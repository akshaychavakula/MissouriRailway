<!DOCTYPE html>
<html>
    <head>
        <title>Update Train</title>
    </head>
    <body>
        <a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchTrain.php">Search Trains</a>
        <hr>
        
        <?php
        
            if(isset($_POST['update'])){
                $trainNumber = $_POST['trainNumber'];
                include "../../dbconfig.php";
                $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
                
                if($mysqli->connect_errno){
                    echo "Failed to connect to database.";
                    exit();
                }
                
                $sql = "SELECT * FROM `trains` WHERE `trainNumber` =  '$trainNumber'";
                $result = $mysqli->query($sql) or die ($mysqli->error);
                $row = $result->fetch_array(MYSQLI_NUM) or die ($mysqli->error);
            
        ?>
        
        <form action="adminHandleUpdate.php" method="POST">
            Train Number: <br>
            <input type="text" readonly name="trainNumber" value="<?= $row[0] ?>">
            <br>
            Destination: <br>
            <input type="text" name="destination" value="<?= $row[1] ?>">
            <br>
            Start Location: <br>
            <input type="text" name="startLocation" value="<?= $row[2] ?>">
            <br>
            Days:
            <select name="days">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
            <br>
            Departure Time: 
           <select name="departureTime">
                <option value="80000">8:00</option>
                <option value="90000">9:00</option>
                <option value="100000">10:00</option>
                <option value="110000">11:00</option>
                <option value="120000">12:00</option>
                <option value="130000">13:00</option>
                <option value="140000">14:00</option>
                <option value="150000">15:00</option>
                <option value="160000">16:00</option>
                <option value="170000">17:00</option>
                <option value="180000">18:00</option>
            </select>
            <br>
            Arrival Time: 
           <select name="arrivalTime">
                <option value="80000">8:00</option>
                <option value="90000">9:00</option>
                <option value="100000">10:00</option>
                <option value="110000">11:00</option>
                <option value="120000">12:00</option>
                <option value="130000">13:00</option>
                <option value="140000">14:00</option>
                <option value="150000">15:00</option>
                <option value="160000">16:00</option>
                <option value="170000">17:00</option>
                <option value="180000">18:00</option>
            </select>
            
            <br><br>
            <input type="submit" name="submit" value="Update Train">
            
        <?php
            }
        ?>
        </form>
    </body>
</html>