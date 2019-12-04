<?php

    include_once("database_connection.php");
    include_once("functions.php");

    if(isset($_GET['id']) && isset($_GET['city']) && isset($_GET['type']) && $_GET['type'] == "live")
    {
        $admin_id = $_GET['id'];
        $city = $_GET['city'];
        $sql = "select * from `hostels` WHERE hostel_city='".$city."' AND hostel_owner='".$admin_id."'";
        $result = mysqli_query($conn, $sql);
        if(!$result) {
            die("Error description: " . mysqli_error($conn));
        } 
        $count = mysqli_num_rows($result);
        
        $output = "";
        if($count > 0)
        {
            while($count)
            {
                $row = mysqli_fetch_assoc($result);
                $output .= '<li class="list-group-item">';
                    $output .= '<div class="d-flex justify-content-between align-items-center">';
                        $output .= '<div class="d-flex">';
                            $output .= '<div class="image-wraper d-inline-block text-center mb-3">';
                                $output .= '<img onclick=display("'.$row['hostel_id'].'"); src="../'.$row['hostel_img'].'" height="100%" width="100%"/>';
                                $output .= '<div> <strong>'.$row['hostel_name'].'</strong></div>';
                            $output .= '</div>';
                            $output .= '<div class="hostel-details ml-2">';
                                $output .= '<strong>City: </strong> <span>'.$row['hostel_city'].'</span> <br/>';
                                $output .= '<strong>Address: </strong> <span>'.$row['hostel_address'].'</span> <br/>';
                                $output .= '<strong>Rooms Availible: </strong> <span>'.$row['hostel_rooms'].'</span> <br/>';
                            $output .= '</div>';
                        $output .= '</div>';
                        $output .= '<div class="button-section d-flex flex-column">';
                        
                        $output .= "<button class='openDialogHostel btn btn-md btn-warning'
                            data-toggle='modal'
                            data-hosteldata='".json_encode($row)."'
                            data-title='Edit your hostel info'
                            data-target='#myModalEditHostel'>
                                <i class='fa fa-edit'></i>
                            </button>";
                            
                            $output .= "<button class='openDiag btn btn-md btn-danger'
                            data-toggle='modal'
                            data-id='../server/hostel-admin-control.php?delete_hostel_id=".$row['hostel_id']."&delete_hostel_img=".$row['hostel_img']."'
                            data-btn-type='btn-danger'
                            data-btn-text='Yes, Delete'
                            data-body='Are you sure you want to delete this hostel?'
                            data-title='Confirm Deletion'
                            data-target='#myModal1'>
                                <i class='fa fa-trash'></i>
                            </button>";

                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</li>';
                $count--;
            }
        }
        else
        {
            $output .= '<li class="list-group-item">';
            $output .= 'No Result were Found for ';
            $output .= '&ldquo;'.$city.'&ldquo;';
            $output .= '</li>';
        }
        echo $output;
    }
    else if(isset($_GET['id']) && isset($_GET['city']) && isset($_GET['type']) && $_GET['type'] == "pending")
    {
        $admin_id = $_GET['id'];
        $city = $_GET['city'];
        $sql = "select * from `pending_hostels` WHERE hostel_city='".$city."' AND hostel_owner='".$admin_id."'";

        $result = mysqli_query($conn, $sql);
        if(!$result) {
            die("Error description: " . mysqli_error($conn));
        } 
        $count = mysqli_num_rows($result);
        
        $output = "";
        if($count > 0)
        {
            while($count)
            {
                $row = mysqli_fetch_assoc($result);
                $output.= '<li class="list-group-item">';
                    $output.= '<div class="d-flex justify-content-between align-items-center">';
                        $output.= '<div class="d-flex">';
                            $output.= '<div class="image-wraper d-inline-block text-center mb-3">';
                            $output.= '<img src="../'.$row['hostel_img'].'" height="100%" width="100%"/>';
                                $output.= '<div> <strong>'.$row['hostel_name'].'</strong></div>';
                        $output.= '</div>';
                            $output.= '<div class="hostel-details ml-2">';
                                $output.= '<strong>City: </strong> <span>'.$row['hostel_city'].'</span> <br/>';
                                $output.= '<strong>Address: </strong> <span>'.$row['hostel_address'].'</span> <br/>';
                                $output.= '<strong>Rooms Availible: </strong> <span>'.$row['hostel_rooms'].'</span> <br/>';
                            $output.= '</div>';
                        $output.= '</div>';
                        $output.= '<div class="button-section d-flex flex-column">';
                            
                            $output.= "<button class='openDialogPendingHostel btn btn-md btn-warning'
                            data-toggle='modal'
                            data-hosteldata='".json_encode($row)."'
                            data-title='Edit your hostel info'
                            data-target='#myModalEditPendingHostel'>
                                <i class='fa fa-edit'></i>
                            </button>";

                            $output.= "<button class='openDiag btn btn-md btn-danger'
                            data-toggle='modal'
                            data-id='../server/hostel-admin-control.php?cancel_hostel_id=".$row['hostel_id']."&cancel_hostel_img=".$row['hostel_img']."'
                            data-btn-type='btn-danger'
                            data-btn-text='Yes, Cancel'
                            data-body='Are you sure you want to cancel this request?'
                            data-title='Confirm Cancelation'
                            data-target='#myModal1'>
                                <i class='fa fa-times'></i>
                            </button>";

                        $output.= '</div>';
                    $output.= '</div>';
                $output.= '</li>';
                $count--;
            }
        }
        else
        {
            $output .= '<li class="list-group-item">';
            $output .= 'No Result were Found for ';
            $output .= '&ldquo;'.$city.'&ldquo;';
            $output .= '</li>';
        }
        echo $output;
    }
    else if(isset($_GET['city']))
    {
        $city = $_GET['city'];
        $sql = "SELECT * FROM hostels WHERE hostel_city='$city'";
        $result = mysqli_query($conn, $sql);
        $num_results = mysqli_num_rows($result);

        if($num_results == 0)
            echo '<div class="text-block font-15 padding-10"> No Result Found </div>';
        else
        {
            $output = "";
            for ($i = 0; $i < $num_results; $i++)
            {
                $assoc = mysqli_fetch_assoc($result);
                $name = $assoc['hostel_name'];
                $image = "../".$assoc['hostel_img'];
                $hostel_id = $assoc['hostel_id'];
                $rating = $assoc['hostel_rating'];
                $link = "display-hostel-data.php?hostel_id=$hostel_id";

                $stars = getStarsString($rating, 5);

                $output .= "<div class='text-center margin-top-10 col-sm-6 col-12 col-md-4'><div class='image-holder'><a href = '$link'><img alt='$name' class='img-fluid image-block' src='$image'></a></div><div class='font-15 text-block padding-10'> $name <br> Rating: $rating $stars</div></div>";
            }

            echo $output;
        }
    }
?>