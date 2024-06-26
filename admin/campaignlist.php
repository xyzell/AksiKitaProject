<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit(); // pastikan skrip berhenti setelah pengalihan
}

include('layouts/header.php');

// Pastikan untuk menginisialisasi variabel $conn
// Contoh: $conn = new mysqli($servername, $username, $password, $dbname);

$query_campaign = "SELECT * FROM campaign";
$stmt_campaign = $conn->prepare($query_campaign);
$stmt_campaign->execute();
$campaign = $stmt_campaign->get_result();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Campaign</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="campaign.php">Campaign</a></li>
            <li class="breadcrumb-item active">Campaign list</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Campaign</h6>
        </div>
        <div class="card-body">
            <?php
            $messages = [
                'success_update_message' => 'info',
                'fail_update_message' => 'danger',
                'success_delete_message' => 'info',
                'fail_delete_message' => 'danger',
                'success_create_message' => 'info',
                'fail_create_message' => 'danger',
                'image_success' => 'info',
                'image_failed' => 'danger'
            ];

            foreach ($messages as $message => $alertType) {
                if (isset($_GET[$message])) { ?>
                    <div class="alert alert-<?php echo $alertType; ?>" role="alert">
                        <?php echo htmlspecialchars($_GET[$message]); ?>
                    </div>
            <?php
                }
            }
            ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Banner</th>
                            <th>Description</th>
                            <th>Campaign Date</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($campaign as $campaigns) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($campaigns['campaignId']); ?></td>
                                <td><?php echo htmlspecialchars($campaigns['title']); ?></td>
                                <td><img src="<?php echo htmlspecialchars($campaigns['banner']); ?>" alt="Banner" style="width: 100px; height: auto;"></td>
                                <td><?php echo htmlspecialchars($campaigns['description']); ?></td>
                                <td><?php echo htmlspecialchars($campaigns['campaignDate']); ?></td>
                                <td><?php echo htmlspecialchars($campaigns['location']); ?></td>
                                <td class="text-center">
                                    <a href="edit_campaign.php?campaignId=<?php echo htmlspecialchars($campaigns['campaignId']); ?>" class="btn btn-info btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-circle" onclick="hapusCampaign('<?php echo htmlspecialchars($campaigns['campaignId']); ?>')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?php include('layouts/footer.php'); ?>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function hapusCampaign(campaignId) {
  Swal.fire({
    title: "Are you sure?",
    text: "Do you really sure want to delete this campaign? This process cannot be undone",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes",
    focusCancel: true,
    customClass: {
      title: 'title-modal',
      text: 'text-modal',
      cancelButton: 'btn-modal btn-cancel',
      confirmButton: 'btn-modal btn-confirm'
    }
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title:  "Campaign Sucessfully Deleted!",
        text: "Your campaign has been deleted.",
        icon: "success",
        confirmButtonText: "Yes",
        customClass: {
          title: 'title-modal',
          text: 'text-modal',
          confirmButton: 'btn-modal btn-confirm'
        }
      }).then(() => {
        window.location.href = `delete_campaign.php?campaignId=${campaignId}`;
      });
    }
  });
}
</script>