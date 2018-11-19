<?php
    // arrange a meeting
    // create a new row in the events table
    // collect the info of the event from the form, and create an insert query

    session_start();
    // gather the user inputs
    $senderUsername = $_SESSION["username"];  // session user
    $invitedUser = $_GET['invitedUser'];
    $day = $_GET['day'];
    $startTime = $_GET['startTime'];
    $endTime = $_GET['endTime'];
    // generate a random event_id, should not have a collision for small number of events
    $eventId = rand(0, 10000);
    // connect to the database
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "mycalendar";

    //Creating connection with database.
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    //Checking the connectivity with the database.
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // construct a insert query to the events table
    $query = "INSERT INTO `events` (`event_id`, `day`, `startTime`, `endTime`, `sender_username`, `reciever_username`) 
    VALUES ('".$eventId."', '".$day."', '".$startTime."', '".$endTime."', '".$senderUsername."', '".$invitedUser."')";
    // send the query
    if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
// redirect to the index page
?>
<html>
    <!--redirect back to index page-->
    <meta http-equiv="refresh" content="0; URL='./index.php'"/>
</html>
