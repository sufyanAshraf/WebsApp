<?php
    session_start();

    require_once("database_connection.php");

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_account_type']))
    {
    	if (isset($_COOKIE['user_session']))
    	{
    		$ssid = $_COOKIE['user_session'];
    		$sql = "DELETE FROM user_session WHERE session_id = $ssid;";
    		if(!mysqli_query($conn,$sql)) {
                die("Error description: " . mysqli_error($conn));
            }
    	}

        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '',time() + (182 * 24 * 60 * 60), "/", NULL);
            }
        }

        session_destroy();
        header("Location: ../pages/login.php");
    }
    else
        header("Location: ../index.php");
?>