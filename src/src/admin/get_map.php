<!-- <?php
include '../db/config.php';
 $location = $_POST['location'];

 $link = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
if (!$link){
    die ('khong the ket noi vao database');
}
$query =" INSERT INTO contact_us_addmap (location) VALUES ('$location')";
$result = mysqli_query($link, $query);    
            mysqli_close($link);     
if (!$result){
            die ('khong the ket noi vao db'); }  
if ($result > 0){
    header('location: ../contact.php' );
}else{
    header('location: add_map.php?error=Error');
}
?> -->