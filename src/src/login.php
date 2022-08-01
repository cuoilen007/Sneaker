<?php
session_start();
include('db/dbhelper.php');
include('login/facebook_source.php');
include('login/google_source.php');
if (!empty($_SESSION['user']) && isset($_SESSION['user'])){
    header('location: index.php');
}
$sql = "select * from user";
$userList = executeResult($sql);
if(!empty($_POST)){
    $user = $_POST['user'];   
    $pass = $_POST['pass'];   
    $checkUser=false;  
    $checkPass=false;  
    $checkToken=false;   
    foreach($userList as $item){
        if($user == $item['user']){
                $checkUser = true;
                if($pass == $item['pass']){
                    $checkPass = true;
                    if($item['token'] == ''){
                        $checkToken = true;
                    } 
                    break;            
            }
        }
    }
    if($checkUser == true){
        if($checkPass== true){
            if($checkToken == false){
                echo '<script type="text/javascript">';
                echo 'alert("This account is already logged in. This login will invalidate the previous login");';
                echo 'window.location="ajax/get-session.php?user='.$user.'"';
                echo '</script>';
            }else{
                $token = substr(md5(uniqid(rand(),1)),3,10);
                $sql = 'update user set token = "'.$token.'" where user = "'.$user.'"';
                execute($sql);  
                $_SESSION['user'] = $user; 
                $_SESSION['token'] = $token; 
                header('Location: index.php');
            }               
            

        }else{
            header('Location: login.php?error2=a'); //dung user, sai pass
        }
    }else{
        header('Location: login.php?error1=a'); //sai user va pass
    }    
    
}

?>
<!doctype html>
<html class="no-js" lang="">
    
<!-- Mirrored from preview.hasthemes.com/james-preview/james/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Jan 2021 00:39:06 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Login </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon
        ============================================ -->
        <link rel="shortcut icon" type="image/x-icon" href="admin/images/favicon.png">

        <!-- Google Fonts
        ============================================ -->
        <link href='https://fonts.googleapis.com/css?family=Norican' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>


        <!-- Bootstrap CSS
        ============================================ -->
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Bootstrap CSS
        ============================================ -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- owl.carousel CSS
        ============================================ -->
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/owl.transitions.css">
        <!-- jquery-ui CSS
        ============================================ -->
        <link rel="stylesheet" href="css/jquery-ui.css">
        <!-- meanmenu CSS
        ============================================ -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
        <!-- nivoslider CSS
        ============================================ -->
        <link rel="stylesheet" href="lib/css/nivo-slider.css">
        <link rel="stylesheet" href="lib/css/preview.css">
        <!-- animate CSS
        ============================================ -->
        <link rel="stylesheet" href="css/animate.css">
        <!-- magic CSS
        ============================================ -->
        <link rel="stylesheet" href="css/magic.css">
        <!-- normalize CSS
        ============================================ -->
        <link rel="stylesheet" href="css/normalize.css">
        <!-- main CSS
        ============================================ -->
        <link rel="stylesheet" href="css/main.css">
        <!-- style CSS
        ============================================ -->
        <link rel="stylesheet" href="style.css">
        <!-- responsive CSS
        ============================================ -->
        <link rel="stylesheet" href="css/responsive.css">
        <!-- modernizr JS
        ============================================ -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add your site or application content here -->
        <!-- header area start -->
        <?=include('layout/header.php')?> 
        <!-- header area end -->
        <!-- cart item area start -->
        <div class="shopping-cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="location">
                            <ul>
                                <li><a href="index.php" title="go to homepage">Home<span>/</span></a>  </li>
                                <li><strong>Login page</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>         
        
        <div class="container">
            <div class="row">
            <div class="col-sm-1 col-md-2 col-lg-3"></div>
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto">
                <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Log In</h5>
                    <form class="form-signin" method="post">
                    <?php
if(isset($_GET['error1'])){
    echo'
                        <div class="error">User Name and Password are not corect!</div>
        ';
}
if(isset($_GET['error2'])){
    echo'
                        <div class="error">Password is not correct!</div>
        ';
}
?>
                    <div class="form-label-group">
                        <input type="text" id="inputEmail" name="user" class="form-control" placeholder="Email address" required autofocus pattern="[A-Za-z0-9_-.]{1,20}">
                        <label for="inputEmail">User Name </label>
                    </div>

                    <div class="form-label-group">
                        <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required pattern="[A-Za-z0-9]{1,15}">
                        <label for="inputPassword">Password</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-3">
                        <a href="forgotpass.php"> 
                            <label class="custom-control-label" for="customCheck1">Forgot password?</label>
                        </a>    
                    </div>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Log in</button>
                    <hr class="my-4">                       
                    </form>
                    <a href="<?=$loginUrl?>">
                        <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit">
                            <i class="fa fa-facebook"></i> Sign in with Facebook
                        </button>                   
                    </a>    
                    <a href="<?=$authUrl?>">
                        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit">
                            <i class="fa fa-google"></i> Sign in with Google
                        </button>                 
                    </a>                  
                   
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- footer area start -->
        <?=include('layout/footer.php')?>
        <!-- footer area end -->
        <!-- jquery
        ============================================ -->
        <script src="js/vendor/jquery-1.12.1.min.js"></script>
        <!-- bootstrap JS
        ============================================ -->
        <script src="js/bootstrap.min.js"></script>
        <!-- nivoslider JS
        ============================================ -->
        <script src="lib/js/jquery.nivo.slider.js"></script>
        <script src="lib/home.js"></script>
        <!-- meanmenu JS
        ============================================ -->
        <script src="js/jquery.meanmenu.js"></script>
        <!-- scrollUp JS
        ============================================ -->
        <script src="js/jquery.scrollUp.min.js"></script>
        <!-- main JS
        ============================================ -->
        <script src="js/main.js"></script>
    </body>

<!-- Mirrored from preview.hasthemes.com/james-preview/james/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Jan 2021 00:39:06 GMT -->
</html>

       