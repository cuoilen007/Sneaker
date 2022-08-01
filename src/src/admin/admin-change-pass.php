<?php
require_once('../db/dbhelper.php');
session_start();
//luu vao db
$admin_name = $_SESSION['admin'];
if(!empty($_POST)){
    $password1=$_POST['password1'];
    $password2=$_POST['password2'];
    if( ($password1==$password2) ){
        date_default_timezone_set('Asia/Saigon');
        $created_at=$updated_at= date('Y-m-d H:s:i');
        $sql = 'UPDATE admin SET password = "'.$password1.'", updated_at = "'.$updated_at.'" WHERE admin = "'.$admin_name.'"';            
        execute($sql);
        //die($sql);
        header('Location:admin.php');
    }else{
        header('Location: admin-change-pass.php?error=1');
    }
}
$error='';
if(isset($_GET['error']) == 1){
    $error = 'Password does not match';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>RoyalUI Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php  require_once('layout/header.php');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
          <?php  require_once('layout/left-menu.php');?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
            <div class="panel-heading">
				<h2 class="text-center">Change Password</h2>
			</div>
            <div style="color:red; text-align:center;">
                <p><?php  $error?></p>
            </div>
            <div class="panel-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="admin" name="admin" id="admin">Admin: <strong><?php echo $admin_name; ?></strong></label> <br>
                        <p style="color: red;"><?php echo $error; ?></p>
                        <label for="password1">New Password:</label>
                        <input type="password" class="form-control" id="password1" name="password1" required>
                        <label for="password2">Confirm Password:</label>
                        <input type="password" class="form-control" id="password2" name="password2" required>
                    </div>
                    <button class="btn btn-success">Change</button>
                </form>
			</div>  

        
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php  include('layout/footer.php');?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>
</html>

