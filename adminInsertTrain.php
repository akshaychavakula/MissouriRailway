<html>
    <head>
        <title>Add Train</title>
    </head>
    <body>
        <br>
        <a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchTrain.php">Search Trains</a>
        <hr>
        <form action="" method="POST">
            Train Number: <br>
            <input type="text" name="trainNumber" required="required">
            <br>
            Destination: <br>
            <input type="text" name="destination" required="required">
            <br>
            Start Location: <br>
            <input type="text" name="startLocation" required="required">
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
            <input type="submit" name="submit">
        </form>
        <?php
        
            if(isset($_POST['submit'])){
                include "../../dbconfig.php";
                $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
                
                if($mysqli->connect_errno){
                    echo "Failed to connect to mysql";
                    exit();
                }
                $query = "SELECT * FROM `trains` WHERE `trainNumber`=?";
                $stmt = $mysqli->stmt_init();
                if(!$stmt->prepare($query)){
                    echo "Prepare failed on line 78";
                    exit();
                }
                $stmt->bind_param("s", $_POST['trainNumber']);
                $stmt->execute();
                $result = $stmt->get_result();
                $exists = $result->num_rows;
                echo "Found: ". $exists;
                
                if($exists == 0){
                    $query = "INSERT INTO `trains`(trainNumber, destination, startLocation, days, departureTime, arrivalTime) VALUES(?,?,?,?,?,?)";
                    $stmt = $mysqli->stmt_init();
                    if(!$stmt->prepare($query)){
                        echo "Prepare failed";
                        exit();
                    }
                    $stmt->bind_param("ssssii", $_POST['trainNumber'], $_POST['destination'], $_POST['startLocation'], $_POST['days'], $_POST['departureTime'], $_POST['arrivalTime']);
                    if($stmt->execute()){
                        echo "<hr>Train has been added<br>";
                    }
                    else{
                        echo "stmt failed";
                    }
                    
                    
                    
                }
                else{
                    echo "<hr>Train with same train number already exists";
                }
                $stmt->close();
                $mysqli->close();
            }
        
        ?>
    </body>
</html>