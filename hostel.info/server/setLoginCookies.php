<?php

    if(isset($_GET['ssid']) && isset($_GET['uid']))
    {
        setcookie('user_session', $_GET['ssid'], time() + (182 * 24 * 60 * 60), "/", NULL);
        setcookie('user_id', $_GET['uid'], time() + (182 * 24 * 60 * 60), "/", NULL);
    }

    header("Location: ../index.php");
?>