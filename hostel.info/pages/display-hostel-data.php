<?php session_start(); ?>
<?php include("../config.php");
        include_once("../server/functions.php"); ?>

<?php
    $id;
    if (isset($_GET["hostel_id"]))

        $id = $_GET["hostel_id"];
    else
        header("Location: ../index.php");
    include_once("../server/database_connection.php");

    $sql = "SELECT * FROM hostels WHERE hostel_id='$id'";
    $result = mysqli_query($conn, $sql);
    $num_results = mysqli_num_rows($result);

    if ($num_results == 0)
        header("Location: ../index.php");

    $assoc = mysqli_fetch_assoc($result);

    $images = getHostelImagesArray($conn, $id);

    $PAGE_TITLE = $assoc['hostel_name'];
?>
<?php include_once("../includes/header.php");?>

<body>

    <?php include_once("../includes/navbar.php"); ?>

    <div class="container">

        <div class = "row">
            <div class="font-20 text-block padding-10 col-12"> <?php echo $assoc['hostel_name']; ?> </div>
        </div>

        <div class="row align-items-center">

            <div class="col-lg-5 col-md-6 col-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">

                    <?php
                        for ($var = 0; $var < count($images); $var++)
                        {
                            $active = "";
                            if ($var == 0)
                                $active = "active";
                            echo "<li data-target='#carouselExampleIndicators' data-slide-to='$var' class='$active'></li>";
                        }
                    ?>

                  </ol>
                  <div class="carousel-inner">

                    <?php
                        for ($var = 0; $var < count($images); $var++)
                        {
                            $act = "";
                            if ($var == 0)
                                $act = "active";
                            echo "<div class='carousel-item $act'>
                                  <img class='d-block w-100' src='../$images[$var]'>
                                </div>";
                        }
                    ?>

                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
            </div>

            <div class="col-lg-7 col-md-6 col-12">
                <table class="table table-striped">
                    <tr>
                        <th>Rooms Available</th>
                        <td> <?php echo $assoc['hostel_rooms']; ?> </td>
                    </tr>
                    <tr>
                        <th>Additional Facilities</th>
                        <td> <?php echo $assoc['hostel_extras']; ?> </td>
                    </tr>
                    <tr>
                        <th>Located in</th>
                        <td> <?php echo $assoc['hostel_city']; ?> </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td> <?php echo $assoc['hostel_address']; ?> </td>
                    </tr>
                    <tr>
                        <th>Owner Contact</th>
                        <td> <?php echo getHostelContact($conn, $id); ?> </td>
                    </tr>
                    <tr>
                        <th>Rating</th>
                        <td> <?php echo $assoc['hostel_rating']."&nbsp &nbsp &nbsp &nbsp".getStarsString($assoc['hostel_rating'], 5); ?> </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class = "row">
            <div class="font-20 text-block padding-10 col-12"> Reviews </div>
            <div class="col-12">
                <?php
                    if(isset($_SESSION['user_id']) && isset($_SESSION['user_account_type']) && $_SESSION['user_account_type'] == 1)
                    {
                        $review_count = getReviewCount($conn, $_SESSION['user_id'], $id);
                        if($review_count == 0)
                        {
                            echo "<form action='../server/validateForms.php' method='post'>";
                                echo '<div class="row mb-2">';
                                    echo '<div class="col-sm-2 col-lg-2">';
                                        echo '<select class="form-control" id="rating" name="rating" required>';
                                            echo '<option value="" disabled selected>Rate</option>';
                                            echo '<option value="1">1</option>';
                                            echo '<option value="2">2</option>';
                                            echo '<option value="3">3</option>';
                                            echo '<option value="4">4</option>';
                                            echo '<option value="5">5</option>';
                                        echo '</select>';
                                    echo '</div>';
                                    echo '<div class="col-sm-10 col-lg-8">';
                                        echo '<input class="form-control mb-sm-2" name="review_text" id="review_text" type="text" placeholder="Enter your review" required></input>';
                                        echo '<input name="user_id" id="user_id" type="hidden" value="'.$_SESSION['user_id'].'"></input>';
                                        echo '<input name="hostel_id" id="hostel_id" type="hidden" value="'.$id.'"></input>';
                                    echo '</div>';
                                    echo '<div class="col-sm-12 col-lg-2">';
                                        echo '<button name="rate" type="submit" class="btn btn-outline-dark btn-block">Post</button>';
                                    echo '</div>';
                                echo '</div>';
                            echo "</form>";
                        }
                    }
                ?>          
                <table class="table table-striped">
                    <?php
                        $query = "SELECT * FROM hostels_reviews where review_hostel_id='$id'";
                        $query_result = mysqli_query($conn, $query);
                        if(!$query_result)
		                    die("Error description: " . mysqli_error($conn));
                        $rows_count = mysqli_num_rows($query_result);
                    
                        for($i = 0; $i < $rows_count; $i++)
                        {
                            $row = mysqli_fetch_assoc($query_result);
                            
                            echo '<tr>';
                                echo '<th>'.getReviewOwner($conn, $row['review_owner_id']).'<div class="font-12">Rating: '.$row['review_rating'].'</div></th>';
                                echo '<td> '.$row['review_text'].' </td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
                
            </div>
        </div>

     </div>
    


<?php include_once("../includes/footer.php"); ?>