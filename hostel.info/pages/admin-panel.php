<?php session_start(); ?>
<?php
    if(!(isset($_SESSION['user_account_type']) && $_SESSION['user_account_type'] == 3)) {
        header("Location: ../index.php");
    }
?>
<?php include("../config.php");?>
<?php include_once("../includes/header.php");
      include_once("../server/database_connection.php");
      include_once("../server/functions.php");
      $account_type = 3;
      ?>


<body>

    <?php include("../includes/navbar.php");?>

    <div class="container">

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Request Rejection</h5>
                <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure you want to reject this request?
              </div>
              <div class="modal-footer">
                <a href='#'><button type="button" class="btn action">Yes, Reject</button></a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
         <!-- End Modal -->
        </div>

        <div class="row">
            <div class="col-12 text-block font-28"> Admin Panel </div>
        </div>

        <hr>

        <!-- Error/Success message -->

        <?php
            if(isset($_SESSION['admin_panel_msg']) && !empty($_SESSION['admin_panel_msg']))
            {
                $msg = $_SESSION['admin_panel_msg'];
                if(!preg_match('/[Ss]uccessfully/',  $msg))
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

                $_SESSION['admin_panel_msg'] = "";
            }
        ?>

        <!-- End error/success message -->

        <div class = "row align-items-center">
            <?php
                $sql = "SELECT * FROM pending_hostels;";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
            ?>
            <div class="col-12 text-block font-20"> Pending Hostel Requests (<?php echo "$count"; ?>)</div>
        </div><hr>

                    <?php
                        for ($var = 0; $var < $count; $var++)
                        {
                            $assoc = mysqli_fetch_assoc($result);
                            $pendingID = $assoc['hostel_id'];
                            $owner = getHostelContactPending($conn, $pendingID);
                            $name = $assoc['hostel_name'];
                            $addr = $assoc['hostel_address'];
                            $city = $assoc['hostel_city']; 
                            $rooms = $assoc['hostel_rooms'];
                            $extras = $assoc['hostel_extras'];
                            $image = "../".$assoc['hostel_img'];

                            echo '<div class = "row align-items-center">';
                            echo "<div class='text-center col-lg-3 col-md-4 col-12'><div class='image-holder'><img alt='$name' class='img-fluid' src='$image'></div><div class='font-18 margin-top-10'><b>$name</b></div></div>";
                            echo '<table class="table table-striped table-sm col-lg-9 col-md-8 col-12">';
                            echo "<tr>
                                    <th> Address </td>
                                    <td> $addr </td>
                                    <th> Extras </td>
                                    <td> $extras </td>
                                  </tr>
                                  <tr>
                                    <th> City </td>
                                    <td> $city </td>
                                    <th> Owner </td>
                                    <td> $owner </td>
                                  </tr>
                                  <tr>
                                    <th> Room </td>
                                    <td> $rooms </td>
                                    <th> Options </th>
                                    <td>
                                        <div class='row'>
                                            <button class='openDiag btn btn-danger btn-sm'
                                                data-toggle='modal'
                                                data-id='../server/admin-control.php?reject_hostel_req=$pendingID'
                                                data-btn-type='btn-danger'
                                                data-btn-text='Yes, Reject'
                                                data-body='Are you sure you want to reject this request?'
                                                data-title='Confirm Request Rejection'
                                                data-target='#myModal'>
                                                    Reject
                                                </button> &nbsp;&nbsp;

                                            <button class='openDiag btn btn-success btn-sm'
                                                data-toggle='modal'
                                                data-id='../server/admin-control.php?accept_hostel_req=$pendingID'
                                                data-btn-type='btn-success'
                                                data-btn-text='Yes, Accept'
                                                data-body='Are you sure you want to accept this request?'
                                                data-title='Confirm Request Acception'
                                                data-target='#myModal'>
                                                    Accept
                                                </button>
                                        </div>
                                    </td>
                                  </tr>";
                            echo '</table>';
                            echo '</div><br><hr><br>';
                        }
                    ?>

        <div class = "row align-items-center">
            <?php
                $sql = "SELECT * FROM pending_users;";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
            ?>
            <div class="col-12 text-block font-20"> Pending Hostel Owner Account Requests (<?php echo "$count"; ?>) </div>

        </div>

        <div class = "row align-items-center">
            <table class="col-12 table table-striped">

                <?php
                    echo "<thead><tr>
                            <th><center> Email </center></th>
                            <th><center> Options </center></th>
                          </tr></thead>";
                    for ($var = 0; $var < $count; $var++)
                    {
                        $assoc = mysqli_fetch_assoc($result);
                        $pendingID = $assoc['user_id'];
                        $user_email = $assoc['user_email'];
                        echo "<tr>
                                <td><center> $user_email </center></td>
                                <td><center>
                                    <button class='openDiag btn btn-danger btn-sm'
                                        data-toggle='modal'
                                        data-id='../server/admin-control.php?reject_user_req=$pendingID'
                                        data-btn-type='btn-danger'
                                        data-btn-text='Yes, Reject'
                                        data-body='Are you sure you want to reject this request?'
                                        data-title='Confirm Request Rejection'
                                        data-target='#myModal'>
                                            Reject
                                        </button> &nbsp;&nbsp;

                                    <button class='openDiag btn btn-success btn-sm'
                                        data-toggle='modal'
                                        data-id='../server/admin-control.php?accept_user_req=$pendingID'
                                        data-btn-type='btn-success'
                                        data-btn-text='Yes, Accept'
                                        data-body='Are you sure you want to accept this request?'
                                        data-title='Confirm Request Acception'
                                        data-target='#myModal'>
                                            Accept
                                        </button>
                                </center></td>
                              </tr>";
                    }
                ?>

            </table>
        </div>

    </div>

<?php include_once("../includes/footer.php"); ?>