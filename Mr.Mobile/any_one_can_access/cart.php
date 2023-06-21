<?Php include_once "../include/connect.php";
include "../functions/common_functions.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.Mobile</title>
    <style>
         .cart_image{
            height: 100px;
            width: 100px;
            object-fit: contain;
         }
         #carta{
          width: 95%;
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
    <a class="navbar-brand navlink" href="cart.php">Mr.Mobile</a>
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
      </ul>
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
</div>


<!--cart details-->
<div class="bg-light">
    <h1 class="text-center">Cart Items</h1>
    <div class="container">
        <div class="row">
            <?php
            global $con;
            $get_user_ipadd = getIPAddress();

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $check_cart = "SELECT * FROM `cart_details` WHERE user_id='$user_id'";
            } else {
                $check_cart = "SELECT * FROM `cart_details` WHERE ip_address='$get_user_ipadd' AND user_id=''";
            }
            
            $result = mysqli_query($con, $check_cart);
            ?>
              <div class="table-responsive" id="carta">
            <table class="table table-bordered text-center ">
                <form action="" method="post">
                  
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            echo "<thead>
                                    <tr>
                                      <th>Product Name</th>
                                      <th>Product Image</th>
                                      <th>Price(Single)</th>
                                      <th>Quantity</th>
                                      <th>Total Price</th>
                                      <th colspan='2'>Operation</th>
                                    </tr>
                                  </thead>
                                  <tbody>";

                            while ($row_data = mysqli_fetch_assoc($result)) {
                                $cart_product_name = $row_data['product_name'];
                                $cart_product_price = $row_data['product_price'];
                                $cart_product_qty = $row_data['quantity'];
                                $cart_product_subtotal = $row_data['subtotal'];

                              //to fetch product image
                                      $select_product_img="SELECT * FROM `products` WHERE product_name='$cart_product_name'";
                                    $data=mysqli_query($con,$select_product_img);
                                  $row_data = mysqli_fetch_assoc($data);
                                  $product_img=$row_data['main_image'];
                                ?>
                                <tr>
                                    <td><?php echo $cart_product_name ?></td>
                                    <td><img src="../admin_area/product_images/<?php echo $product_img ?>"
                                             alt="image" class="cart_image"></td>
                                    <td><?php echo $cart_product_price ?></td>
                                    <td>
                                        <select class="custom-select mr-sm-2" name="myselect[]">
                                            <option value="1" <?php if ($cart_product_qty == 1) echo 'selected' ?>>
                                                1
                                            </option>
                                            <option value="2" <?php if ($cart_product_qty == 2) echo 'selected' ?>>
                                                2
                                            </option>
                                            <option value="3" <?php if ($cart_product_qty == 3) echo 'selected' ?>>
                                                3
                                            </option>
                                            <option value="4" <?php if ($cart_product_qty == 4) echo 'selected' ?>>
                                                4
                                            </option>
                                            <option value="5" <?php if ($cart_product_qty == 5) echo 'selected' ?>>
                                                5
                                            </option>
                                        </select>
                                    </td>
                                    <td><?php echo $cart_product_subtotal ?></td>
                                    <td>
                                        <input type="hidden" name="product_name[]"
                                               value="<?php echo $row_data['product_name']; ?>">
                                        <input type="submit" class="btn btn-primary" value="Update"
                                               name="update_item[]">
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-danger" value="Remove"
                                               name="remove_item[<?php echo $cart_product_name; ?>]">

                                    </td>
                                </tr>
                                <?php

                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>Cart is Empty</h2>";
                        }
                        ?>
                        </tbody>
                    </table>
              </div>
                    <div class="d-flex">
                        <?php
                        $get_user_ipadd = getIPAddress();
                        if (isset($_POST['update_item'])) {
                            $quantities = $_POST['myselect'];
                            $product_names = $_POST['product_name'];

                            // Loop through the quantities and product names
                            for ($i = 0; $i < count($quantities); $i++) {
                                $quantity = $quantities[$i];
                                $product_name = $product_names[$i];

                                // Update the quantity in the cart_details table
                                $update_cart = "UPDATE `cart_details` SET quantity=$quantity WHERE ip_address='$get_user_ipadd' AND product_name='$product_name'";
                                $result_qty = mysqli_query($con, $update_cart);

                                // Update the subtotal based on the new quantity
                                $select_product = "SELECT * FROM `products` WHERE product_name = '$product_name'";
                                $select_result = mysqli_query($con, $select_product);
                                $row_data = mysqli_fetch_assoc($select_result);
                                $product_price = $row_data['product_price'];
                                $new_subtotal = $product_price * $quantity;

                                // Update the subtotal in the cart_details table
                                $update_subtotal = "UPDATE `cart_details` SET subtotal='$new_subtotal' WHERE user_id='$user_id' AND product_name='$product_name'";
                                $result_subtotal = mysqli_query($con, $update_subtotal);
                            }
                        }

                        // Calculate and display the subtotal
                        $subtotal = 0;
                        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

                        $subtotal_query = "SELECT SUM(subtotal) AS total FROM `cart_details` WHERE ip_address='$get_user_ipadd' AND user_id='$user_id'";
                        $subtotal_result = mysqli_query($con, $subtotal_query);
                        $subtotal_data = mysqli_fetch_assoc($subtotal_result);
                        $subtotal = $subtotal_data['total'];
                        $_SESSION['subtotal']=$subtotal;

                        if ($subtotal > 0) {
                            echo "<strong class='text-primary m-2'><h3>Subtotal: $subtotal</h3></strong>
                                  <input type='submit' value='Continue Shopping' class='btn btn-primary m-2' name='continue_shopping'>
                                  <a href='checkout.php' class='btn btn-success m-2'>Checkout</a>";
                        } else {
                            echo "<input type='submit' value='Continue Shopping' class='btn btn-primary m-2' name='continue_shopping'>";
                        }

                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                        ?>
                    </div>
                </form>
            </table>
        </div>
    </div>
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