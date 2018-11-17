<html>
<body>
<?php
    //starting a session
    session_start();

    echo '<script language="javascript">';
    echo 'alert("correct.")';
    echo '</script>';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mycalendar";

    //Creating connection with database.
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Checking the connectivity with the database.
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];	
    }

    $query = "SELECT username, password FROM login_page where username="+ $username+ ", password="+$password+"";

    $sql = $query;

    

    //Executing the query

    $result = $conn->query($sql);


    if($result->num_rows >= 1){

                    $_SESSION["username"] = $username;

                    header('Location: /index.php');

    }

    else{

                    echo '<script language="javascript">';

                    echo 'alert("Invalid username or Password.")';

                    echo '</script>';

    }
?>
</body>
</html>
