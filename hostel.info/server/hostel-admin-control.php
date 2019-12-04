<?php
    session_start();
    include_once('../config.php'); 
    if(!isset($_SESSION['user_account_type']) && $_SESSION['user_account_type'] != 2)
    {
        header("Location: ../index.php");
    }
    else
    {
        include_once "database_connection.php";

        if (isset($_GET["delete_hostel_id"]) || isset($_GET["cancel_hostel_id"]))
        {
            $sql = "delete from `hostels` where hostel_id=".$_GET["delete_hostel_id"];
            if(isset($_GET["cancel_hostel_id"]))
                $sql = "delete from `pending_hostels` where hostel_id=".$_GET["cancel_hostel_id"];
            
            $result = mysqli_query($conn, $sql);
            if(!$result) {
                $_SESSION['error_msg'] = "Error description: " . mysqli_error($conn);
                header("Location: ../pages/hostel-admin.php");
            } 
            else
            {                   
                if(isset($_GET["cancel_hostel_id"])) {

                    $id = $_GET['cancel_hostel_id'];
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

                    $_SESSION['error_msg'] = "Your hostel request has successfully canceled..";
                }
                else
                {
                    $id = $_GET["delete_hostel_id"];
                    $sql = "SELECT hostel_pic FROM hostels_images WHERE hostel_id = '$id';";
                    $imagesResult = mysqli_query($conn, $sql);
                    $totalImages = mysqli_num_rows($imagesResult);

                    for ($var = 0; $var < $totalImages; $var++)
                    {
                        $path = mysqli_fetch_assoc($imagesResult)["hostel_pic"];
                        unlink("../".$path);
                    }

                    $sql = "DELETE FROM hostels_images WHERE hostel_id = '$id';";
                    mysqli_query($conn, $sql);
                    $_SESSION['error_msg'] = "Your hostel has successfully deleted..";
                }
                
                header("Location: ../pages/hostel-admin.php");
            }
        }
        else if(isset($_GET["editHostel"]) || isset($_GET["editHostelPending"]))
        {
            $hostel_name = $_GET["edit_hostel_name"];
            $hostel_city = $_GET["edit_hostel_city"];
            $hostel_address = $_GET["edit_hostel_address"];
            $hostel_rooms = $_GET["edit_hostel_rooms"];
            $hostel_extras = $_GET["edit_hostel_extras"];

            $hostel_city_regex = '/Lahore|Islamabad|Karachi|Faisalabad|Peshawar|Quetta/';
           
            if($hostel_name == ""
            || $hostel_city == ""
            || $hostel_address == ""
            || $hostel_rooms == "") {
                $_SESSION['error_msg'] = "You can not leave any feild empty";
                header("Location: ../pages/hostel-admin.php");
                die();
            }

            if (!preg_match($hostel_city_regex,  $hostel_city))  {
                $_SESSION['error_msg'] = "City name not valid";
                header("Location: ../pages/hostel-admin.php");
            }
            else {
                $hostel_owner = $_SESSION['user_id'];
                $hostel_id = $_GET['edit_hostel_id'];    //hostel id

                global $conn;
                $sql = "UPDATE `hostels` SET `hostel_name`='".$hostel_name."', `hostel_city`='".$hostel_city."', `hostel_address`='".$hostel_address."', `hostel_rooms`='".$hostel_rooms."', `hostel_extras`='".$hostel_extras."' WHERE `hostel_id`=$hostel_id AND `hostel_owner`=$hostel_owner";
                if(isset($_GET["editHostelPending"]))
                    $sql = "UPDATE `pending_hostels` SET `hostel_name`='".$hostel_name."', `hostel_city`='".$hostel_city."', `hostel_address`='".$hostel_address."', `hostel_rooms`='".$hostel_rooms."', `hostel_extras`='".$hostel_extras."' WHERE `hostel_id`=$hostel_id AND `hostel_owner`=$hostel_owner";
                $result = mysqli_query($conn,$sql);
                if(!$result) {
                    die("Error description: " . mysqli_error($conn));
                }
                else
                {
                    $_SESSION['error_msg'] = "Your hostel has been successfully updated";
                    header("Location: ../pages/hostel-admin.php");
                }
            
                
            }
        }        
    }

    
    
?>