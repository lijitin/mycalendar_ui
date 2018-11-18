<?php

    session_start();
    // get the event id from the form
    $event_id = $_GET['event_id'];
   
    // connect to the database
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "mycalendar";

    // Creating connection with database.
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Checking the connectivity with the database.
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // query for the row with the event_id
    $query = "SELECT * FROM `events` WHERE event_id='".$event_id."'";
    // this should only return one row
    // extract the info
    $result = $conn->query($query);

    $events;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    } else {
        echo "<p>could not find with the event_id</p>";
    }
    echo print_r($events);
    // update the database on the row, and set null to the reciever_username of event_id
    $query = "UPDATE `events` SET reciever_username='"."NULL"."' WHERE event_id='".$event_id."'";
    if($conn->query($query) === TRUE){
        echo "record update successful. (1)";
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $day = $events[0]['day'];
    $startTime = $events[0]['startTime'];
    $endTime = $events[0]['endTime'];
    $senderUsername = $_SESSION['username'];

    $query = "INSERT INTO `events` (`event_id`, `day`, `startTime`, `endTime`, `sender_username`, `reciever_username`) 
    VALUES ('".$event_id."', '".$day."', '".$startTime."', '".$endTime."', '".$senderUsername."', '"."NULL"."')";
    // send the query
    if($conn->query($query) === TRUE){
        echo "record update successful. (2)";
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
   

    $conn->close();
// redirect to the index page
?>
<html>
    <meta http-equiv="refresh" content="0; URL='./index.php'" />
</html>

