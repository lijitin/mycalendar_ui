
<?php
// fetches event info from the database, and stored in $events as a php array
    session_start();

    $username = $_SESSION["username"]; // the current session username
    echo "<p>current user: ".$username."</p>";  // for debugging purpose, shows current user in a p-tag

    // connect to the database at localhost
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "mycalendar";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // query the sql server's event table using the session username as a key
    $query = "SELECT * FROM `events` WHERE sender_username='".$username."'" ;
    
    $result = $conn->query($query);

    // store the fetched integers into variables
    $events;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    } else {
        echo "<p>0 outward meetings</p>";
    }

    // query for recieved messages

    $query = "SELECT * FROM `events` WHERE reciever_username='".$username."'" ;
    $result = $conn->query($query);
    $messages;
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $messages[] = $row;
        }
    }else {
        echo "<p>0 inward meetings</p>";
    }
    if(empty($events)){
        $events = "NULL";
    }
    if(empty($messages)){
        $messages = "NULL";
    }
    $conn->close();

    // pass the variables to javascript, and run the selectCells function.
?>

