<?php

	function recalRating($conn, $hostelID)    // function to recalculate the rating of a hostel;
	{
		$sql = "SELECT review_rating FROM hostels_reviews WHERE review_hostel_id = '$hostelID';";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		$final = 0;
		if ($count > 0)
		{
			for ($var = 0; $var < $count; $var++)
			{
				$assoc = mysqli_fetch_assoc($result);
				$final += $assoc['review_rating'];
			}

			$final /= $count;
		}

		$final = round($final, 2);

		$sql = "UPDATE hostels SET hostel_rating='$final' WHERE hostel_id='$hostelID';";
		if(!mysqli_query($conn,$sql)) {
                die("Error description: " . mysqli_error($conn));
            }
	}

	function getStarsString($rating, $total)
	{
		$stars = "";

		if ($rating >= $total)
		{
			for ($var = 0; $var < $total; $var++)
            	$stars = $stars."<i class='fas fa-star'></i>";
            return $stars;
		}

        for ($var = 0; $var < floor($rating); $var++)
        {
            $stars = $stars."<i class='fas fa-star'></i>";
            $total--;
        }
        if (floor($rating) == $rating)
            $stars = $stars."<i class='far fa-star'></i>";
        else
            $stars = $stars."<i class='fas fa-star-half-alt'></i>";
        $total--;
        for ($var = 0; $var < $total; $var++)
            $stars = $stars."<i class='far fa-star'></i>";

        return $stars;
	}

	function getHostelImagesArray($conn, $id)
	{
		$imageArr = array();

	    $sql = "SELECT hostel_pic FROM hostels_images WHERE hostel_id='$id'";
	    $result = mysqli_query($conn, $sql);
	    $count = mysqli_num_rows($result);

	    for ($var = 0; $var < $count; $var++)
	    {
	    	$assoc = mysqli_fetch_assoc($result);
	    	array_push($imageArr, $assoc['hostel_pic']);
	    }

	    return $imageArr;
	}

	function getHostelContact($conn, $id)
	{
		$sql = "SELECT hostel_owner FROM hostels WHERE hostel_id='$id'";
	    $result = mysqli_query($conn, $sql);
	    $count = mysqli_num_rows($result);
	    if ($count == 0)
	    	return "";
	    $ownerid = mysqli_fetch_assoc($result)['hostel_owner'];

	    $sql = "SELECT user_email FROM users WHERE user_id='$ownerid'";
	    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql))['user_email'];

	    return $result;
	}

	function getReviewCount($conn, $user_id, $hostel_id)
	{
		$sql = "SELECT * FROM hostels_reviews WHERE review_owner_id='$user_id' AND review_hostel_id='$hostel_id'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if(!$result) {
			die("Error description: " . mysqli_error($conn));
		}
		if($count == 0)
			return 0;
		return 1;
	}

	function getReviewOwner($conn, $id)
	{
	    $sql = "SELECT user_email FROM users WHERE user_id='$id'";
	    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql))['user_email'];

	    return $result;
	}

	function getHostelContactPending($conn, $id)
	{
		$sql = "SELECT hostel_owner FROM pending_hostels WHERE hostel_id='$id'";
	    $result = mysqli_query($conn, $sql);
	    $count = mysqli_num_rows($result);
	    if ($count == 0)
	    	return "";
	    $ownerid = mysqli_fetch_assoc($result)['hostel_owner'];

	    $sql = "SELECT user_email FROM users WHERE user_id='$ownerid'";
	    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql))['user_email'];

	    return $result;
	}

	function isTableEmpty($conn, $table_name)
	{
		$sql = "select * from ".$table_name;
		$result = mysqli_query($conn, $sql);
		if(!$result)
			die("Error description: " . mysqli_error($conn));
	
		if(mysqli_num_rows($result) == 0)
			return 1;
		
		return 0;
	}
	
	
	function insertData($conn,$fname,$lname,$Gender,$email, $password,$phone_no,$user_account_type)
	{
		$password = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "insert into users (user_email,user_fname,user_lname,user_Gender,user_p_no,user_password,user_account_type)
        values ('$email','$fname', '$lname', '$Gender', '$phone_no','$password', '$user_account_type');";

		if($user_account_type == 2)
			$insertQuery = "insert into pending_users (user_email,user_fname,user_lname,user_Gender,user_p_no,user_password,user_account_type)
        values ('$email','$fname', '$lname', '$Gender', '$phone_no','$password', '$user_account_type');";

		$result = mysqli_query($conn,$insertQuery);
		
		if(!$result)
		   die("Error description: " . mysqli_error($conn));

		if($user_account_type == 2)
		{
			$_SESSION['error_msg'] = "Your data has been successfully sent for review by our team. You will be notified once it gets reviewed.";
			header("Location: ../pages/signup.php");
		}
		else
		{
			$insertQuery = "select * from `users` where user_email='".$email."'";
			$result = mysqli_query($conn,$insertQuery);	
			if(!$result)
			die("Error description: " . mysqli_error($conn));
			$row = mysqli_fetch_assoc($result);

			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_email'] = $row['user_email'];
			$_SESSION['user_account_type'] = $row['user_account_type'];
			header("Location: ../index.php");
		}	
	}

?>