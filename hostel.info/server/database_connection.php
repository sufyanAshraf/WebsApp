<?php
    $conn = mysqli_connect("localhost","root","","hostel_db");
    
    if (mysqli_connect_errno())
    {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }
?>