<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>AksiKita &mdash;Go for action!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Overpass:300,400,500|Dosis:400,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/css/jquery.timepicker.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link rel="stylesheet" href="assets/css/fancybox.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">  
  </head>
  <body>
  
    <!-- STAR nav -->
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <div class="header-logo">
        <a class="navbar-brand" href="../index.html"><div class="logo-header"><img src="assets/images/logo/whiteLogo.png" alt="" width="126" height="45"></div></a>
      </div>      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="cariAksi.php" class="nav-link">Cari Aksi</a></li>          
          <li class="nav-item"><a href="about.php" class="nav-link">Tentang Kami</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link">FAQ</a></li>      
          <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user fa-sm"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="my-profile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="../user/logout.php">Logout</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item"><a href="user/login.php" class="nav-link" data-toggle="modal" data-target="#loginModal" id="loginButton">Login</a></li>
          <?php endif; ?>        
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <!-- START modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Pilih Jenis Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body icon-grid">
          <button type="button" class="btn btn-primary btn-block" onclick="loginAsUser()"><i class="fa-solid fa-user"></i><span>User</span></button>
          <button type="button" class="btn btn-primary btn-block" onclick="loginAsOrganizer()"><i class="fa-solid fa-landmark"></i><span>Organizer</span></button>
        </div>
      </div>
    </div>
  </div>
  <!-- END modal -->

  <div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 block-30-sm item" style="background-image: url('assets/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h2 class="heading mb-5">Grow Together</h2>              
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  
  <div class="site-section section-counter">
    <div class="container">
      <div class="row">
        <div class="col-md-6 pr-5">
          <div class="block-48">
              <span class="block-48-text-1">Served Over</span>
              <div class="block-48-counter ftco-number" data-number="1321901">0</div>
              <span class="block-48-text-1 mb-4 d-block">Children in 150 Countries</span>
              <p class="mb-0"><a href="#" class="btn btn-white px-3 py-2">View Our Program</a></p>
            </div>
        </div>
        <div class="col-md-6 welcome-text">
          <h2 class="display-4 mb-3">Apa itu AksiKita ?</h2>
          <p class="lead">AksiKita didirikan dengan tujuan untuk memobilisasi dan mengkoordinasikan aksi relawan 
            dalam menanggapi berbagai masalah sosial, lingkungan, dan kemanusiaan. Inisiatif ini lahir dari keinginan 
            mendalam untuk membawa perubahan positif dalam masyarakat dan membantu mereka yang membutuhkan.</p>
          <p class="mb-0"><a href="about.html" class="btn btn-primary px-3 py-2">Lebih Lanjut</a></p>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section border-top">
    <div class="container">
      <div class="row">

        <div class="col-md-4">
          <div class="media block-6">
            <div class="icon"><span class="ion-ios-bulb"></span></div>
            <div class="media-body">
              <h3 class="heading">Visi Kami</h3>
              <p>Menjadi agen perubahan yang kuat dalam mewujudkan masyarakat yang lebih adil, berkelanjutan, dan berempati.</p>
              <p><a href="about.html" class="link-underline">Learn More</a></p>
            </div>
          </div>     
        </div>

        <div class="col-md-4">
          <div class="media block-6">
            <div class="icon"><span class="ion-ios-cash"></span></div>
            <div class="media-body">
              <h3 class="heading">Misi Kamii</h3>
              <p>Menggalang dan mengkoordinasikan aksi sukarela dari individu dan komunitas untuk 
                memberikan dampak positif dalam berbagai bidang, termasuk kesehatan, pendidikan, 
                lingkungan, dan kemanusiaan.</p>
              <p><a href="about.html" class="link-underline">Learn More</a></p>
            </div>
          </div>  
        </div>

        <div class="col-md-4">
          <div class="media block-6">
            <div class="icon"><span class="ion-ios-contacts"></span></div>
            <div class="media-body">
              <h3 class="heading">Tujuan</h3>
              <p>Tujuan utama AksiKita adalah menginspirasi individu untuk bergabung dan berpartisipasi dalam aksi-aksi sukarela 
                yang positif. Kami ingin mendorong semangat kemanusiaan dan kesadaran sosial di antara masyarakat agar lebih banyak 
                orang terlibat dalam membawa perubahan positif.</p>
              <p><a href="about.html" class="link-underline">Learn More</a></p>
            </div>
          </div> 
        </div>

      </div>
    </div>
  </div> <!-- .site-section -->



  

  <div class="site-section fund-raisers bg-light">
    <div class="container">
      <div class="row mb-3 justify-content-center">
        <div class="col-md-8 text-center">
          <h2>Latest Fundraisers</h2>
          <p class="lead">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <p><a href="#" class="link-underline">View All Fundraisers</a></p>
        </div>
      </div>
    </div>

    <div class="container-fluid">

      <!-- <div class="row"> -->
        
        <div class="col-md-12 block-11">
          <div class="nonloop-block-11 owl-carousel">

            <div class="card fundraise-item">
              <a href="#"><img class="card-img-top" src="assets/images/img_1.jpg" alt="Image placeholder"></a>
              <div class="card-body">
                <h3 class="card-title"><a href="#">Water Is Life. Clean Water In Urban Area</a></h3>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <span class="donation-time mb-3 d-block">Last donation 1w ago</span>
                <div class="progress custom-progress-success">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="fund-raised d-block">$12,000 raised of $30,000</span>
              </div>
            </div>

            
            <div class="card fundraise-item">
              <a href="#"><img class="card-img-top" src="assets/images/img_7.jpg" alt="Image placeholder"></a>
              <div class="card-body">
                <h3 class="card-title"><a href="#">Need Shelter for Children in Africa</a></h3>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <span class="donation-time mb-3 d-block">Last donation 1w ago</span>
                <div class="progress custom-progress-success">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="fund-raised d-block">$12,000 raised of $30,000</span>
              </div>
            </div>
            
            <div class="card fundraise-item">
              <a href="#"><img class="card-img-top" src="assets/images/img_3.jpg" alt="Image placeholder"></a>
              <div class="card-body">
                <h3 class="card-title"><a href="#">Children Needs Education</a></h3>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <span class="donation-time mb-3 d-block">Last donation 1w ago</span>
                <div class="progress custom-progress-success">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="fund-raised d-block">$12,000 raised of $30,000</span>
              </div>
            </div>


            <div class="card fundraise-item">
              <a href="#"><img class="card-img-top" src="assets/images/img_4.jpg" alt="Image placeholder"></a>
              <div class="card-body">
                <h3 class="card-title"><a href="#">Refugees Needs Food</a></h3>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <span class="donation-time mb-3 d-block">Last donation 1w ago</span>
                <div class="progress custom-progress-success">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="fund-raised d-block">$12,000 raised of $30,000</span>
              </div>
            </div>

            
            <div class="card fundraise-item">
              <a href="#"><img class="card-img-top" src="assets/images/img_6.jpg" alt="Image placeholder"></a>
              <div class="card-body">
                <h3 class="card-title"><a href="#">Voluteer </a></h3>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <span class="donation-time mb-3 d-block">Last donation 1w ago</span>
                <div class="progress custom-progress-success">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="fund-raised d-block">$12,000 raised of $30,000</span>
              </div>
            </div>
            
            <div class="card fundraise-item">
              <a href="#"><img class="card-img-top" src="assets/images/img_3.jpg" alt="Image placeholder"></a>
              <div class="card-body">
                <h3 class="card-title"><a href="#">Children Needs Food</a></h3>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <span class="donation-time mb-3 d-block">Last donation 1w ago</span>
                <div class="progress custom-progress-success">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="fund-raised d-block">$12,000 raised of $30,000</span>
              </div>
            </div>
           
          </div>
        </div>
      <!-- </div> -->
    </div>
  </div> <!-- .section -->


  <div class="site-section fund-raisers">
    <div class="container">
      <div class="row mb-3 justify-content-center">
        <div class="col-md-8 text-center">
          <h2>Latest Donations</h2>
          <p class="lead">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <p class="mb-5"><a href="#" class="link-underline">View All Donations</a></p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 col-lg-3 mb-5">
          <div class="person-donate text-center">
            <img src="assets/images/person_1.jpg" alt="Image placeholder" class="img-fluid">
            <div class="donate-info">
              <h2>Jorge Smith</h2>
              <span class="time d-block mb-3">Donated Just now</span>
              <p>Donated <span class="text-success">$252</span> <br> <em>for</em> <a href="#" class="link-underline fundraise-item">Water Is Life. Clean Water In Urban Area</a></p>
            </div>
          </div>    
        </div>

        <div class="col-md-6 col-lg-3 mb-5">
          <div class="person-donate text-center">
            <img src="assets/images/person_2.jpg" alt="Image placeholder" class="img-fluid">
            <div class="donate-info">
              <h2>Christine Charles</h2>
              <span class="time d-block mb-3">Donated 1 hour ago</span>
              <p>Donated <span class="text-success">$400</span> <br> <em>for</em> <a href="#" class="link-underline fundraise-item">Children Needs Education</a></p>
            </div>
          </div>    
        </div>

        <div class="col-md-6 col-lg-3 mb-5">
          <div class="person-donate text-center">
            <img src="assets/images/person_3.jpg" alt="Image placeholder" class="img-fluid">
            <div class="donate-info">
              <h2>Albert Sluyter</h2>
              <span class="time d-block mb-3">Donated 4 hours ago</span>
              <p>Donated <span class="text-success">$1,200</span> <br> <em>for</em> <a href="#" class="link-underline fundraise-item">Need Shelter for Children in Africa</a></p>
            </div>
          </div>    
        </div>

        <div class="col-md-6 col-lg-3 mb-5">
          <div class="person-donate text-center">
            <img src="assets/images/person_4.jpg" alt="Image placeholder" class="img-fluid">
            <div class="donate-info">
              <h2>Andrew Holloway</h2>
              <span class="time d-block mb-3">Donated 9 hours ago</span>
              <p>Donated <span class="text-success">$100</span> <br> <em>for</em> <a href="#" class="link-underline fundraise-item">Water Is Life. Clean Water In Urban Area</a></p>
            </div>
          </div>    
        </div>
      </div>
    </div>
  </div> <!-- .section -->

  <div class="featured-section overlay-color-2" style="background-image: url('assets/images/bg_3.jpg');">
    
    <div class="container">
      <div class="row">

        <div class="col-md-6">
          <img src="assets/images/bg_3.jpg" alt="Image placeholder" class="img-fluid">
        </div>

        <div class="col-md-6 pl-md-5">
          <span class="featured-text d-block mb-3">Success Stories</span>
          <h2>Water Is Life. We Successfuly Provide Clean Water in South East Asia</h2>
          <p class="mb-3">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          <span class="fund-raised d-block mb-5">We have raised $100,000</span>

          <p><a href="#" class="btn btn-success btn-hover-white py-3 px-5">Read The Full Story</a></p>
        </div>
        
      </div>
    </div>

  </div> <!-- .featured-donate -->

  <div class="site-section bg-light">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-12">
          <h2>Latest News</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="post-entry">
            <a href="#" class="mb-3 img-wrap">
              <img src="assets/images/img_4.jpg" alt="Image placeholder" class="img-fluid">
            </a>
            <h3><a href="#">Be A Volunteer Today</a></h3>
            <span class="date mb-4 d-block text-muted">July 26, 2018</span>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
            <p><a href="#" class="link-underline">Read More</a></p>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="post-entry">
            <a href="#" class="mb-3 img-wrap">
              <img src="assets/images/img_5.jpg" alt="Image placeholder" class="img-fluid">
            </a>
            <h3><a href="#">You May Save The Life of A Child</a></h3>
            <span class="date mb-4 d-block text-muted">July 26, 2018</span>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
            <p><a href="#" class="link-underline">Read More</a></p>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="post-entry">
            <a href="#" class="mb-3 img-wrap">
              <img src="assets/images/img_6.jpg" alt="Image placeholder" class="img-fluid">
            </a>
            <h3><a href="#">Children That Needs Care</a></h3>
            <span class="date mb-4 d-block text-muted">July 26, 2018</span>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
            <p><a href="#" class="link-underline">Read More</a></p>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- .section -->

  <div class="featured-section overlay-color-2" style="background-image: url('assets/images/bg_2.jpg');">
    
    <div class="container">
      <div class="row">

        <div class="col-md-6 mb-5 mb-md-0">
          <img src="assets/images/bg_2.jpg" alt="Image placeholder" class="img-fluid">
        </div>

        <div class="col-md-6 pl-md-5">

          <div class="form-volunteer">
            
            <h2>Be A Volunteer Today</h2>
            <form action="#" method="post">
              <div class="form-group">
                <!-- <label for="name">Name</label> -->
                <input type="text" class="form-control py-2" id="name" placeholder="Enter your name">
              </div>
              <div class="form-group">
                <!-- <label for="email">Email</label> -->
                <input type="text" class="form-control py-2" id="email" placeholder="Enter your email">
              </div>
              <div class="form-group">
                <!-- <label for="v_message">Email</label> -->
                <textarea name="v_message" id="" cols="30" rows="3" class="form-control py-2" placeholder="Write your message"></textarea>
                <!-- <input type="text" class="form-control py-2" id="email"> -->
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-white px-5 py-2" value="Send">
              </div>
            </form>
          </div>
        </div>
        
      </div>
    </div>

  </div> <!-- .featured-donate -->

  <footer class="footer">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-6 col-lg-4">
          <h3 class= "heading-section">About Us</h3>
          <p style="text-align: justify;" class="lead">AksiKita didirikan untuk mengoordinasikan aksi relawan dalam menanggapi 
            masalah sosial, lingkungan, dan kemanusiaan. Kami berkembang pesat dengan membuka cabang, 
            melatih relawan, dan mendapatkan pengakuan dari pemerintah dan media. </p>
          <p style="text-align: justify;" class="mb-5">Sekarang, fokus kami adalah pada proyek jangka panjang untuk pembangunan masyarakat, 
            pendidikan, dan pembangunan berkelanjutan demi menciptakan dampak yang berkelanjutan.</p>
          <p><a href="#" class="link-underline">Read  More</a></p>
        </div>
        <div class="col-md-6 col-lg-4">
          <h3 class="heading-section">Recent Blog</h3>
          <div class="block-21 d-flex mb-4">
            <figure class="mr-3">
              <img src="../assets/images/img_1.jpg" alt="" class="img-fluid">
            </figure>
            <div class="text">
              <h3 class="heading"><a href="#">Water Is Life. Clean Water In Urban Area</a></h3>
              <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> July 29, 2018</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
              </div>
            </div>
          </div>

          <div class="block-21 d-flex mb-4">
            <figure class="mr-3">
              <img src="../assets/images/img_2.jpg" alt="" class="img-fluid">
            </figure>
            <div class="text">
              <h3 class="heading"><a href="#">Life Is Short So Be Kind</a></h3>
              <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> July 29, 2018</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
              </div>
            </div>
          </div>

          <div class="block-21 d-flex mb-4">
            <figure class="mr-3">
              <img src="../assets/images/img_4.jpg" alt="" class="img-fluid">
            </figure>
            <div class="text">
              <h3 class="heading"><a href="#">Unfortunate Children Need Your Love</a></h3>
              <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> July 29, 2018</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="block-23">
            <h3 class="heading-section">Get Connected</h3>
              <ul>
                <li><span class="icon icon-map-marker"></span><span style="text-align: justify;" class="text">Jl. Khp Hasan Mustopa No.23, Neglasari, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40124</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">Aksik1taaa@gmail.com</span></a></li>
              </ul>
            </div>
        </div>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-ersag" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/jquery.waypoints.min.js"></script>
  <script src="assets/js/jquery.stellar.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/jquery.magnific-popup.min.js"></script>
  <script src="assets/js/bootstrap-datepicker.js"></script>

  <script src="assets/js/jquery.fancybox.min.js"></script>
  
  <script src="assets/js/aos.js"></script>
  <script src="assets/js/jquery.animateNumber.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="assets/js/google-map.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="https://kit.fontawesome.com/e1612437fd.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script>
    // Ambil elemen logo
    var headerLogo = document.querySelector('.header-logo');

    // Tambahkan event listener untuk scroll
    window.addEventListener('scroll', function() {
        // Periksa posisi scroll
        if (window.scrollY > 100) { // Ganti 100 dengan jarak scroll yang kamu inginkan sebelum logo dihilangkan
            // Jika halaman telah discroll melebihi 100px, sembunyikan logo
            headerLogo.style.display = 'none';
        } else {
            // Jika tidak, tampilkan kembali logo
            headerLogo.style.display = 'block';
        }
    });
  </script>

  <script>
    function loginAsUser() {
      // Redirect or perform actions for user login
      window.location.href = "user/login.php";
    }

    function loginAsOrganizer() {
      // Redirect or perform actions for organizer login
      // Example: window.location.href = "organizer/login.php";
      window.location.href = "organizer/login.php";
      // alert("Fitur ini belum tersedia");
    }
  </script>

  <script>
    $(document).ready(function(){
      $("#loginButton").click(function(){
        $("#loginModal").modal();
      });
    });
  </script>





    
  </body>
</html>