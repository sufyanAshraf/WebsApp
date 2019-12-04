<?php session_start(); ?>
<?php include_once("server/database_init.php"); ?>
<?php include("config.php");?>
<?php include_once("includes/header.php"); ?>

<body class="container-fluid"> 

    <?php include_once("includes/navbar.php"); ?>
    <div class="logo-header d-lg-none">
        <h3 class="text-light">Home</h3>
    </div>
    <div class="top-banner d-none d-md-block height-500 line-h-250">
      <div class="row">
        <div class="col-10 offset-1">
          <span class="font-75 d-none d-xl-inline banner-label">
            Find The Perfect Hostel For You
          </span>
          <span class="font-45 d-xl-none d-none d-md-inline banner-label">
            Find The Perfect Hostel For You
          </span>
        </div>
        <div class="col-10 offset-1">
            <span class="banner-input-wrapper">
              <input class="width-50 d-none d-sm-inline banner-input" type="text" name="hostel_location" placeholder="Where do you want to stay?">
              <i class="fas fa-lg fa-crosshairs"></i>
            </span>
        </div>
      </div>
    </div>

    <div class="top-banner d-block d-md-none height-300 line-h-300">
      <div class="row">
        <div class="col-10 offset-1">
          <span class="font-75 d-none d-xl-inline banner-label">
            Find The Perfect Hostel For You
          </span>
          <span class="font-45 d-xl-none d-none d-md-inline banner-label">
            Find The Perfect Hostel For You
          </span>
        </div>
        <div class="col-10 offset-1">
            <span class="banner-input-wrapper">
              <input class="width-60 d-none d-sm-inline banner-input" type="text" name="hostel_location" placeholder="Where do you want to stay?">
              <input class="width-85 d-inline d-sm-none banner-input" type="text" name="hostel_location" placeholder="Where do you want to stay?">
              <i class="fas fa-lg fa-crosshairs"></i>
            </span>
        </div>
      </div>
    </div>



    <section class="wrapper">
          <div class="row">
            <div class="font-28 text-block d-none d-lg-block col-10 offset-1">
              <a href="pages/signup.php" class="custom-link">Register Now For Free And Add Your Own Hostel &nbsp&nbsp <img alt="Register Now" height="70" src="src/images/location_vector.png"></a><br>OR
            </div>
            <div class="font-15 text-block d-none d-sm-block d-lg-none offset-0 col-12">
              <a href="pages/signup.php" class="custom-link">Register Now For Free And Add Your Own Hostel &nbsp&nbsp <img alt="Register Now" height="60" src="src/images/location_vector.png"></a><br>OR
            </div>
            <div class="font-13 text-block d-block d-sm-none offset-0 col-12">
              <a href="pages/signup.php" class="custom-link">Register Now For Free And Add Your Own Hostel &nbsp&nbsp <img alt="Register Now" height="45" src="src/images/location_vector.png"></a><br>OR
            </div>
          </div>
          <div class = "text-block col-10 offset-1">
            Find A Hostel In
          </div>
          <div class="row">
            <div class="text-center margin-top-10 col-sm-6 col-12 col-md-4"><div class="image-holder"><a href='pages/display-hostel.php?city=Lahore'><img alt="Lahore" class="img-fluid image-block" src="src/images/lahore.jpg"></a></div><div class="font-15 text-block padding-10"> Lahore </div></div>
            <div class="text-center margin-top-10 col-sm-6 col-12 col-md-4"><div class="image-holder"><a href='pages/display-hostel.php?city=Islamabad'><img alt="Islamabad" class="img-fluid image-block" src="src/images/islamabad.jpg"></a></div><div class="text-block font-15 padding-10"> Islamabad </div></div>
            <div class="text-center margin-top-10 col-sm-6 col-12 col-md-4"><div class="image-holder"><a href='pages/display-hostel.php?city=Karachi'><img alt="Karachi" class="img-fluid image-block" src="src/images/karachi.jpg"></a></div><div class="text-block font-15 padding-10"> Karachi </div></div>
            <div class="text-center margin-top-10 col-sm-6 col-12 col-md-4"><div class="image-holder"><a href='pages/display-hostel.php?city=Faisalabad'><img alt="Faisalabad" class="img-fluid image-block" src="src/images/faisalabad.jpg"></a></div><div class="text-block font-15 padding-10"> Faisalabad </div></div>
            <div class="text-center margin-top-10 col-sm-6 col-12 col-md-4"><div class="image-holder"><a href='pages/display-hostel.php?city=Peshawar'><img alt="Peshawar" class="img-fluid image-block" src="src/images/peshawar.jpg"></a></div><div class="text-block font-15 padding-10"> Peshawar </div></div>
            <div class="text-center margin-top-10 col-sm-6 col-12 col-md-4"><div class="image-holder"><a href='pages/display-hostel.php?city=Quetta'><img alt="Quetta" class="img-fluid image-block" src="src/images/quetta.jpg"></a></div><div class="text-block font-15 padding-10"> Quetta </div></div>
          </div>
          <hr>
          <div class="text-justify">
            Hostels.info is an up and coming platform specifically targeted towards students and people who travel for extended periods of time. Our algorithms are specifically designed to find just the right place for you to stay. Eliminating the need to hustle and haggle which we are usually accustomed to dealing with.
          </div>
          <div class = "text-block col-10 offset-1">
            You can find a Hostel closest to...
          </div>
          
          <div class="row d-none d-sm-flex">
          <div class="text-center col-xl-2 col-md-3 col-sm-6 col-12 offset-0 offset-xl-2"><a href="#"><i class="fas fa-5x fa-university"></i></i><br><div class="padding-10">Universities</div></a></div>
          <div class="text-center col-xl-2 col-md-3 col-sm-6 col-12"><a href="#"><i class="fas fa-5x fa-store-alt"></i><br><div class="padding-10">Markets</div></a></div>
          <div class="text-center col-xl-2 col-md-3 col-sm-6 col-12"><a href="#"><i class="fas fa-5x fa-mosque"></i><br><div class="padding-10">Mosques</div></a></div>
          <div class="text-center col-xl-2 col-md-3 col-sm-6 col-12"><a href="#"><i class="fas fa-5x fa-utensils"></i><br><div class="padding-10">Resturaunts</div></a></div>
        </div>
        <div class="row d-sm-none d-flex">
          <div class="text-center col-12"><a href="#"><i class="fas fa-5x fa-university"></i><br><span class="font-15"><div class="padding-10">Universities</div></a></span></div>
          <div class="text-center col-12"><a href="#"><i class="fas fa-5x fa-store-alt"></i><br><span class="font-15"><div class="padding-10">Markets</div></a></span></div>
          <div class="text-center col-12"><a href="#"><i class="fas fa-5x fa-mosque"></i><br><span class="font-15"><div class="padding-10">Mosques</div></a></span></div>
          <div class="text-center col-12"><a href="#"><i class="fas fa-5x fa-utensils"></i><br><span class="font-15"><div class="padding-10">Resturaunts</div></a></span></div>
        </div><br>

        <div class="text-justify">
            And much more. If you happen to own a hostel that could be a potentially desirable place for such people to stay, you can sign up for free and provide your hostel's information which will be added to our database after proper review.<br> Customers who have stayed at certain hostels which happen to be listed here can also add reviews regarding them. Further filtering the potential targets so it could be much easier for you to find the right hostel for you.
          </div>


          <hr>
        <div class="row">
          <div class="text-block col-10 offset-1 font-20">
            Contact Us On
          </div>
        </div>
        
        <div class="row d-none d-sm-flex">
          <div class="text-center col-xl-2 col-md-3 col-sm-6 col-12 offset-0 offset-xl-2"><a href="#"><i class="fas fa-3x fa-envelope"></i><br><span class="font-13">Email: contact@hostels.info</span></a></div>
          <div class="text-center col-xl-2 col-md-3 col-sm-6 col-12"><a href="#"><i class="fab fa-3x fa-facebook"></i><br><span class="font-13">Facebook: facebook.com/hostels.info</span></a></div>
          <div class="text-center col-xl-2 col-md-3 col-sm-6 col-12"><a href="#"><i class="fab fa-3x fa-whatsapp-square"></i><br><span class="font-13">Whatsapp: xxxxxxxxxxx</span></a></div>
          <div class="text-center col-xl-2 col-md-3 col-sm-6 col-12"><a href="#"><i class="fas fa-3x fa-phone"></i><br>Phone:<br><span class="font-13"> xxxxxxxxxxx</span></a></div>
        </div>
        <div class="row d-sm-none d-flex">
          <div class="text-center col-12"><a href="#"><i class="fas fa-2x fa-envelope"></i><br><span class="font-12">Email: contact@hostels.info</a></span></div>
          <div class="text-center col-12"><a href="#"><i class="fab fa-2x fa-facebook"></i><br><span class="font-12">Facebook: facebook.com/hostels.info</a></span></div>
          <div class="text-center col-12"><a href="#"><i class="fab fa-2x fa-whatsapp-square"></i><br><span class="font-12">Whatsapp: xxxxxxxxxxx</a></span></div>
          <div class="text-center col-12"><a href="#"><i class="fas fa-2x fa-phone"></i><br><span class="font-12">Phone:<br> xxxxxxxxxxx</a></span></div>
        </div>

    </section> 

  <footer>
      <div class='container text-center py-4'>
        All Rights Reserved. <a href='#' class="text-muted"> hostel.info </a>  &copy; 2018
      </div>
  </footer>
  
<?php include_once("includes/footer.php"); ?>
