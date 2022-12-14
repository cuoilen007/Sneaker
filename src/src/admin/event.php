<?php
require_once('../db/dbhelper.php');
require_once('../db/config.php');
require_once('../common/utility.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Event</title>
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
    <div class="container-fluid page-body-wrapper" >
      <!-- partial:partials/_sidebar.html -->
      <?php  require_once('layout/left-menu.php');?>
      <!-- partial -->
        <div class="container-fluid p-3 mb-2 bg-light text-dark" style="margin-top: 25px;">
        <h3 class="text-left" style="margin-bottom:20px;">Important Event</h3> 
        <hr class="mt-5">
            <div class="row">
              <div class="col-sm-4 text-left">
                      <a href="eventadd.php" style="color: black;"><button class="btn btn-primary" style="margin-bottom:5px;"><b> Create Event</b></button></a>
                      <a href="event_Categories.php" style="color: black;"><button class="btn btn-success" style="margin-bottom:5px;"><b>Categories</b></button></a>
              </div>
              <!-- Search form -->
              <div class="col-sm-4">
</div>
              <form class="md-form active-purple active-purple-2 mb-3 col-sm-4" menthod = "get">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search" name = "search">
              </form>
            </div>
            <div class="row">
            <?php
            //Thu???t To??n Ph??n Trang
                     // B?????c 1
                     if(isset($_GET['search'])){
                      $s=$_GET['search'];
                      $sql1 = "SELECT count(id) as total from event where title like '%$s%'";
                     }else{
                     $sql1 = "select count(id) as total from event";}
                     $result = mysqli_query($link,$sql1);
                     $row = mysqli_fetch_assoc($result);
                     $total_records = $row['total'];
                     // B?????C 2: T??M LIMIT V?? CURRENT_PAGE
                     $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                     $limit = 8;
                     // B?????C 3: T??NH TO??N TOTAL_PAGE V?? START
                     // t???ng s??? trang
                     $total_page = ceil($total_records / $limit);
                     // Gi???i h???n current_page trong kho???ng 1 ?????n total_page
                     if ($current_page > $total_page){
                         $current_page = $total_page;}
                     else if ($current_page < 1){
                         $current_page = 1;}
                     // T??m Start
                     $start = ($current_page - 1) * $limit;
                      //tim kiem
                     // PH???N HI???N TH??? PH??N TRANG
                     ?>
                     
            </div>
            <div class="row">
                <div class="col-sm-12" style="text-align: center;">     
                  <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">NO</th>
                          <th scope="col">Image</th>
                          <th scope="col">Event Name</th>
                          <th scope="col">Categories</th>
                          <th scope="col">Starting Date</th>
                          <th scope="col">End Date</th>
                          <th scope="col">Action</th>                        
                        </tr>
                      </thead>
                      <?php
                    
                      
    // B?????C 4: TRUY V???N L???Y DANH S??CH TIN T???C
    // C?? limit v?? start r???i th?? truy v???n CSDL l???y danh s??ch tin t???c
    $sql = "SELECT event.*, event_tp.name_tp FROM event JOIN event_tp ON event.topic_id = event_tp.id
    ORDER BY id DESC LIMIT $start, $limit";  
    $s= '';
    if(isset($_GET['search'])){
        $s=$_GET['search'];
        $sql = "SELECT event.*, event_tp.name_tp FROM event JOIN event_tp ON event.topic_id = event_tp.id
         WHERE event.title LIKE '%$s%'ORDER BY id DESC LIMIT $start, $limit";  
    }
    $result = mysqli_query($link,$sql);     

    // Ph???n hi???n th??? Contact Us
    // B?????C 6: HI???N TH??? DANH S??CH TIN T???C   
  
    if ($result){                           
        if(mysqli_num_rows($result)>0){
             while($row = mysqli_fetch_array($result)){
              echo '<tr>'  
                        .'<td>'.++$start.'</td>'
                        .'<td><img style="width: 80px; height: auto;" src="../image/blog/'.$row['image'].'" alt="No Image, Please input Image"></td>'           
                        .'<td>'.$row['title'].'</td>'   
                        .'<td>'.$row['name_tp'].'</td>'                  
                        .'<td>'.$row['startingday'].'</td>'
                        .'<td>'.$row['endday'].'</td>'
                        .'<td class="dropdown" style="display:inline-block">
                  <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action 
                  </button>
                  <p class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="eventdetail.php?id='.$row['id'].'">Detail</a>
                      <a class="dropdown-item" href="eventedit.php?id='.$row['id'].'">Edit</a>                    
                      <a class="dropdown-item" href="event/processevent_del.php?id='.$row['id'].'">Delete</a>
                  </p>
              </td>';  
                       
                    }
              mysqli_free_result($result);}
                            else{
                                  echo  '<tr>'.
                                        '<td colspan = "4">No Records</td>'.
                                        '</tr>';}
                                            }
                        else{
                                  echo '<h4> No Data, Please try again';}
                                  mysqli_close($link);
                        ?>
                        <tr style="height:1px;"><td colspan="9" ></td> </tr>				
                      </tbody>
                    </table>
				<!-- Bai toan phan trang-->       
        <span style="margin:8px"><?php echo $total_records?> items</span><div aria-label="Page navigation example btn btn-info" style="text-align:center; font-size:larger; display:inline-block;">
           <?php 
            // PH???N HI???N TH??? PH??N TRANG
            // B?????C 7: HI???N TH??? PH??N TRANG
            // n???u current_page > 1 v?? total_page > 1 m???i hi???n th??? n??t prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="event.php?page='.($current_page-1).'&search='.$s.'">Prev</a> | ';
            }
            // L???p kho???ng gi???a
            for ($i = 1; $i <= $total_page; $i++){
            // N???u l?? trang hi???n t???i th?? hi???n th??? th??? span
            // ng?????c l???i hi???n th??? th??? a
            if ($i == $current_page){
                    echo '<span>'.$i.'</span> | ';
                }
            else{
                    echo '<a href="event.php?page='.$i.'&search='.$s.'">'.$i.'</a> | ';
                }
            }
            // n???u current_page < $total_page v?? total_page > 1 m???i hi???n th??? n??t prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="event.php?page='.($current_page+1).'&search='.$s.'">Next</a> | ';
            }
           ?>
                      

                </div>
  
            </div>
           
        </div>
        
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
<script>
		function delete_contact(id){
			var option = confirm('Do you want to delete this product?')	
			if (!option){
				return;
			}
			console.log(id)
			//ajax - xu ly lenh post
			$.post('event/process_eventdel.php',{
				'id':id,
				'action': 'delete'
			},function(data){
				location.reload()
			})
		}
 	</script>
		

</html>
