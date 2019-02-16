<?php
session_start();
$p = $_GET['p'];
require_once "class/tin.php";
$t = new tin;
//$lang = 'vi';
?>

<!DOCTYPE html>
<html>
<head>
<title><?=$t->getTitle($p); ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/font.css">
<link rel="stylesheet" href="assets/css/animate.css">
<link rel="stylesheet" href="assets/css/structure.css">
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<header id="header">
  <div class="container">
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a class="navbar-brand" href="index.php"><span>TIN TỨC TỔNG HỢP</span></a> </div>
        <div id="navbar" class="navbar-collapse collapse">
          <?php include "menu.php"?>
        </div>
      </div>
    </nav>
    <form id="searchForm" method="get">
        <input type="hidden" name="p" value="search" >
        <input type="text" name="tukhoa" placeholder="Tìm kiếm...">
        <input type="submit" value="">
    </form>
  </div>
</header>
<section id="contentbody">
  <div class="container">
    <div class="row">
      <div class=" col-sm-12 col-md-6 col-lg-6">
        <div class="row">
          <div class="leftbar_content">
            <h2>Tin mới cập nhật</h2>
              <?php
              switch ($p) {
                  case "detail": include "chitiettin.php"; break;
                  case "cat": include "tintrongloai.php"; break;
                  case "search": include "ketquatimkiem.php"; break;
                  default: include "tinmoi.php";
              }
              ?>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-2 col-lg-2">
        <div class="row">
          <div class="middlebar_content">
            <h2 class="yellow_bg">Tin nổi bật</h2>
            <div class="middlebar_content_inner wow fadeInUp">
              <?php include "tinnoibat.php" ?>
            </div>
            <div class="popular_categori  wow fadeInUp">
              <h2 class="limeblue_bg">Most Popular Categories</h2>
              <ul class="poplr_catgnva">
                <li><a href="#">Business</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Life &amp; Style</a></li>
                <li><a href="#">Games</a></li>
                <li><a href="#">Slider</a></li>
                <li><a href="#">Sports</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-4">
        <div class="row">
          <div class="rightbar_content">
            <div class="single_blog_sidebar wow fadeInUp">
              <h2>Bạn xem chưa ?</h2>
              <?php include "tinngaunhien.php"?>
            </div>
            <div class="single_blog_sidebar wow fadeInUp">
              <h2>Tin xem nhiều</h2>
              <?php include "tinxemnhieu.php"?>
            </div>
            <div class="single_blog_sidebar wow fadeInUp">
              <h2>Popular Tags</h2>
              <ul class="poplr_tagnav">
                <li><a href="#">Arts</a></li>
                <li><a href="#">Games</a></li>
                <li><a href="#">Nature</a></li>
                <li><a href="#">Comedy</a></li>
                <li><a href="#">Sports</a></li>
                <li><a href="#">Tourism</a></li>
                <li><a href="#">Videos</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="footer_inner">
          <p class="pull-left">Tin tức tổng hợp &copy; 2019</p>
          <p class="pull-right">Phát triển bởi Quang Đức </p>
        </div>
      </div>
    </div>
  </div>
</footer>
<script src="assets/js/jquery.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/wow.min.js"></script> 
<script src="assets/js/custom.js"></script>
</body>
</html>