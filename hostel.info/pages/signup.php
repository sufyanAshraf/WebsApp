<?php session_start(); ?>
<?php
    if(isset($_SESSION['user_id']))
    {
        header("Location: ../index.php");
    }
?>
<?php include("../config.php");?>
<?php include_once("../includes/header.php"); ?>

 <body style="height: 100vh; background: #F9F9F9;" class="d-flex justify-content-center align-items-center">

<div class="container">
    <form name = "signup" action = "<?php echo $domain.$root_folder."server/validateForms.php"; ?>" onsubmit = "return validateSignup()" method ="POST" enctype="multipart/form-data">
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
                        else
                        {
                            echo "<div class='alert alert-success mt-4' role='alert'>";
                            echo $msg;
                            echo "</div>";
                        }

                        $_SESSION['error_msg'] = "";
                    }
                ?>
                <div style="background:#ECECEC;" class="card mb-2">
                    <div class="card-header">
                        <h1 class="text-center"> Sign<span>up </span></h1>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-1 mb-md-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                            </div>
                            <input class="form-control" id = "signup-first-name" onkeyup="if(validateName(this.value)) {this.style.borderColor='green'} else {this.style.borderColor='red'}"  type="text" name="first_name" placeholder="first name" required>
                        </div>
                        <div class="input-group mb-1 mb-md-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                            </div>
                            <input class="form-control" id = "signup-last-name" onkeyup="if(validateName(this.value)) {this.style.borderColor='green'} else {this.style.borderColor='red'}" type="text" name="last_name" placeholder="last name" required>
                        </div>
                        <div class="input-group mb-1 mb-md-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-mars"></i></div>
                            </div>
                            <select class="form-control" id="gender" name="Gender" required>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="input-group mb-1 mb-md-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                            </div>
                            <input class="form-control" onkeyup="isEmailUnique(this.value)"  id="signup-email" type="text" name="email" placeholder ="Enter your Email" required>
                            <div class="loader-gif"></div>
                        </div>
                        <span id= "email_error" class="text-danger"> </span> 
                        <div  class="input-group mb-1 mb-md-2">
                            <div class="input-group-prepend">
                                <div  id = "phone_div" style="display: none" class="input-group-text"><i class="fas fa-phone"></i></div>
                            </div>
                            <input class="form-control" onkeyup="if(validatePhone(this.value)) {this.style.borderColor='green'} else {this.style.borderColor='red'}" style="display: none" id="phone" type="number" name="signup-phone" placeholder ="Enter your Phone No">
                        </div>
                        <div class="input-group mb-1 mb-md-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-key"></i></div>
                            </div>
                            <input class="form-control" id="signup-password" onkeyup="if(validatePassword(this.value)) {this.style.borderColor='green'} else {this.style.borderColor='red'}" type="password" name="password" placeholder="Password" required>
                        </div>
                        <span id= "pass_error" class="text-danger"> </span> 
                        <div class="input-group mb-1 mb-md-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-key"></i></div>
                            </div>
                            <input class="form-control" id = "signup-confirm-password" onkeyup="if(validatePassword(this.value)) {this.style.borderColor='green'} else {this.style.borderColor='red'}" type="password" name="confirm_password" placeholder="Confirm your password" required>
                        </div>
                        <span id= "cnfrm_pass_error" class="text-danger"> </span> 
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <button type="submit" name = "submit" class="btn btn-md btn-dark px-4"> Register </button>
                            <div class="mb-2 text-center"> 
                                <input id = "user_account_type" type="checkbox" onchange='handleChange(this);' name="user_account_type" value="2"> Check this box to add Hostels?<br>
                            </div>                
                        </div>      
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center"> <a href="<?php echo $domain.$root_folder."pages/login.php"; ?>"> <i class="fas fa-sign-in-alt"></i>Already Have An Account?</a></div> 
                    </div>
                </div>
            </div>    
        </div>
    </form>
</div>

<?php include_once("../includes/footer.php"); ?>
