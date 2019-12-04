<?php session_start(); ?>
<?php
    if(isset($_SESSION['user_id']) && $_SESSION['user_account_type'] == 2)
    {
        $admin_id = $_SESSION['user_id'];
    }
    else {
        header("Location: ../index.php");
    }
?>
<?php include_once('../config.php'); ?>
<?php include_once('../includes/header.php'); ?>
<?php require_once("../server/database_connection.php"); ?>
<?php
    $city;
    if (isset($_GET["city"]))

        $city = $_GET["city"];
    else
        $city = "";

    $PAGE_TITLE = $city;
?>
<body style="overflow: hidden; background: #F9F9F9;">

    <?php include_once("../includes/navbar.php"); ?>

    <div class="wrapper" style="margin-top: 50px">
        <h1 class="text-center mb-4"><i class="fas fa-tasks"></i> &nbsp; Manage Your Hostels</h1>
        <?php
            if(isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']))
            {
                $msg = $_SESSION['error_msg'];
                if(!preg_match('/successfully/',  $msg))
                {
                    echo "<div class='alert alert-danger mt-4' role='alert'>";
                    echo "<strong>Error: </strong>"; 
                        echo $msg;
                    echo "</div>";
                }
                else
                {
                    echo "<div class='alert alert-success alert-dismissible fade show mt-4' role='alert'>";
                        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                        echo "</button>";
                        echo $msg;
                    echo "</div>";
                }

                $_SESSION['error_msg'] = "";
            }
        ?>
    </div>

    <section id="admin-tab">
        <div class="wrapper">
            <form class="form-inline mb-2" method="GET" action="hostel-admin.php">
                <div class="input-group col-10 p-0">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-city"></i></div>
                    </div>
                    <select class="form-control" id="live_city" name="city" required>
                        <option value="" disabled <?php if ($city == ""){echo "selected";} ?> >Select your City</option>
                        <option value="Lahore" <?php if ($city == "Lahore"){echo "selected";} ?> >Lahore</option>
                        <option value="Islamabad" <?php if ($city == "Islamabad"){echo "selected";} ?> >Islamabad</option>
                        <option value="Karachi" <?php if ($city == "Karachi"){echo "selected";} ?> >Karachi</option>
                        <option value="Faisalabad" <?php if ($city == "Faisalabad"){echo "selected";} ?> >Faisalabad</option>
                        <option value="Peshawar" <?php if ($city == "Peshawar"){echo "selected";} ?> >Peshawar</option>
                        <option value="Quetta" <?php if ($city == "Quetta"){echo "selected";} ?> >Quetta</option>
                        <input type="hidden" id="hostel_admin_id" name="hostel_admin_id" value="<?php echo $admin_id; ?>">
                    </select>
                </div>
                <button id="btn" type="submit" class="btn btn-outline-dark col-2"> Search </button>
            </form>
            <div id="live-hostel" class="mb-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <h3>Live Hostels</h3>
                        <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus mr-2"></i>Add New Hostel</button>
                    </li>

                    <div id="live-hostel-container">

                        <?php
                            
                            $sql = "select * from `hostels` where hostel_owner=".$admin_id;
                            if($city != "")
                                $sql = "select * from `hostels` WHERE hostel_city='$city'";
                            $result = mysqli_query($conn, $sql);
                            if(!$result) {
                                die("Error description: " . mysqli_error($conn));
                            } 
                            $count = mysqli_num_rows($result);
                            
                            if($count == 0)
                            {
                                echo '<li class="list-group-item">';
                                echo 'No Result were Found for ';
                                echo '&ldquo;'.$city.'&ldquo;';
                                echo '</li>';
                            }
                            else
                            {
                                while($count)
                                {
                                    $row = mysqli_fetch_assoc($result);
                                    echo '<li class="list-group-item">';
                                        echo '<div class="d-flex justify-content-between align-items-center">';
                                            echo '<div class="d-flex">';
                                                echo '<div class="image-wraper d-inline-block text-center mb-3">';
                                                echo '<img class="mb-2" onclick=display("'.$row['hostel_id'].'"); src="../'.$row['hostel_img'].'" height="100%" width="100%"/>';
                                                    echo '<div> <strong>'.$row['hostel_name'].'</strong></div>';
                                                echo '</div>';
                                                echo '<div class="hostel-details ml-2">';
                                                    echo '<strong>City: </strong> <span>'.$row['hostel_city'].'</span> <br/>';
                                                    echo '<strong>Address: </strong> <span>'.$row['hostel_address'].'</span> <br/>';
                                                    echo '<strong>Rooms: </strong> <span>'.$row['hostel_rooms'].'</span> <br/>';
                                                    echo '<strong>Extras: </strong> <span>'.$row['hostel_extras'].'</span> <br/>';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="button-section d-flex flex-column">';
                                            
                                            echo "<button class='openDialogHostel btn btn-md btn-warning'
                                                data-toggle='modal'
                                                data-hosteldata='".json_encode($row)."'
                                                data-title='Edit your hostel info'
                                                data-target='#myModalEditHostel'>
                                                    <i class='fa fa-edit'></i>
                                                </button>";
                                                
                                                echo "<button class='openDiag btn btn-md btn-danger'
                                                data-toggle='modal'
                                                data-id='../server/hostel-admin-control.php?delete_hostel_id=".$row['hostel_id']."&delete_hostel_img=".$row['hostel_img']."'
                                                data-btn-type='btn-danger'
                                                data-btn-text='Yes, Delete'
                                                data-body='Are you sure you want to delete this hostel?'
                                                data-title='Confirm Deletion'
                                                data-target='#myModal1'>
                                                    <i class='fa fa-trash'></i>
                                                </button>";

                                            echo '</div>';
                                        echo '</div>';
                                    echo '</li>';
                                    $count--;
                                }
                            }
                        ?>
                    </div>      
                </ul>
            </div>
            <div id="pending-hostel">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h3>Pending Requests</h3>
                    </li>
                    <div id="pending-hostel-container">

                        <?php
                            $sql = "select * from `pending_hostels` where hostel_owner=".$admin_id;
                            if($city != "")
                                $sql = "select * from `pending_hostels` WHERE hostel_city='$city'";
                            $result = mysqli_query($conn, $sql);
                            if(!$result) {
                                die("Error description: " . mysqli_error($conn));
                            } 
                            $count = mysqli_num_rows($result);
                            
                            if($count == 0)
                            {
                                echo '<li class="list-group-item">';
                                echo 'No Result were Found for ';
                                echo '&ldquo;'.$city.'&ldquo;';
                                echo '</li>';
                            }
                            else
                            {
                                while($count)
                                {
                                    $row = mysqli_fetch_assoc($result);
                                    echo '<li class="list-group-item">';
                                        echo '<div class="d-flex justify-content-between align-items-center">';
                                            echo '<div class="d-flex">';
                                                echo '<div class="image-wraper d-inline-block text-center mb-3">';
                                                echo '<img class="mb-1" src="../'.$row['hostel_img'].'" height="100%" width="100%"/>';
                                                    echo '<div> <strong>'.$row['hostel_name'].'</strong></div>';
                                                echo '</div>';
                                                echo '<div class="hostel-details ml-2">';
                                                    echo '<strong>City: </strong> <span>'.$row['hostel_city'].'</span> <br/>';
                                                    echo '<strong>Address: </strong> <span>'.$row['hostel_address'].'</span> <br/>';
                                                    echo '<strong>Rooms: </strong> <span>'.$row['hostel_rooms'].'</span> <br/>';
                                                    echo '<strong>Extras: </strong> <span>'.$row['hostel_extras'].'</span> <br/>';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="button-section d-flex flex-column">';
                                                
                                                echo "<button class='openDialogPendingHostel btn btn-md btn-warning'
                                                data-toggle='modal'
                                                data-hosteldata='".json_encode($row)."'
                                                data-title='Edit your hostel info'
                                                data-target='#myModalEditPendingHostel'>
                                                    <i class='fa fa-edit'></i>
                                                </button>";

                                                echo "<button class='openDiag btn btn-md btn-danger'
                                                data-toggle='modal'
                                                data-id='../server/hostel-admin-control.php?cancel_hostel_id=".$row['hostel_id']."&cancel_hostel_img=".$row['hostel_img']."'
                                                data-btn-type='btn-danger'
                                                data-btn-text='Yes, Cancel'
                                                data-body='Are you sure you want to cancel this request?'
                                                data-title='Confirm Cancelation'
                                                data-target='#myModal1'>
                                                    <i class='fa fa-times'></i>
                                                </button>";

                                            echo '</div>';
                                        echo '</div>';
                                    echo '</li>';
                                    $count--;
                                }
                            }
                        ?>
                    </div>
                </ul>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add your hostel data</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                <!-- Start add hostel form -->
                    <div class="container-fluid">
                        <h1 class="text-center my-4"> Fill this out </h1>
                        <form name = "uploadHostel" action = "<?php echo $domain.$root_folder."server/validateForms.php"; ?>" method = "POST" enctype = "multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group mb-1 mb-md-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                        </div>
                                        <input class="form-control" onkeyup="if(validateHostelName(this.value)) {this.style.borderColor='green'} else {this.style.borderColor='red'}" type="text" name="hostel_name" placeholder="Hostel name" required>
                                    </div>
                                    <div class="input-group mb-1 mb-md-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-city"></i></div>
                                        </div>
                                        <select class="form-control" id="City" name="hostel_city" required>
                                            <option value="" disabled selected>Select your City</option>
                                            <option value="Lahore">Lahore</option>
                                            <option value="Islamabad">Islamabad</option>
                                            <option value="Karachi">Karachi</option>
                                            <option value="Faisalabad">Faisalabad</option>
                                            <option value="Peshawar">Peshawar</option>
                                            <option value="Quetta">Quetta</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-1 mb-md-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-map-marked-alt"></i></div>
                                        </div>
                                        <input class="form-control" type="text" name="hostel_address" placeholder ="Address" required>
                                    </div>
                                    <div class="input-group mb-1 mb-md-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-door-open"></i></div>
                                        </div>
                                        <input class="form-control" type="number" name="hostel_rooms" placeholder="Rooms Available" required>
                                    </div>

                                    <textarea name="hostel_extras" placeholder="Additional Facilities" class="col-12" rows="5"></textarea>
                                    
                                    <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
                                    <div class="input-group-text mb-2"><i class="far fa-images"></i>&nbsp Select an image<input name = "user_file[]" id = "file" class = "btn" type = "file" multiple></div>
                                    <button id="uploadHostel" type="submit" name="uploadHostel" class="btn btn-block btn-outline-dark mb-1 mb-md-2"> Add Hostel </button>
                                    
                                </div>
                            </div> 
                        </form>
                    </div>
                    <!-- END add hostel form -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <?php include_once("../includes/edit-hostel-modal.php"); ?>

    <!-- start Modal for dialog massage-->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Request Rejection</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this hostel?
                </div>
                <div class="modal-footer">
                <a href='#'><button type="button" class="btn action">Yes, Delete</button></a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal for dialog massage -->

<script>
    function display(id)
    {
    window.location.href="display-hostel-data.php?hostel_id="+id;
    }
</script>
<?php include_once('../includes/footer.php'); ?>