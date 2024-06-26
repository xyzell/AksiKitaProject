<?php

include('../server/koneksi.php');

session_start();
include('converter.php');

if (!isset($_SESSION['loggedIn']) || $_SESSION['userStatus'] != 'organizer') {
  header('location: login.php');
  exit;
}

$id = $_REQUEST['campaign'];

// campaigns
$queryCampaign = "SELECT campaignId, title, banner, description, campaignDate, location, organizerName from campaign join organizer on campaign.organizerId = organizer.organizerId where campaignId = ? LIMIT 1";

$stmt_details = $conn->prepare($queryCampaign);
$stmt_details->bind_param('s', $id);

if ($stmt_details->execute()) {
  $stmt_details->bind_result($id, $title, $banner, $description, $date, $location, $organizer);
  $stmt_details->store_result();

  if ($stmt_details->num_rows() == 1) {
    $stmt_details->fetch();
  }
  $stmt_details->close();
}

$day = date("d", strtotime($date));
$month = date("n", strtotime($date));
$year = date("Y", strtotime($date));

$month = convertMonth(1, $month);
?>

<?php

// show comments
$queryComments = "SELECT commentItself as comment, commentDate as date, organizerName as organizer, userName as user
from comments 
left join organizer on comments.organizerId = organizer.organizerId 
left join users on comments.userId = users.userId 
where campaignId = $id 
order by commentDate desc";

$daycomment = date("d", strtotime($date));
$monthcomment = date("n", strtotime($date));
$yearcomment = date("Y", strtotime($date));

$result = mysqli_query($conn, $queryComments);

$queryrow = "SELECT count(*) from comments where campaignId = $id";
$queryrowresult = $conn->prepare($queryrow);

if ($queryrowresult->execute()) {
  $queryrowresult->bind_result($rowcount);
  $queryrowresult->fetch();
  $queryrowresult->close();
}

$check = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $title ?></title>

  <link rel="icon" href="../assets/images/title.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="organizer-css/bootstrap5/bootstrap.css" />
  <link rel="stylesheet" href="organizer-css/campaignviewcss.css" />

  <script src="organizer-js/bootstrap5/bootstrap.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="pb-5 mb-2 bg-warning bg-opacity-50">
  <div class="container shadow rounded-3 pt-1 pb-0 px-4 mt-5 bg-dark">
    <table class="table table-dark" style="border-bottom: hidden;">
      <th scope="col" class="col-1">
        <a href="homepage.php">
          <i class="fs-1 text-white opacity-100 fa fa-angle-left"></i>
        </a>
      </th>
      <th scope="col">
        <h1 class="pt-1 text-center fs-3">Campaign Review</h1>
      </th>
      <th scope="col" class="col-1"></th>
    </table>
  </div>

  <div class="container bg-white shadow rounded-3 pt-2 pb-4 px-4 mt-2">
    <div>
      <h1 class="text-center fs-3 mb-4 mt-3">
        <?php echo $title ?>
      </h1>
      <div class="banner border border-2 border-secondary border-opacity-25 rounded-3" id="banner-container">
        <img id="image-size" class="image-banner rounded-2" src="../assets/images/campaign/<?php echo $banner ?>" alt="" />
      </div>
      <div>
        <p class="desc">
          <?php echo htmlentities($description) ?>
        </p>
      </div>

      <div class="border border-2 border-secondary border-opacity-75 rounded-3 w-100 margin-top-table">
        <table class="w-100">
          <tr>
            <th class="border-secondary border-opacity-75 text-center text-secondary fw-medium border-bottom border-2 border-0 pt-1 pb-2" colspan="2">
              Organizer<br />
              <span class="fw-normal text-black"> <?php echo htmlentities($organizer) ?></span>
            </th>
          </tr>
          <tr>
            <th class="border-secondary border-opacity-75 text-center text-secondary fw-medium border-end border-2 border-0 pt-1 pb-2 col-5">
              Date<br />
              <span class="fw-normal text-black" id="date"><?php echo $day . " " . $month . " " . $year ?></span>
            </th>
            <th class="border-secondary border-opacity-75 text-center text-secondary fw-medium border-start border-2 border-0 pt-1 pb-2 col-5">
              Location<br />
              <span class="fw-normal text-black"> <?php echo htmlentities($location) ?></span>
            </th>
          </tr>
        </table>
      </div>

      <div class="top-line border-bottom border-warning border-opacity-75 border-2 my-4"></div>
    </div>

    <!-- Button Voluunter, Edit & Delete -->
    <div class="mb-3">
      <a href="manageregistrant.php?campaign=<?php echo $id ?>    ">
        <button class="button-css w-100 rounded-pill bg-primary bg-opacity-75 fw-bold text-white border-0 pb-2">
          Manage Registrant
        </button>
      </a>
    </div>
    <div class="mb-3">
      <a href="managevolunteer.php?campaign=<?php echo $id ?>    ">
        <button class="button-css w-100 rounded-pill bg-info fw-bold text-white border-0 pb-2">
          Manage Volunteer
        </button>
      </a>
    </div>
    <div class="row">
      <div class="col">
        <a href="editcampaign.php?campaign=<?php echo $id ?>    ">
          <button class="button-css w-100 rounded-pill bg-warning fw-bold text-white border-0 pb-2">
            Edit
          </button>
        </a>
      </div>
      <div class="col">
        <button type="button" class="button-css w-100 rounded-pill bg-danger fw-bold text-white border-0 pb-2 delete-button" href="#" onclick="deleteCampaign()">
          Delete
        </button>
      </div>
    </div>

    <form action="deletecampaign.php" id="form-delete" method="POST">
      <input type="hidden" name="campaign-id" id="campaign-id" value="<?php echo $id ?>" hidden />
      <input type="hidden" name="campaign-banner" id="campaign-banner" value="<?php echo $banner ?>" hidden />
    </form>

    <div class="top-line border-bottom border-warning border-opacity-75 border-2 mt-3"></div>

    <!-- Comments -->
    <div>
      <h1 class="fw-medium fs-4 text-secondary mb-2 mt-3">Comments</h1>
      <div class="row">
        <div class="col col-sm-1 text-center">
          <img src="../assets/images/gen.jpeg" class="image-size rounded-circle" alt="" />
        </div>
        <div class="col">
          <form action="" method="POST">
            <textarea name="comment" id="comment" class="text-area w-100 rounded-3 border-secondary border-2 border border-opacity-50 bg-white bg-opacity-10 px-2 fw-normal" maxlength="1000" oninput="countTextComment()" autocomplete="off" placeholder="Write your Comments"></textarea>
            <div class="d-flex justify-content-between fw-medium text-secondary fs-6 margin-bottom-30 pe-2" id="comment-max">
              <input type="button" name="submit-comment" id="submit-comment" onclick="submitClicked()" class="submit-comment rounded-pill border-0 bg-warning bg-opacity-75 mt-1 text-white fw-bold" value="Send">
              <p class="text-end"><span id="comment-char">0</span>/1000</p>
            </div>
          </form>
        </div>
      </div>
      <hr class="border-2 margin-line" />

      <!-- Other Comments -->
      <div>
        <table class="w-100">
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            if ($check == 0) {
          ?>
              <tr>
                <th class="col-size v-align text-start px-2 name-image-css border-bottom border-0 border-1" rowspan="2">
                  <img class="image-size rounded-circle" src="../assets/images/gen.jpeg" alt="" />
                </th>
                <th class="text-black px-2 name-image-css">
                  <?php if (is_null($row['user'])) {
                    echo $row['organizer'];
                  ?>&nbsp;<i class="fa fa-check-circle text-info text-opacity-75"></i>
                <?php
                  } else {
                    echo $row['user'];
                  } ?><span class="text-secondary text-opacity-50 fw-normal fs-6"><br /><?php echo $row['date'] ?></span>
                </th>
              </tr>
              <tr>
                <td class="text-black fw-normal px-2 pt-1 comment-css">
                  <?php echo $row['comment'] ?>
                </td>
              </tr>

            <?php
              $check = 1;
            } else { ?>
              <tr class="border-top border-0 border-1">
                <th class="col-size v-align text-start px-2 name-image-css" rowspan="2">
                  <img class="image-size rounded-circle" src="../assets/images/gen.jpeg" alt="" />
                </th>
                <th class="text-black px-2 name-image-css">
                  <?php if (is_null($row['user'])) {
                    echo $row['organizer'];
                  ?>&nbsp;&nbsp;<i class="fa fa-check-circle text-info text-opacity-75 pt-1"></i>
                <?php
                  } else {
                    echo $row['user'];
                  } ?><span class=" text-secondary text-opacity-50 fw-normal fs-6"><br /><?php echo $row['date'] ?></span>
                </th>
              </tr>
              <tr>
                <td class="text-black fw-normal px-2 pt-1 comment-css">
                  <?php echo $row['comment'] ?>
                </td>
              </tr>
          <?php }
          } ?>
        </table>
      </div>
    </div>
  </div>
  <script src="organizer-js/campaignviewjs.js"></script>
  <script>
    function submitClicked() {

      <?php
      // insert comments
      $comment = $_POST['comment'];
      if ($comment != null && $comment != "") {

        $queryinsert = "INSERT INTO comments VALUES ('', '$comment', '2024-02-13 00:00:00', 7, 1, NULL)";

        mysqli_query($conn, $queryinsert);
        $comment = null;
      }
      ?>

      reload();
    }
  </script>
</body>

</html>