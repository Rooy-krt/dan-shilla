<?php 
session_start();
error_reporting(0);
// Database Connection
include('includes/config.php');

// Validating Session
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php');
} else {
    // Code For Deletion of team member
    if ($_GET['action'] == 'delete') {
        $lid = intval($_GET['tid']);
        $image_url = $_GET['image_url'];
        $imgpath = "img/" . basename($image_url);
        $query = mysqli_query($con, "DELETE FROM team WHERE id='$lid'");
        if ($query) {
            unlink($imgpath);
            echo "<script>alert('Team member details deleted successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'manage-team.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Global Data Science Institute | Manage Team</title>
    <!-- Include stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <?php include_once("includes/navbar.php");?>
    <!-- /.navbar -->
    <?php include_once("includes/sidebar.php");?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage Team</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Manage Team</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Team Details</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>LinkedIn</th>
                                            <th>Portfolio</th>
                                            <th>Publications</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$query = mysqli_query($conn, "SELECT * FROM team");
$cnt = 1;
while ($result = mysqli_fetch_array($query)) { 
?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><img src="<?php echo $result['image_url']; ?>" width="80"></td>
                                            <td><?php echo $result['name']; ?></td>
                                            <td><?php echo $result['position']; ?></td>
                                            <td><a href="<?php echo $result['linkedin_url']; ?>" target="_blank">LinkedIn</a></td>
                                            <td><a href="<?php echo $result['portfolio_url']; ?>" target="_blank">Portfolio</a></td>
                                            <td><a href="<?php echo $result['publication_url']; ?>" target="_blank">Publications</a></td>
                                            <td>
                                                <a href="edit-team.php?tid=<?php echo $result['id']; ?>" title="Edit Team Member Details"><i class="fa fa-edit" aria-hidden="true"></i></a> | 
                                                <a href="manage-team.php?action=delete&tid=<?php echo $result['id']; ?>&image_url=<?php echo $result['image_url']; ?>" style="color:red;" title="Delete this record" onclick="return confirm('Do you really want to delete this record?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
<?php 
    $cnt++; 
} 
?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>LinkedIn</th>
                                            <th>Portfolio</th>
                                            <th>Publications</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once('includes/footer.php');?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark"></aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
</body>
</html>
<?php } ?>
