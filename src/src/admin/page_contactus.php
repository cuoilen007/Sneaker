<?php
require_once('../db/dbhelper.php');
require_once('../common/utility.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Contact Us Feedback</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <!-- //thuat toan an bai viet dai -->
  <link rel="stylesheet" href="vendors/style-table.css">

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
        <div class="container-fluid ">
            <div class="row" style="margin-top: 25px; margin-left:25px; margin-bottom: 25px; border-bottom: solid 1px ">
            <h4>Customer Information</h4>
            </div>
            <div class="row">
              <div class="col-sm-1">
              </div>
              <div class="col-sm-10"><table class="table table-hover">
                    <tbody>
                      <thead>
                      <col style="width: 5%;"/>
                        <col style="width: 10%;"/>
                        <col style="width: 10%;"/>
                        <col style="width: 10%;"/>
                        <col style="width: 35%">
                        <col style="width: 15%">
                        <col style="width: 15%">
                        <tr>
                          <th>STT</th>
                          <th >Full Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Comment</th>
                          <th>Detail</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <?php
  //Thu???t To??n Ph??n Trang
    // B?????c 1

    $result = mysqli_query($link, 'select count(id) as total from contact_form_info_table');
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];
    // B?????C 2: T??M LIMIT V?? CURRENT_PAGE
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 7;
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
    // B?????C 4: TRUY V???N L???Y DANH S??CH TIN T???C
    // C?? limit v?? start r???i th?? truy v???n CSDL l???y danh s??ch tin t???c
    $result = mysqli_query($link, "SELECT * FROM contact_form_info_table ORDER BY id DESC LIMIT  $start,  $limit");     

    // Ph???n hi???n th??? Contact Us
    // B?????C 6: HI???N TH??? DANH S??CH TIN T???C   
  
    if ($result){                           
        if(mysqli_num_rows($result)>0){
             while($row = mysqli_fetch_array($result)){
              echo '<tr>'  
                        .'<td>'.++$start.'</td>'
                        .'<td>'.$row[1].'</td>'
                        .'<td>'.$row[2].'</td>'
                        .'<td>'.$row[3].'</td>'
                        .'<td>'.$row[4].'</td>'
                        .'<td><a href="page_contactus_detail.php?id='.$row['id'].'"><button class="btn btn-info">Detail</button></a></td>'
                       .'<td><button class="btn btn-danger" onclick="delete_contact('.$row['id'].')">Delete</button></td>'        
                      .'</tr>';
                      
                    }
              mysqli_free_result($result);}
        else{
              echo  '<tr>'.
                    '<td colspan = "4">No Records</td>'.
                    '</tr>';}
                        }
    else{
              echo '<h4> Error with sql command, please';}
              mysqli_close($link);
    ?>
    <tr style="height:1px;"><td colspan="9" ></td> </tr>				
                      </tbody>
                    </table>
				<!-- Bai toan phan trang-->       
        <div aria-label="Page navigation example btn btn-info" style="text-align:center; font-size:larger;">
           <?php 
            // PH???N HI???N TH??? PH??N TRANG
            // B?????C 7: HI???N TH??? PH??N TRANG
            // n???u current_page > 1 v?? total_page > 1 m???i hi???n th??? n??t prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="page_contactus.php?page='.($current_page-1).'">Prev</a> | ';
            }
            // L???p kho???ng gi???a
            for ($i = 1; $i <= $total_page; $i++){
            // N???u l?? trang hi???n t???i th?? hi???n th??? th??? span
            // ng?????c l???i hi???n th??? th??? a
            if ($i == $current_page){
                    echo '<span>'.$i.'</span> | ';
                }
            else{
                    echo '<a href="page_contactus.php?page='.$i.'">'.$i.'</a> | ';
                }
            }
            // n???u current_page < $total_page v?? total_page > 1 m???i hi???n th??? n??t prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="page_contactus.php?page='.($current_page+1).'">Next</a> | ';
            }
           ?>
                      <tbody>

        </div>	
              </div>
              <div class="col-sm-1">
              </div>
            </div>
        </div>
          
        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
      
      
        <!-- partial -->
      </div>
    
     
      <!-- main-panel ends -->
    </div>
    <?php  include('layout/footer.php');?>
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
  <script>
		function delete_contact(id){
			var option = confirm('Do you want to delete this feedback?')	
			if (!option){
				return;
			}
			console.log(id)
			//ajax - xu ly lenh post
			$.post('pagecontactus_del.php',{
				'id':id,
				'action': 'delete'
			},function(data){
				location.reload()
			})
		}
 	</script>
</body>
</html>

