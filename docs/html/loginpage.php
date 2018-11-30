<html>
<body>
<?php
    //starting a session
    session_start();

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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $pw = $_POST["password"];	
    }

    $query = "SELECT username, pw FROM loginInfo WHERE username='".$username."' AND pw='".$pw."'";

    $sql = $query;

    //Executing the query

    $result = $conn->query($sql);


    if($result->num_rows >= 1){ // query matched one or more
        $_SESSION["username"] = $username;  // keep track of the username
        header('Location: /cs487/mycalendar_ui/docs/html/index.php');
    } else{
        echo '<script language="javascript">';
        echo 'alert("Invalid username or Password.")';
        echo '</script>';
        // redirect to login page
        echo '<script language="javascript">';
        echo 'window.location.replace("./login.html");';
        echo'</script>';
    }
    echo "SQL Query: ".$query;


    $conn->close();

?>
</body>
</html>
