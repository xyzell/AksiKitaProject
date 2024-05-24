<?php

include('../server/koneksi.php');


// $organizerId = $_SESSION['organizerId'];
$organizerId = '1';

$queryCampaign = "SELECT count(*) as count FROM campaign WHERE organizerId = $organizerId";
$result = mysqli_query($conn, $queryCampaign);

$row = mysqli_fetch_assoc($result);
$campaignCount = $row['count'];
$campaignCount = 8;

// $_SESSION["total"] = $campaignCount;


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>AksiKita Organizer</title>
  <link rel="icon" href="../assets/images/title.png" type="image/x-icon" />
  <link rel="stylesheet" href="organizer-css/homepagecss.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!-- Header & Banner-->
  <header class="header">
    <img class="logo-img" src="assets/logo.png" alt="" />
    <h1 class="title">Organizer Dashboard</h1>
    <img class="profile" src="../assets/images/gen.jpeg" alt="" />
  </header>
  <div class="banner">
    <p class="subtitle">Total Active Campaigns and Active Users</p>
    <div class="information">
      <p class="campaigns-count">300 Campaigns</p>
      <p>|</p>
      <p class="volunteers-count">1200000 Users</p>
    </div>
  </div>

  <!-- Campaigns List -->
  <section>
    <h1 class="title">My Campaigns</h1>
    <form class="search" action="">
      <input class="search-bar fa" type="text" name="search-bar" placeholder="Search..." autocomplete="off">
      <button class="search-button" name="search-button"><i class="fa fa-arrow-right"></i></button>
    </form>
    <div class="list-container">
      <div class="campaigns-list">
        <a href="campaignview.php">
          <div class="campaigns-card">
            <img class="campaigns-image" src="assets/banner.jpg" alt="">
            <div class="campaigns-info">
              <div class="campaigns-details">
                <p class="campaigns-organizer">Houndary Fundraising Group</p>
                <h1 class="campaigns-title">Pendidikan Kesejahteraan Warga area Pedesaan dan Perkotaan Jakarta</h1>
              </div>
              <div class="loc-date">
                <img class="campaigns-location-icon" src="assets/pin.png" alt="">
                <p class="campaigns-location">Jakarta Timur</p>
              </div>
              <div class="loc-date">
                <img class="campaigns-date-icon" src="assets/calendar.png" alt="">
                <p class="campaigns-date">15 April 2024</p>
              </div>
            </div>
          </div>
        </a>
        <a href="">
          <div class="campaigns-card">
            <img class="campaigns-image" src="assets/test.png" alt="">
            <div class="campaigns-info">
              <div class="campaigns-details">
                <p class="campaigns-organizer">PT Waifu Finder</p>
                <h1 class="campaigns-title">Open Recruitment for all hensem man who always wanted to have an imaginary wife</h1>
              </div>
              <div class="loc-date">
                <img class="campaigns-location-icon" src="assets/pin.png" alt="">
                <p class="campaigns-location">Jakarta Timur</p>
              </div>
              <div class="loc-date">
                <img class="campaigns-date-icon" src="assets/calendar.png" alt="">
                <p class="campaigns-date">15 April 2024</p>
              </div>
            </div>
          </div>
        </a>
        <a href="">
          <div class="campaigns-card">
            <img class="campaigns-image" src="../assets/images/gen.jpeg" alt="">
            <div class="campaigns-info">
              <div class="campaigns-details">
                <p class="campaigns-organizer">PT Waifu Finder</p>
                <h1 class="campaigns-title">Open Recruitment for all hensem man who always wanted to have an imaginary wife</h1>
              </div>
              <div class="loc-date">
                <img class="campaigns-location-icon" src="assets/pin.png" alt="">
                <p class="campaigns-location">Jakarta Timur</p>
              </div>
              <div class="loc-date">
                <img class="campaigns-date-icon" src="assets/calendar.png" alt="">
                <p class="campaigns-date">15 April 2024</p>
              </div>
            </div>
          </div>
        </a>
        <a href="">
          <div class="campaigns-card">
            <img class="campaigns-image" src="../assets/images/gen.jpeg" alt="">
            <div class="campaigns-info">
              <div class="campaigns-details">
                <p class="campaigns-organizer">PT Waifu Finder</p>
                <h1 class="campaigns-title">Open Recruitment for all hensem man who always wanted to have an imaginary wife</h1>
              </div>
              <div class="loc-date">
                <img class="campaigns-location-icon" src="assets/pin.png" alt="">
                <p class="campaigns-location">Jakarta Timur</p>
              </div>
              <div class="loc-date">
                <img class="campaigns-date-icon" src="assets/calendar.png" alt="">
                <p class="campaigns-date">15 April 2024</p>
              </div>
            </div>
          </div>
        </a>
        <a href="">
          <div class="campaigns-card">
            <img class="campaigns-image" src="../assets/images/gen.jpeg" alt="">
            <div class="campaigns-info">
              <div class="campaigns-details">
                <p class="campaigns-organizer">PT Waifu Finder</p>
                <h1 class="campaigns-title">Open Recruitment for all hensem man who always wanted to have an imaginary wife</h1>
              </div>
              <div class="loc-date">
                <img class="campaigns-location-icon" src="assets/pin.png" alt="">
                <p class="campaigns-location">Jakarta Timur</p>
              </div>
              <div class="loc-date">
                <img class="campaigns-date-icon" src="assets/calendar.png" alt="">
                <p class="campaigns-date">15 April 2024</p>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>

    <hr class="line-bottom">
    </hr>
  </section>

  <!-- Create Campaign Button -->
  <div>
    <?php

    if ($campaignCount < 8) {
      underEight();
    } else {
      eightOrAbove();
    }

    function underEight()
    { ?>
      <p class="add-title">Want to create a new campaign?</p>
      <div class="add-button-position">
        <a href="createcampaign.php" class="add-button-href">
          <button class="add-button-button">+ Create New</button>
        </a>
      </div>
    <?php }
    function eightOrAbove()
    { ?>
      <p class="add-title">Want to create a new campaign?</p>
      <div class="add-button-position">
        <button class="add-button-button" onclick="eightCampaigns()">+ Create New</button>
      </div>
    <?php } ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="organizer-js/homepagejs.js"></script>
</body>

</html>