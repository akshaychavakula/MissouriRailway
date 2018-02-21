<?php
    //Because we dont have a login page yet
    session_start();
    $_SESSION['id'] = "2";
    $_SESSION['username'] = "admin";
    $_SESSION['role']  = "administrator";

    require_once "../core/checkLogin.php";
    checkLogin();

    if(strcmp($_SESSION['role'], "administrator") !== 0){
        //if they are not an admin then redirect to index
        header("Location: index.php");
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Search Engineer History</title>
    </head>
    <body>
        <form action="" method="POST">
            Search:
            <input type="text" name="search">
            <br><br>
            <input type="radio" name="criteria" value="0" checked>Train Number
            <input type="radio" name="criteria" value="1">Id
            <br><br>
            <input type="submit" name="submit" value="Search">
        </form>
        
        <?php
             
            if(isset($_POST['submit'])){
                include "../../dbconfig.php";
                $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
                    
                if($mysqli->connect_errno){
                    echo "Failed to connect to database";
                    exit();
                }
                if($_POST['criteria'] == 0){
                    $sql = "SELECT * FROM `engineer_history` WHERE `trainNumber` LIKE ?";
                     $stmt = $mysqli->stmt_init();
                    if(!$stmt->prepare($sql)){
                        echo "prepare failed";
                        exit();
                    }
                    $trainNumber = htmlspecialchars($_POST['search']) . "%";
                     $stmt->bind_param("s", $trainNumber);
                     $stmt->execute();
                    $result = $stmt->get_result();
                }
                else if($_POST['criteria'] == 1){
                    $sql = "SELECT * FROM `engineer_history` WHERE `id` LIKE ?";
                    $stmt = $mysqli->stmt_init();
                    if(!$stmt->prepare($sql)){
                        echo "prepare failed";
                        exit();
                    }
                        
                    $id = htmlspecialchars($_POST['search']) . "%";
                    $stmt->bind_param("s", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                }
                echo "<table>";
                echo "Number of results: " . $result->num_rows; //Display Number of results
                    
                while($fieldInfo = mysqli_fetch_field($result)){
                     echo "<th>" . $fieldInfo->name . "</th>";
                }
                while($row = $result->fetch_array(MYSQLI_NUM)){
                    echo "<tr>";
                    foreach($row as $r){
                        echo "<td>" . $r . "</td>";
                        }
                ?>
                <td>
                    <form action="adminUpdateEngHistory.php" method="POST">
                        <input type="hidden" name="id" value="<?= $row[3]?>">
                        <input type="submit" name="update" value="Update">
                    </form>
                </td>
                <?php
                    echo "</tr>";
                }
                echo "</table>";
                $mysqli->close();
            }
        ?>
        
        
    
    </body>
</html>
