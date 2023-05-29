<?php 
    // Connect to the database
    $servername = 'localhost';
    $username = 'chiefJurist';
    $password = '#Chibueze2003';
    $dbname = 'scandiweb';
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Checking the connection
    if (!$conn) {
        echo "connection error" . mysqli_connect_error();
    }
?>