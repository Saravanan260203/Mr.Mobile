<?Php include_once "../include/connect.php";
include "../functions/common_functions.php";
include "controller.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.Mobile</title>
    <style>
      body{
        overflow-x: hidden;
      }
    </style>
    <!--AOS Css-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
     <!--Bootstrap Css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--css-->
    <link rel="stylesheet" href="style.css">
    <!--Fontawesome-->
    <script src="https://kit.fontawesome.com/9e6d3f1177.js" crossorigin="anonymous"></script>
</head>
<body>

    <!--navbar-->
<div class="container-fluid p-0">
<nav class="navbar navbar-expand-lg navbar-light ">
  <div class="container-fluid">
    <img src="../images/Mr.Mobile.png" alt="logo" id="logo">
    <a class="navbar-brand navlink" href="index.php">Mr.Mobile</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link navlink" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navlink" href="index.php?get_all_products">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navlink" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navlink" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php no_of_cart();?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link navlink" href="index.php">Total Price: <?php total_cart_price();?>/-</a>
        </li>
      </ul>
      <form class="d-flex" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_products">
        <button class="btn btn-outline-warning search" type="submit" name="search_btn">Search</button>
      </form>
    </div>
  </div>
</nav>

<!--second nav-->
<nav class="navbar navbar-expand-lg bg-secondary p-0">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
         if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link navlink' href=''>Welcome Guest</a>
        </li>";
      }else{
          echo "<li class='nav-item'>
          <a class='nav-link navlink' href='user_home.php'>Welcome ".$_SESSION['username']."</a>
        </li>";

      }
        if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
            <a class='nav-link navlink' href='login.php'>Login</a>
          </li>";
        }else{
            echo "<li class='nav-item'>
            <a class='nav-link navlink' href='../logout/logout.php'>Logout</a>
          </li>";

        }
        ?>
    </div>
</nav>
</div>

<!--New Launches carousels-->
<div class="container-fluid p-0">
<div id="carousel" class="carousel slide" data-bs-ride="carousel" data-ride="false">
      <div class="carousel-inner text-center">
        <div class="carousel-item active carousel-image bg-img-1">
            <img src="../images/newlaunch1.png" alt="">
        </div>
        <div class="carousel-item carousel-image bg-img-2">
        <img src="../images/newlaunch1.png" alt="">
        </div> 
        <div class="carousel-item carousel-image bg-img-3">
        <img src="../images/newlaunch1.png" alt="">
        </div> 
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
</div>

<!--Simply-->
<div class="text-center p-2">
    <h1>Mr.Mobile</h1>
    <p>A Universal Mobile Store</p>
</div>
<!--Product details-->

<div class="container-fluid p-0">
    <div class="row text-center">
        <div class="col-md-1 brands p-0">
        <ul class="navbar-nav me-auto text-center">
        <li class="nav-item brand-head">
          <!--brands list!-->
          <a class="nav-link text-light" href="#"><h4>Brands</h4></a>
        </li>
        <?php
         getbrands(); 
         ?>
        </ul>

        </div>
        <div class="col-md-10">
            <div class="row">
                <?php
                if (isset($_GET['message'])) {
                  $errors = $_GET['message'];
                  // Display the message in a popup or any desired format
                  echo "<div class='alert alert-success text-center'>$errors</div>";
              }
                getproducts();
                get_unique_brand();
                get_unique_category();
                get_all_products();
                searchproducts();
                get_viewmore();
                $user_id = $_SESSION['user_id'];
                cart($user_id);  
                
                ?>
            </div>
        </div>
        <div class="col-md-1 category p-0">
        <ul class="navbar-nav me-auto text-center">
        <li class="nav-item category-head"><!--Category list!-->
          <a class="nav-link text-light" href="#"><h4>Category</h4></a>
        </li>
        <?php getcategory(); ?>
        </ul>
        </div>

    </div>

</div>
<div class="bg-secondary p-3 text-center">
  <p class="text-light">All rights reserved ©-Designed By SARAVANAN. J -2023</p>

</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 <!--AOS js-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
      </script>
</body>
</html>