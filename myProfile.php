<?php
session_start();
include('./server/koneksi.php');

if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;
}

$userId = $_SESSION['userId'];

$query = "SELECT userName, userEmail, userGender, userAddress, userBirthdate, userBio, userProfession, userProvince, userTown, userPostalCode FROM users WHERE userId = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
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
  <link rel="stylesheet" href="../assets/css/fancybox.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="../index.html">
        <div class="logo-header"><img src="/assets/images/logo/whiteLogo.png" alt="" width="126" height="45"></div>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="../index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="../cariAksi.php" class="nav-link">Cari Aksi</a></li>
          <li class="nav-item"><a href="../about.php" class="nav-link">Tentang Kami</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link">FAQ</a></li>
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user fa-sm"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item active" href="my-profile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="../user/logout.php">Logout</a></li>
              </ul>
            </li>
          <?php else : ?>
            <li class="nav-item"><a href="../user/login.php" class="nav-link" data-toggle="modal" data-target="#loginModal" id="loginButton">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <div class="site-section bg-light">
    <div class="container">

      <body class="profile-edit-body">
        <div class="profile-edit-container">
          <h2>Edit Profil</h2>
          <form action="updateProfil.php" method="post" class="profile-edit-form">
            <label for="userName">Nama:</label>
            <input type="text" id="userName" name="userName" value="<?php echo htmlspecialchars($user['userName'] ?? ''); ?>" required>

            <label for="userEmail">Email:</label>
            <input type="email" id="userEmail" name="userEmail" value="<?php echo htmlspecialchars($user['userEmail'] ?? ''); ?>" required>

            <label for="userGender">Jenis Kelamin:</label>
            <select id="userGender" name="userGender" required>
              <option value="Male" <?php if (($user['userGender'] ?? '') === 'Male') echo 'selected'; ?>>Male</option>
              <option value="Female" <?php if (($user['userGender'] ?? '') === 'Female') echo 'selected'; ?>>Female</option>
            </select>

            <label for="userAddress">Alamat:</label>
            <input type="text" id="userAddress" name="userAddress" value="<?php echo htmlspecialchars($user['userAddress'] ?? ''); ?>">

            <label for="userBirthdate">Tanggal Lahir:</label>
            <input type="date" id="userBirthdate" name="userBirthdate" value="<?php echo htmlspecialchars($user['userBirthdate'] ?? ''); ?>">

            <label for="userBio">Deskripsi:</label>
            <textarea id="userBio" name="userBio"><?php echo htmlspecialchars($user['userBio'] ?? ''); ?></textarea>

            <label for="userProfession">Profesi:</label>
            <input type="text" id="userProfession" name="userProfession" value="<?php echo htmlspecialchars($user['userProfession'] ?? ''); ?>">

            <label for="userProvince">Provinsi:</label>
            <input type="text" id="userProvince" name="userProvince" value="<?php echo htmlspecialchars($user['userProvince'] ?? ''); ?>">

            <label for="userTown">Kota:</label>
            <input type="text" id="userTown" name="userTown" value="<?php echo htmlspecialchars($user['userTown'] ?? ''); ?>">

            <label for="userPostalCode">Kode Pos:</label>
            <input type="text" id="userPostalCode" name="userPostalCode" value="<?php echo htmlspecialchars($user['userPostalCode'] ?? ''); ?>">

            <button type="submit" name="update_btn">Update</button>
          </form>
        </div>
    </div>
  </div> <!-- .section -->


  <footer class="footer">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-6 col-lg-4">
          <h3 class="heading-section">About Us</h3>
          <p style="text-align: justify;" class="lead">AksiKita didirikan untuk mengoordinasikan aksi relawan dalam menanggapi
            masalah sosial, lingkungan, dan kemanusiaan. Kami berkembang pesat dengan membuka cabang,
            melatih relawan, dan mendapatkan pengakuan dari pemerintah dan media. </p>
          <p style="text-align: justify;" class="mb-5">Sekarang, fokus kami adalah pada proyek jangka panjang untuk pembangunan masyarakat,
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

        <!-- loader -->
        <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
          </svg></div>


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
        <script src="https://kit.fontawesome.com/e1612437fd.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery.fancybox.min.js"></script>
        <script src="assets/js/aos.js"></script>
        <script src="assets/js/jquery.animateNumber.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
        <script src="assets/js/google-map.js"></script>
        <script src="assets/js/main.js"></script>
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
          $(document).ready(function() {
            $("#loginButton").click(function() {
              $("#loginModal").modal();
            });
          });
        </script>


</body>

</html>