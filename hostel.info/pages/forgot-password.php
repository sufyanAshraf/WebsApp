<?php session_start(); ?>
<?php
    if(!isset($_SESSION['user_id']))
    {
        header("Location: ../index.php");
    }
?>
<?php include("../config.php");?>
<?php include_once("../includes/header.php"); ?>
<body style="height: 100vh; background: #F9F9F9;" class="d-flex justify-content-center align-items-center">

<div class="container">
    <form action="../index.php" method="post">
        <div class="col-sm-12 offset-md-2 col-md-8 offset-lg-3 col-lg-6">
            <div class="container">
                <div class="logo-container text-center mb-4">
                    <div class="logo d-inline font-20 margin-left-70"> <a href="<?php echo $domain.$root_folder."index.php"; ?>">HOSTEL</a></div>
                </div>
                <div style="background:#ECECEC;" class="card mb-2">
                    <div class="card-header">
                        <h2 class="text-center"> Log<span>in</span>  </h2>
                    </div>
                    <div class="card-body"> 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend ">
                                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                            </div>
                            <input class="form-control" type="text" name="email" value ="Dummy@xyz.com" readonly>
                        </div>
                        <div class="input-group  mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-key"></i></div>
                            </div>
                        <input class="form-control" type="password" name="password" placeholder="Enter New Password" required>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-key"></i></div>
                            </div>
                            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm your password" required>
                        </div>
                        <button type="submit" class="btn btn-md btn-dark px-4"> Reset password </button> 
                    </div>
                </div>
            </div>
        </div>     
    </form>
</div>




<?php include_once("../includes/footer.php"); ?>