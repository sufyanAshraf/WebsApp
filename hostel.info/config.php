<?php

	require_once("server/database_connection.php");
	
	//my root folder name
	$domain = "http://localhost/";
	$root_folder = "hostel.info/";
	$src_folder = $domain.$root_folder."src";

	if (isset($_COOKIE['user_session']) && isset($_COOKIE['user_id']))
	{
		$ssid = $_COOKIE['user_session'];
		$userid = $_COOKIE['user_id'];
		$sql = "SELECT user_id FROM user_session WHERE session_id = '$ssid' AND user_id = '$userid';";
		$result = mysqli_query($conn,$sql);
		if(!$result) {
            die("Error description: " . mysqli_error($conn));
        }
        if (mysqli_num_rows($result) == 1)
        {
        	$userid = mysqli_fetch_assoc($result)['user_id'];
        	$sql = "SELECT * FROM users WHERE user_id = '$userid';";
			$result = mysqli_query($conn,$sql);
			if(!$result) {
	            die("Error description: " . mysqli_error($conn));
	        }
	        if (mysqli_num_rows($result) == 1)
	        {
	        	$row = mysqli_fetch_assoc($result);
	            $_SESSION['user_id'] = $row['user_id'];
	            $_SESSION['user_email'] = $row['user_email'];
	            $_SESSION['user_account_type'] = $row['user_account_type'];
	        }
        }
	}

    //extracting root folder
    $page_reference = substr($_SERVER["SCRIPT_NAME"], 1);
    $page_reference = substr($page_reference, 0, strpos($page_reference, '/'));

	switch ($_SERVER["SCRIPT_NAME"]) {
		case "/".$page_reference."/pages/about-us.php":	
			$CURRENT_PAGE = "About"; 
			$PAGE_TITLE = "About Us";
            break;
        case "/".$page_reference."/pages/admin-panel.php":
			$CURRENT_PAGE = "Admin Panel"; 
			$PAGE_TITLE = "Admin Panel";
            break;
        case "/".$page_reference."/pages/login.php":
			$CURRENT_PAGE = "Login"; 
			$PAGE_TITLE = "Login";
            break;
        case "/".$page_reference."/pages/signup.php":
			$CURRENT_PAGE = "Signup"; 
			$PAGE_TITLE = "Signup";
			break;
		case "/".$page_reference."/pages/forgot-password.php":
			$CURRENT_PAGE = "Forgot Password"; 
			$PAGE_TITLE = "Forgot Password";
			break;
		case "/".$page_reference."/pages/contact-us.php":
			$CURRENT_PAGE = "Contact"; 
			$PAGE_TITLE = "Contact Us";
			break;
		case "/".$page_reference."/index.php":
			$CURRENT_PAGE = "Index"; 
			$PAGE_TITLE = "Home Page";
			break;
		case "/".$page_reference."/pages/hostel-admin.php":
			$CURRENT_PAGE = "Hostel Admin Panel"; 
			$PAGE_TITLE = "Hostel Admin Panel";
			break;
		case "/".$page_reference."/pages/display-hostel.php":
			$CURRENT_PAGE = "Search City"; 
			break;
		default:
			$CURRENT_PAGE = "Hostels Website";
			$PAGE_TITLE = "Hostels Website";
			break;
	}
	
?>