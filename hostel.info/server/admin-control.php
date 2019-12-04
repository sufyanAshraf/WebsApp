<?php

	include_once "database_connection.php";
	include_once "functions.php";
	session_start();

	if(!isset($_SESSION['user_id'])) {
		header("Location: ../index.php");
		die();
	}
	
	if (isset($_GET["accept_hostel_req"]))
	{
		$id = $_GET['accept_hostel_req'];

		$sql = "SELECT * FROM pending_hostels WHERE hostel_id = $id;";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) != 0)
		{
			$assoc = mysqli_fetch_assoc($result);
			$pendingID = $assoc['hostel_id'];
			$name = $assoc['hostel_name'];
			$city = $assoc['hostel_city'];
			$addr = $assoc['hostel_address'];
			$rooms = $assoc['hostel_rooms'];
			$owner = $assoc['hostel_owner'];
			$extras = $assoc['hostel_extras'];
			$img = $assoc['hostel_img'];

			$sql = "INSERT INTO `hostels` ( hostel_name, hostel_city, hostel_address, hostel_rooms, hostel_extras, hostel_owner, hostel_img ) VALUES ('$name', '$city', '$addr', '$rooms', '$extras', '$owner', '$img');";

			if(!mysqli_query($conn, $sql))
			{
				$_SESSION['admin_panel_msg'] = "An error occurred!";
				header("Location: ../pages/admin-panel.php");
				exit();
			}

			$newID = $conn->insert_id;
			$sql = "UPDATE hostels_images SET hostel_id = '$newID' WHERE pending_hostel_id = '$pendingID'";
			mysqli_query($conn, $sql);
			$sql = "UPDATE hostels_images SET pending_hostel_id = '0' WHERE pending_hostel_id = '$pendingID'";
			mysqli_query($conn, $sql);

			$sql = "DELETE FROM pending_hostels WHERE hostel_id = $pendingID;";
			if(!mysqli_query($conn, $sql))
			{
				$_SESSION['admin_panel_msg'] = "An error occurred!";
				header("Location: ../pages/admin-panel.php");
				exit();
			}

			$_SESSION['admin_panel_msg'] = "Successfully accepted hostel request.";
			header("Location: ../pages/admin-panel.php");
		}
		else
		{
			$_SESSION['admin_panel_msg'] = "An error occurred!";
			header("Location: ../pages/admin-panel.php");
		}
	}
	else if (isset($_GET['reject_hostel_req']))
	{
		$id = $_GET['reject_hostel_req'];

		$sql = "SELECT * FROM pending_hostels WHERE hostel_id = $id;";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) == 0)
		{
			$_SESSION['admin_panel_msg'] = "An error occurred!";
			header("Location: ../pages/admin-panel.php");
			exit();
		}

		$sql = "SELECT hostel_pic FROM hostels_images WHERE pending_hostel_id = '$id';";
		$imagesResult = mysqli_query($conn, $sql);
		$totalImages = mysqli_num_rows($imagesResult);

		for ($var = 0; $var < $totalImages; $var++)
		{
			$path = mysqli_fetch_assoc($imagesResult)["hostel_pic"];
			unlink("../".$path);
		}

		$sql = "DELETE FROM hostels_images WHERE pending_hostel_id = '$id';";
		mysqli_query($conn, $sql);

		$sql = "DELETE FROM pending_hostels WHERE hostel_id = '$id';";
		if(mysqli_query($conn, $sql))
		{
			$_SESSION['admin_panel_msg'] = "Successfully rejected hostel request.";
			header("Location: ../pages/admin-panel.php");			
		}
		else
		{
			$_SESSION['admin_panel_msg'] = "An error occurred!";
			header("Location: ../pages/admin-panel.php");
		}
	}
	else if (isset($_GET["accept_user_req"]))
	{
		$id = $_GET['accept_user_req'];

		$sql = "SELECT * FROM pending_users WHERE user_id = $id;";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) != 0)
		{
			$assoc = mysqli_fetch_assoc($result);
			$email = $assoc['user_email'];
			$pass = $assoc['user_password'];
			$type = $assoc['user_account_type'];

			$sql = "INSERT INTO `users` ( user_email, user_password, user_account_type) VALUES ('$email', '$pass', '$type');";
			if(!mysqli_query($conn, $sql))
			{
				$_SESSION['admin_panel_msg'] = "An error occurred!";
				header("Location: ../pages/admin-panel.php");
				exit();
			}

			$sql = "DELETE FROM pending_users WHERE user_id = $id;";
			if(!mysqli_query($conn, $sql))
			{
				$_SESSION['admin_panel_msg'] = "An error occurred!";
				header("Location: ../pages/admin-panel.php");
				exit();
			}

			$_SESSION['admin_panel_msg'] = "Successfully accepted hostel owner account request.";
			header("Location: ../pages/admin-panel.php");
		}
		else
		{
			$_SESSION['admin_panel_msg'] = "An error occurred!";
			header("Location: ../pages/admin-panel.php");
		}
	}
	else if (isset($_GET["reject_user_req"]))
	{
		$id = $_GET['reject_user_req'];

		$sql = "DELETE FROM pending_users WHERE user_id = $id;";
		if(mysqli_query($conn, $sql))
		{
			$_SESSION['admin_panel_msg'] = "Successfully rejected hostel owner account request.";
			header("Location: ../pages/admin-panel.php");
		}
		else
		{
			$_SESSION['admin_panel_msg'] = "An error occurred!";
			header("Location: ../pages/admin-panel.php");
		}
	}