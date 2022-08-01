<!DOCTYPE html>
<html lang="en">
<?php require('../db/dbhelper.php'); ?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Post</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- endinject -->

    <!-- BLOG -->
    <!-- Custom Styling -->
    <link rel="stylesheet" href="css/blog_style.css">
    <!-- end -->

    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php require_once('layout/header.php');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php require_once('layout/left-menu.php');?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
    <!-- Admin Page Wrapper -->
            <!-- Admin Content -->
            <div class="admin-content" style="box-shadow: 4px 5px 6px 3px;">

                <div class="button-group" style="padding: 20px 30px;">
                    <a href="manage-post.php" class="btn btn-warning">Manage News</a>
                </div>

                <div class="content">

                    <h2 class="page-title" style="text-align: center;">Add News</h2>

                    <form action="post/processAdd-post.php" method="post" id = "addpost" enctype="multipart/form-data">
                        <div>
                            <?php
                            // TOPIC
                            $query = 'SELECT * FROM topics';
                            $topicList = executeResult($query);
                            ?>
                            <label>Topic</label><br>
                            <select name="topic_id" class="text-input">
                            <?php foreach ($topicList as $topic): ?>
                                <option value="<?php echo $topic['id'];?>"><?php echo $topic['topic_name'];?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div><br>
                            <?php //check duplicate title
                                $error='';
                                if(isset($_GET['error'])){
                                    $title_check = $_GET['title_check'];
                                    $error = 'Title '.$title_check.' already exists';
                                }
                            ?>
                            <label>Title <p style="color: red;"> <?php echo $error; ?></p></label>
                            <input type="text" name="title" class="text-input" required>
                        </div>
                        <div><br>
                            <label>Content</label>
                            <textarea type = "text" name="content" id="content"></textarea>
                        </div>
                        <div style="margin-block-start: 20px; margin-block-end: 30px;">
                            <label>Add Image News:</label>
                            <input type="file" name="image" id="image" class="text-input" onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])">
                            <img id="preview-image" style="width: 200px; height: 100px;">
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" name="published" value="1" checked>
                                Publish News
                            </label>
                        </div>
                        <div>
                            <button type="submit" name="addpost" class="btn btn-success" style="margin-block-end: 20px;">Add News</button>
                        </div>
                    </form>

                </div>

            </div>
            <!-- // Admin Content -->
        <!-- // Page Wrapper -->  
        
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include('layout/footer.php');?>
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

    <!-- BLOG -->
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Ckeditor 5-->
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script src="js/blog_scripts.js"></script>
</body>

</html>

