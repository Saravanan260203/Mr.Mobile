
<?php
include "../include/connect.php";
require_once "../any_one_can_access/controller.php";
if(!isset($_SESSION['admin'])){
    header("Location: ../any_one_can_access/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel="stylesheet" href="style.css">
 
	<!--Fontawesome-->
    <script src="https://kit.fontawesome.com/9e6d3f1177.js" crossorigin="anonymous"></script>
    <!--Bootstrap Css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <style>
        #maincontent{
            width: 85%;
        }
        @media only screen and (max-width: 768px) {
          .wrapper {
            flex-direction: column;
          }
          
          .wrapper .sidebar {
            width: 100%;
            height: auto;
            position: relative;
          }
          
          .wrapper .main_content {
            margin-left: 0;
          }
          
          .sidebar ul {
            display: none;
          }
          
          .sidebar.active ul {
            display: block;
          }
          
          .sidebar .toggle-btn {
            position: absolute;
            top: 15px;
            right: 10px;
            cursor: pointer;
            color: #fff;
            font-size: 24px;
          }}
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar p-0">
        <h2>Admin</h2>
        <ul class="p-0">
            <li><a href="admin_index.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="admin_index.php?insert_product"><i class="fa-solid fa-circle-plus"></i> Insert Product</a></li>
            <li><a href="admin_index.php?insert_brand"><i class="fa-solid fa-circle-plus"></i> Insert Brand</a></li>
            <li><a href="admin_index.php?insert_categories"><i class="fa-solid fa-circle-plus"></i> Insert Category</a></li>
            <li><a href="admin_index.php?view_products"><i class="fa-solid fa-eye"></i> View/Edit Products</a></li>
            <li><a href="admin_index.php?view_brands"><i class="fa-solid fa-eye"></i> View/Edit Brands</a></li>
            <li><a href="admin_index.php?view_category"><i class="fa-solid fa-eye"></i> View Categories</a></li>
            <li><a href="admin_index.php?list_users"><i class="fa-solid fa-user"></i> List Users</a></li>
            <li><a href="admin_index.php?all_orders"><i class="fa-solid fa-check"></i> All Orders</a></li>
            <li><a href="admin_index.php?all_payments"><i class="fa-solid fa-indian-rupee-sign"></i> All Payments</a></li>
            <li><a href="../any_one_can_access/login.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>

        </ul> 
        <div class="toggle-btn">
            <i class="fas fa-bars"></i>
        </div>
    </div>
    <div class="main_content" id="maincontent">
    <div class="container m-5">
        <?php
        if(isset($_GET['insert_categories'])){
            include("insert_categories.php");
        }
        if(isset($_GET['insert_brand'])){
            include("insert_brand.php");
        }
        if(isset($_GET['insert_product'])){
            include("insert_product.php");
        }
        if(isset($_GET['view_products'])){
            include("view_products.php");
        }
        if (isset($_GET['message'])) {
            $errors = $_GET['message'];
            // Display the message in a popup or any desired format
            echo "<div class='alert alert-danger text-center'>$errors</div>";
        }
        if(isset($_GET['list_users'])){
            include("view_users.php");
        }
        if(isset($_GET['view_brands'])){
            include("view_brands.php");
        }
        if(isset($_GET['view_category'])){
            include("view_category.php");
        }
        if(isset($_GET['all_orders'])){
            include("all_orders.php");
        }
        if(isset($_GET['all_payments'])){
            include("all_payments.php");
        }
        


        ?>

    </div>
    </div>
    </div>
</div>

<!--Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
     
<script>
    const toggleBtn = document.querySelector('.toggle-btn');
    const sidebar = document.querySelector('.sidebar');
    
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
    });
</script>
</body>
</html>



