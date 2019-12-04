<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="wrapper-navbar">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <a href="<?php echo $domain.$root_folder ?>"><span class="logo d-none d-lg-inline">HOSTEL</span></a>
        <ul class="navbar-nav mx-auto">

            <li class="nav-item">
                <a class="nav-link <?php if($CURRENT_PAGE == "Index") echo " active"; ?>" href="<?php echo $domain.$root_folder."index.php"; ?>"><i class="fas fa-home"></i> &nbsp; Home</a>
            </li>
            <li class="nav-item">
                <?php

                    if(isset($_SESSION['user_account_type']) &&  $_SESSION['user_account_type'] == 2) {
                        echo '<a class="nav-link ';
                        if($CURRENT_PAGE == "Hostel Admin Panel") 
                            echo ' active" ';
                        else
                            echo '"';
                        echo 'href="'.$domain.$root_folder.'pages/hostel-admin.php"> <i class="fa fa-tasks"></i> &nbsp; Manage Hostels </a>';
                        
                    }
                    else if(isset($_SESSION['user_account_type']) && $_SESSION['user_account_type'] == 3)
                    {
                        echo '<a class="nav-link ';
                        if($CURRENT_PAGE == "Admin Panel") 
                            echo ' active" ';
                        else
                            echo '"';

                        echo 'href="'.$domain.$root_folder.'pages/admin-panel.php"> <i class="fa fa-tasks"></i> &nbsp; Admin Panel </a>';       
                    }
                    else if(!isset($_SESSION['user_account_type']))
                        echo '<a class="nav-link" href="'.$domain.$root_folder.'pages/login.php"> <i class="fa fa-sign-in-alt"></i> &nbsp; Login </a>';
                ?>

            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($CURRENT_PAGE == "About") echo " active"; ?>" href="<?php echo $domain.$root_folder."pages/about-us.php"; ?>"><i class="fa fa-user"></i> &nbsp; Our Members</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($CURRENT_PAGE == "Contact") echo " active"; ?>" href="<?php echo $domain.$root_folder."pages/contact-us.php"; ?>" class="nav-link"> <i class="fas fa-envelope"></i> &nbsp; Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($CURRENT_PAGE == "Search City") echo " active"; ?>" href="<?php echo $domain.$root_folder."pages/display-hostel.php"; ?>" class="nav-link"> <i class="fas fa-search-location"></i> &nbsp; Search </a>
            </li>
            <?php 
                if(isset($_SESSION['user_account_type']) &&  $_SESSION['user_account_type'] != 0)
                {
                    echo'<li class="nav-item">';
                        echo '<a class="nav-link"';
                        if($CURRENT_PAGE == "Contact") 
                            echo " active "; 
                        echo "href='".$domain.$root_folder."server/logout.php' class='nav-link'> <i class='fas fa-sign-out-alt'></i> &nbsp; Logout </a>";
                    echo '</li>';
                }
            ?>
    </ul>
    </div>
    </div>
</nav>
