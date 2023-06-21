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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
    <style>
         .product_image{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: center
         }
         .products {
  display: flex;
  
}
#end{
  padding-bottom: 10%;
}

.product_image {
  margin-right: 10px;
}

.product_details {
  display: flex;
  flex-direction: column;

}
.product_info{
    display: flex;
  flex-direction: column;
}
.product_name{
    margin-top: 10px;
    margin-bottom: 0;
}
.product_desc{
    margin-bottom: 0;
}


.qty {
  text-align: center;
  margin-top: 3.5%;
  flex-grow: 1;
}
.price{
  margin-left: 10px;
  margin-top: 3.5%;
}
.address{
    margin-right: 25%;
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
          <a class="nav-link navlink" href="#">Contact</a>
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

<!--Products Choosen-->
<div class="bg-dark mb-0">
  <div class="container-fluid text-center">
    <div class="row">
      <?php
      global $con;
      $select_user_address = "SELECT * FROM `cart_details` WHERE user_id=" . $_SESSION['user_id'];
      $data=mysqli_query($con,$select_user_address);
    $no_of_products=mysqli_num_rows($data);
      
      if ($no_of_products > 0) {
          echo "<h1 class='text-center text-light'>Products Choosen</h1>";

          while ($row_data = mysqli_fetch_assoc($data)) {
              $cart_product_name = $row_data['product_name'];
              $cart_product_price = $row_data['product_price'];
              $cart_product_qty = $row_data['quantity'];
              $cart_product_subtotal = $row_data['subtotal'];

              //to fetch product desc and image from product table
              $sql="SELECT * FROM `products` WHERE product_name ='$cart_product_name'";
              $data=mysqli_query($con,$sql);
              $row_data = mysqli_fetch_assoc($data);
              $product_desc=$row_data['product_desc'];
              $product_image=$row_data['main_image'];
              ?>

              <div class="col-md-6 offset-md-3 mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="products d-flex align-items-center">
                      <img class="product_image" src="../admin_area/product_images/<?php echo $product_image ?>" alt="" height="100px" width="100px">
                      <div class="product_details">
                        <h6 class="product_name"><?php echo $cart_product_name ?></h6>
                        <p style="font-size: smaller;" class="product_desc"><?php echo $product_desc ?></p>
                      </div>
                      
                        <h6 class="qty"><?php echo $cart_product_qty.' x ₹'.$cart_product_price ?></h6>
                        <h6 class="price"><?php echo 'Total:'.$cart_product_subtotal ?></h6>
                    </div>
                  </div>
                </div>
              </div>
              <?php
          } 
      }
      ?>
    </div>
    <?php
    $subtotal = 0;
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

    $subtotal_query = "SELECT SUM(subtotal) AS total FROM `cart_details` WHERE user_id='$user_id'";
    $subtotal_result = mysqli_query($con, $subtotal_query);
    $subtotal_data = mysqli_fetch_assoc($subtotal_result);
    $subtotal = $subtotal_data['total'];
    $_SESSION['subtotal']=$subtotal;
    ?>
    <h3 class="text-primary">Subtotal:<?php echo $_SESSION['subtotal']?></h3>
  </div>



<!--Address Details-->

<div class="bg-dark mt-5">
  <div class="container-fluid text-center">
    <div class="row">
      <?php
      global $con;
      $select_user_address = "SELECT * FROM `users` WHERE user_id=" . $_SESSION['user_id'];
      $data=mysqli_query($con,$select_user_address);
    $row_data = mysqli_fetch_assoc($data);
    $user_address=$row_data['user_address'];
    $user_contact=$row_data['user_contact'];
      ?>
             <h1 class="text-light">Address Details</h1>
              <div class="col-md-6 offset-md-3 mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="Address_details d-flex align-items-center">
                      <div class="address">
                        <p class="product_names"><?php echo '<h6>Address:</h6>'.$user_address ?></p>
                      </div>  
                      <div class="contact">
                      <p class=""><?php echo '<h6>Contact:</h6>'.$user_contact ?></p>   
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    </div>
  </div>
</div>

<div class="container  mt-5" id="end">
  <form action="" method="post">
    <input type="hidden" name="user_id" value="<?php echo $user_id?>">
    <input type="hidden" name="amtdue" value="<?php echo $subtotal?>">
    <input type="hidden" name="totalproducts" value="<?php echo $no_of_products?>">
<?php 

if(isset($_GET['cod'])){
  echo"
  <button type='submit' name='place_my_order' class='btn btn-warning btn-lg btn-block w-100'> Place My Order</button>";
}
if(isset($_GET['online_pay'])){
  echo"<a href='javascript:void(0)' 
  class='btn btn-warning btn-lg btn-block w-100 float-right buy_now' data-amount='4000' data-id='$user_id'
   data-products='$no_of_products'>Pay Now!</a>";
}
?>


  </form>
</div>




<!--razorpay.//-->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$('body').on('click', '.buy_now', function(e){
var totalAmount = $(this).attr("data-amount");
var user_id =  $(this).attr("data-id");
var no_of_products = $(this).attr("data-products");
var options = {
"key": "rzp_test_Ebvi7qnlnvQnO8",
"amount": (totalAmount*100), // 2000 paise = INR 20
"name": "Mr.Mobile",
"description": "Payment",
"image": "../images/Mr.Mobile.png",
"handler": function (response){
$.ajax({
url: 'payment-process.php',
type: 'post',
dataType: 'json',
data: {
razorpay_payment_id: response.razorpay_payment_id ,
 totalAmount : totalAmount ,
 user_id : user_id,
 no_of_products: no_of_products
}, 
success: function (msg) {
window.location.href = 'success.php';
}
});
},
"theme": {
"color": "#7952b3"
}
};
var rzp1 = new Razorpay(options);
rzp1.open();
e.preventDefault();
});
</script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 <!--AOS js-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
      </script>
</body>
</html>