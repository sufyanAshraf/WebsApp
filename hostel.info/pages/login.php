<?php
    session_start();
    if(isset($_SESSION['user_id']))
    {
        header("Location: ../index.php");
    }
    ?>
<?php include("../config.php");?>
<?php include_once("../includes/header.php"); ?>

<body style="height: 100vh; background: #F9F9F9;" class="d-flex justify-content-center align-items-center">

<div class="container">
    <form action="../server/validateForms.php" onsubmit="return validateLogin()" method ="POST">
        <div class="col-sm-12 offset-md-2 col-md-8 offset-lg-3 col-lg-6">
            <div class="container">
                <div class="logo-container text-center mb-4">
                    <div class="logo d-inline font-20 margin-left-70"> <a href="<?php echo $domain.$root_folder."index.php"; ?>">HOSTEL</a></div>
                </div> 
                <?php
                    require_once "../server/database_connection.php";
                    if(isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']))
                    {
                        $msg = $_SESSION['error_msg'];
                        if(!preg_match('/success/',  $msg))
                        {
                            echo "<div class='alert alert-danger mt-4' role='alert'>";
                            echo "<strong>Error: </strong>"; 
                                echo $msg;
                            echo "</div>";
                        }

                        $_SESSION['error_msg'] = "";
                    }
                ?>
                <div style="background:#ECECEC;" class="card mb-2">
                    <div class="card-header">
                        <h2 class="text-center"> Log<span>in</span>  </h2>
                    </div>
                    <div class="card-body">
						<div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                            </div>
                            <input class="form-control" id="login-email" type="text" name="email" placeholder ="Enter your Email" onkeyup="if(validateEmail(this.value)) {this.style.borderColor='green'} else {this.style.borderColor='red'}" required="">
                        </div>
						<span id= "email_error" class="text-danger"> </span> 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-key"></i></div>
                            </div>
                            <input class="form-control" id="login-password" type="password" name="password" placeholder="Password" onkeyup="if(validatePassword(this.value)) {this.style.borderColor='green'} else {this.style.borderColor='red'}" required="">
                        </div>
						<span id= "pass_error" class="text-danger"> </span> 
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <button type="submit" name= "login" class="btn btn-md btn-dark px-4"> Login </button>
                            <div class="mb-2"> <input type="checkbox" name="remember" id="remember"> Remember me </div>                    
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div> <a href="<?php echo $domain.$root_folder."pages/signup.php"; ?>"> <i class="fas fa-sign-in-alt"></i> Create a free Account</a></div>                  
                    </div>
                </div>
            </div>    
        </div>
    </form>
</div>

<?php include_once("../includes/footer.php"); ?>
<script>
    
</script>