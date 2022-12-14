<?php
require_once('db/dbhelper.php');
require_once('common/utility.php');
?>
<!doctype html>
<html class="no-js" lang="">
    
<!-- Mirrored from preview.hasthemes.com/james-preview/james/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Jan 2021 00:37:33 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Event</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- favicon
        ============================================ -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

        <!-- Google Fonts
        ============================================ -->
        <link href='https://fonts.googleapis.com/css?family=Norican' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

        <!-- Bootstrap CSS
        ============================================ -->
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
        <?php include_once('layout/header.php'); ?>
        <!-- header area end -->
        <!-- blog  banner start -->
        <div class="blog-banner">
            <img src="img/product/banner.jpg" alt="">
        </div>
        <!-- blog banner end -->
        <!-- blog area start -->
        <div class="blog-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="location">
                            <ul>
                                <li><a href="index.php" title="go to homepage">Home<span>/</span></a>  </li>
                                <li><a href="event.php"><strong>Event</strong></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3" style="overflow-wrap: break-word;">
                        <!--menu left-->
                        <?php include('layout/menu-left-event.php');?>
                        <!--menu left-->
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sidebar-title">
                                   <a href="event.php"><h2>LATEST EVENT</h2></a> 
                                </div>
                                <div class="blog-area">

                                    <!-- CODE PH??N TRANG -->
                                    <?php
                                    //phan trang
                                    $limit = 5; // so News tren mot trang
                                    $page = 1;
                                    if(isset($_GET['page'])){
                                    $page = $_GET['page']; // trang can lay News
                                    }
                                    $firstIndex = ($page-1)*$limit;
                                    
                                    // ph??n lo???i theo topic
                                    $topic_id = "";
                                    if(isset($_GET['topic_id'])){
                                        $topic_id = $_GET['topic_id'];  //lay id topic tim kiem bang phuong thuc get topic
                                    }
                                    // t??m theo title
                                    $titlename = "";
                                    if(isset($_GET['titlename'])){
                                        $titlename = $_GET['titlename'];  //lay tu khoa tim kiem bang phuong thuc get name
                                    }
                                    // t???o query sort topic ho???c search by title (id and name ????? get n???m trong menu-left-topics.php)
                                    $sort_search = '';
                                    if(!empty($topic_id)){
                                        $sort_search=' AND event.topic_id = '.$topic_id.'';
                                    }
                                    if(!empty($titlename)){
                                    $sort_search=' AND event.title LIKE "%'.$titlename.'%"';
                                    }
                                    // NOW() l?? h??m l???y ng??y hi???n t???i c???a Mysql
                                    // ??o???n d?????i th??? hi???n ch??? l???y ra nh???ng event ???? b???t ?????u nh??ng ch??a k???t th??c.
                                    // $sort_search .= ' AND e.startingday <= NOW() AND e.endday >= NOW() ';
                                    $sort_search .= ' AND event.startingday <= NOW() AND event.endday >= NOW() ';
                                    //lay danh lsach cac danh muc tu db		
                                    // event.* l?? vi???t t???t c???a ch???n t???t c??? c??c danh m???c c???a b???ng trong tr?????ng h???p join.
                                    $sql = 'SELECT event.*, event_tp.name_tp FROM event JOIN event_tp ON event.topic_id = event_tp.id 
                                    WHERE 1=1 '.$sort_search.' ORDER BY id DESC '.' LIMIT '.$firstIndex.','.$limit;
                                    // $sql = 'SELECT e.*, et.name_tp FROM event e JOIN event_tp et ON e.topic_id = et.id 
                                    // WHERE 1=1 '.$sort_search.' ORDER BY id DESC '.' LIMIT '.$firstIndex.','.$limit;
                                    //die ($sql);
                                    $newsList = executeResult_post($sql);
                                    // TEST query:
                                    //die($sql);
                                    //dem so trang
                                    $sql_page='SELECT COUNT(id) AS total FROM event WHERE 1'.$sort_search;//th??m $sort_search ????? auto chia page ????ng trong sort/search
                                    $countResult = executeSingleResult($sql_page);
                                    $number = 0;
                                    if($countResult!=null){
                                    $count = $countResult['total'];
                                    $number = ceil($count/$limit); // chan tren
                                    }
                                    //END

                                    //<!-- CODE CONTENT FOR PAGINATOR -->
                                    $index=1;
                                    foreach ($newsList as $display) {
                                        echo '
                                        <div class="single-blog-post-page">
                                        <div class="blog-img">
                                            <a href="event-detail.php?id='.$display['id'].'">
                                            <img style="width: 300px; height: 200px;" src="image/blog/'.$display['image'].'" alt="image-blog">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <a href="event-detail.php?id='.$display['id'].'" class="blog-title">'.$display['title'].'</a> <br>
                                            <a href="event-detail.php?id='.$display['id'].'" class="readmore">read more ></a>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- Bai toan phan trang-->
                                <!-- th??m '&topic_id='.$topic_id.'&titlename='.$titlename ????? chuy???n trang khi sort or search ko b??? refresh -->
                                <?php Paginarion($number, $page, '&topic_id='.$topic_id.'&titlename='.$titlename)?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog area end -->
        <!-- footer top area start -->
        <?php include_once('layout/footer.php');?>
        <!-- footer area end -->

        <!-- jquery
        ============================================ -->
        <script src="js/vendor/jquery-1.12.1.min.js"></script>
        <!-- bootstrap JS
        ============================================ -->
        <script src="js/bootstrap.min.js"></script>
        <!-- wow JS
        ============================================ -->
        <script src="js/wow.min.js"></script>
        <!-- price-slider JS
        ============================================ -->
        <script src="js/jquery-price-slider.js"></script>
        <!-- nivoslider JS
        ============================================ -->
        <script src="lib/js/jquery.nivo.slider.js"></script>
        <script src="lib/home.js"></script>
        <!-- meanmenu JS
        ============================================ -->
        <script src="js/jquery.meanmenu.js"></script>
        <!-- owl.carousel JS
        ============================================ -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- elevatezoom JS
        ============================================ -->
        <script src="js/jquery.elevatezoom.js"></script>
        <!-- scrollUp JS
        ============================================ -->
        <script src="js/jquery.scrollUp.min.js"></script>
        <!-- plugins JS
        ============================================ -->
        <script src="js/plugins.js"></script>
        <!-- main JS
        ============================================ -->
        <script src="js/main.js"></script>
        
    </body>

<!-- Mirrored from preview.hasthemes.com/james-preview/james/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Jan 2021 00:37:41 GMT -->
</html>
