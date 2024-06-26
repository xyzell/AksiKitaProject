<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

session_start();
include('../server/koneksi.php');

if (isset($_SESSION['logged_in'])) {
    header('location: ../cariAksi.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['pass']);

    $query = "SELECT userId, userName, userEmail, userPassword, userGender, userAddress, userStatus, verifyOtp, verifyStatus 
              FROM users 
              WHERE userEmail = ? AND userPassword = ? LIMIT 1";

    if ($stmt_login = $conn->prepare($query)) {
        $stmt_login->bind_param('ss', $email, $password);

        if ($stmt_login->execute()) {
            $result = $stmt_login->get_result();
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                
                if ($user['verifyStatus'] == 1) {
                    $_SESSION['userId'] = $user['userId'];
                    $_SESSION['userName'] = $user['userName'];
                    $_SESSION['userEmail'] = $user['userEmail'];
                    $_SESSION['userGender'] = $user['userGender'];
                    $_SESSION['userAddress'] = $user['userAddress'];
                    $_SESSION['userStatus'] = $user['userStatus'];
                    $_SESSION['verifyOtp'] = $user['verifyOtp'];
                    $_SESSION['verifyStatus'] = $user['verifyStatus'];
                    $_SESSION['logged_in'] = true;

                    header('location: ../cariAksi.php?message=Berhasil login');
                    exit;
                } else {
                    $_SESSION['statusDanger'] = "Email belum diverifikasi!";
                    header('location: login.php');
                    exit;
                }
            } else {
                $_SESSION['statusDanger'] = "Akun tidak dapat diverifikasi";
                header('location: login.php');
                exit;
            }
        } else {
            $_SESSION['statusDanger'] = "Terjadi kesalahan saat eksekusi query!";
            header('location: login.php');
            exit;
        }
    } else {
        $_SESSION['statusDanger'] = "Terjadi kesalahan saat mempersiapkan query!";
        header('location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>AksiKita &mdash; Go for action!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="icon" href="../assets/images/title.png" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Overpass:300,400,500|Dosis:400,700" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/aos.css">
    <link rel="stylesheet" href="../assets/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../assets/css/jquery.timepicker.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/icomoon.css">

    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/e1612437fd.js" crossorigin="anonymous"></script>

  </head>
  <body>
  
  <!-- START Navbar Section -->
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="../index.html"><div class="logo-header"><img src="/assets/images/logo/whiteLogo.png" alt="" width="126" height="45"></div></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="../index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="../cariAksi.php" class="nav-link">Cari Aksi</a></li>          
          <li class="nav-item"><a href="../about.php" class="nav-link">Tentang Kami</a></li>
          <li class="nav-item"><a href="../contact.php" class="nav-link">FAQ</a></li>
          <li class="nav-item active"><a href="login.php" class="nav-link" data-toggle="modal" data-target="#loginModal" id="loginButton">Login</a></li>           
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
  
  <section class="vh-100" style="padding: 150px;">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-7 col-lg-5 col-xl-5 justify-content-center">
          <div class="container">
            <?php
              if(isset($_SESSION['status'])) 
              {
                ?>
                <div class="alert alert-success text-center">
                    <h5><?= $_SESSION['status'];?></h5>
                </div>
                <?php
                unset($_SESSION['status']);
              }
              if(isset($_SESSION['statusDanger'])) 
              {
                ?>
                <div class="alert alert-danger text-center">
                    <h5><?= $_SESSION['statusDanger'];?></h5>
                </div>
                <?php
                unset($_SESSION['statusDanger']);
              }
            ?>
            <div class="row mb-3 justify-content-center" style="padding-top: 120px;"> 
              <div class="col-md-8 text-center">
                <h2>LOGIN</h2>        
              </div>        
            </div>
          </div>
          <form id="login-form" method="POST" action="login.php">
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label" for="form1Example13">Email</label>
              <input type="email" name="email" class="form-control form-control-lg" />
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label">Password</label>
              <input type="password"  name="pass" class="form-control form-control-lg" />
            </div>

            <div class="d-flex justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                <label class="form-check-label"> Ingat Saya </label>
              </div>
              <a href="#!">Lupa Password?</a>
            </div>
            <!-- Submit button -->
            <button type="submit" id="login_btn" name="login_btn" value="login" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">Login</button>
            <div class="text-center">
                Belum punya akun? <a href="/user/register.php" class="register-link">Ayo Daftar!</a>
            </div>
          </form>
        </div>
    </div>
  </div>
</section> 
<!-- .section -->


<footer class="footer">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-6 col-lg-4">
          <h3 class= "heading-section">About Us</h3>
          <p style="text-align: justify; font-size: 15px"  class="lead">AksiKita didirikan untuk mengoordinasikan aksi relawan dalam menanggapi 
            masalah sosial, lingkungan, dan kemanusiaan. Kami berkembang pesat dengan membuka cabang, 
            melatih relawan, dan mendapatkan pengakuan dari pemerintah dan media. </p>
          <p style="text-align: justify; font-size: 15px" class="mb-5">Sekarang, fokus kami adalah pada proyek jangka panjang untuk pembangunan masyarakat, 
            pendidikan, dan pembangunan berkelanjutan demi menciptakan dampak yang berkelanjutan.</p>
          <p><a href="#" class="link-underline">Read More</a></p>
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
      </div>
    </div>
  </footer>
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/jquery.easing.1.3.js"></script>
  <script src="../assets/js/jquery.waypoints.min.js"></script>
  <script src="../assets/js/jquery.stellar.min.js"></script>
  <script src="../assets/js/owl.carousel.min.js"></script>
  <script src="../assets/js/jquery.magnific-popup.min.js"></script>
  <script src="../assets/js/bootstrap-datepicker.js"></script>

  <script src="../assets/js/jquery.fancybox.min.js"></script>
  
  <script src="../assets/js/aos.js"></script>
  <script src="../assets/js/jquery.animateNumber.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="../assets/js/google-map.js"></script>
  <script src="../assets/js/main.js"></script>
  <script>
    function loginAsUser() {
      // Redirect or perform actions for user login
      window.location.href = "login.php";
    }

    function loginAsOrganizer() {
      // Redirect or perform actions for organizer login
      // Example: window.location.href = "organizer/login.php";
      window.location.href = "../organizer/login.php";
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