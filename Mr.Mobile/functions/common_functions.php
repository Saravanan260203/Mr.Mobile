<?php include_once "../include/connect.php";




//get brands in side nav

function getbrands(){
    global $con;
 $select_brands="SELECT * FROM brand";
     $res=mysqli_query($con,$select_brands);
     
     
     while($row_data=mysqli_fetch_assoc($res)){
       $brand_name=$row_data['brand_name'];
       $brand_id=$row_data['brand_id'];

       echo "<li class='nav-item'>
       <a class='nav-link navlink' href='index.php?brand=$brand_name'>$brand_name</a>
     </li>";


     }
}

//to get category in sidenav
function getcategory(){

 global $con;
 $select_cat="SELECT * FROM category";
     $res=mysqli_query($con,$select_cat);
     
     
     while($row_data=mysqli_fetch_assoc($res)){
       $cat_name=$row_data['category_name'];
       $cat_id=$row_data['category_id'];

       echo "<li class='nav-item'>
       <a class='nav-link navlink' href='index.php?Category=$cat_name'>$cat_name</a>
     </li>";


     }
}

//to get products


  function getproducts(){
    global $con;
    if(!isset($_GET['Category'])){
      if(!isset($_GET['brand'])){
        if(!isset($_GET['get_all_products'])){
          if(!isset($_GET['search_btn'])){
            if(!isset($_GET['product_name'])){

    $select_products="SELECT * FROM `products` order by rand() limit 0,5";//order by rand() limit 0,9
                   $result=mysqli_query($con,$select_products);

                   while($row_data=mysqli_fetch_assoc($result)){
                    $product_id=$row_data['product_id'];
                    $product_name=$row_data['product_name'];
                    $product_desc=$row_data['product_desc'];
                    $product_key=$row_data['product_keywords'];
                    $mainimage=$row_data['main_image'];
                    $category_name=$row_data['category_name'];
                    $brand_name=$row_data['brand_name'];
                    $price=$row_data['product_price'];

                    echo " <div class='col-lg-3 col-md-4 col-sm-6 col-xs-6'>
                    <div class='card mb-4' id='card' data-aos='flip-right' data-aos-duration='1200'>
                    <img src='../admin_area/product_images/$mainimage' class='card-img-top' alt='$mainimage'>
                    <div class='card-body'>
                      <h5 class='card-title'>$product_name</h5>
                      <p class='card-text'>$product_desc</p>
                      <p class='card-text'><strong>Rs:$price/-</strong></p>
                        <a href='index.php?add_to_cart=$product_name' class='btn btn-info mb-2'><i class='fa-solid fa-cart-shopping'></i> Add to Cart</a>
                        <a href='index.php?product_name=$product_name' class='btn btn-primary mb-2'><i class='fa-sharp fa-solid fa-eye'> </i>View More</a>
                    </div>
                  </div>
        </div>";
                   }
}}}}}}

//getting unique brand

function get_unique_brand(){
  global $con;
  if(isset($_GET['brand'])){
    $brand_name=$_GET['brand'];
  $select_products="SELECT * FROM `products` WHERE brand_name = '$brand_name'";
                 $result=mysqli_query($con,$select_products);
                 $rowcount=mysqli_num_rows($result);
                 if($rowcount==0){
                  echo "<h2 class='text-center text-danger'>Stock not available</h2>";
                 }

                 while($row_data=mysqli_fetch_assoc($result)){
                  $product_id=$row_data['product_id'];
                  $product_name=$row_data['product_name'];
                  $product_desc=$row_data['product_desc'];
                  $product_key=$row_data['product_keywords'];
                  $mainimage=$row_data['main_image'];
                  $category_name=$row_data['category_name'];
                  $brand_name=$row_data['brand_name'];
                  $price=$row_data['product_price'];

                  echo " <div class='col-lg-3 col-md-4 col-sm-6 col-xs-6'>
                  <div class='card mb-4' id='card' data-aos='flip-right' data-aos-duration='1200'>
                  <img src='../admin_area/product_images/$mainimage' class='card-img-top' alt='$mainimage'>
                  <div class='card-body'>
                    <h5 class='card-title'>$product_name</h5>
                    <p class='card-text'>$product_desc</p>
                    <p class='card-text'><strong>Rs:$price/-</strong></p>
                      <a href='index.php?add_to_cart=$product_name' class='btn btn-info mb-2'><i class='fa-solid fa-cart-shopping'></i> Add to Cart</a>
                      <a href='index.php?product_name=$product_name' class='btn btn-primary mb-2'><i class='fa-sharp fa-solid fa-eye'> </i>View More</a>
                  </div>
                </div>
      </div>";
                 }
}}


//getting unique brand

function get_unique_category(){
  global $con;
  if(isset($_GET['Category'])){
    $category_name=$_GET['Category'];
  $select_products="SELECT * FROM `products` WHERE category_name = '$category_name'";
                 $result=mysqli_query($con,$select_products);
                 $rowcount=mysqli_num_rows($result);
                 if($rowcount==0){
                  echo "<h2 class='text-center text-danger'>Stock not available</h2>";
                 }

                 while($row_data=mysqli_fetch_assoc($result)){
                  $product_id=$row_data['product_id'];
                  $product_name=$row_data['product_name'];
                  $product_desc=$row_data['product_desc'];
                  $product_key=$row_data['product_keywords'];
                  $mainimage=$row_data['main_image'];
                  $category_name=$row_data['category_name'];
                  $brand_name=$row_data['brand_name'];
                  $price=$row_data['product_price'];

                  echo " <div class='col-lg-3 col-md-4 col-sm-6 col-xs-6'>
                  <div class='card mb-4' id='card' data-aos='flip-right' data-aos-duration='1200'>
                  <img src='../admin_area/product_images/$mainimage' class='card-img-top' alt='$mainimage'>
                  <div class='card-body'>
                    <h5 class='card-title'>$product_name</h5>
                    <p class='card-text'>$product_desc</p>
                    <p class='card-text'><strong>Rs:$price/-</strong></p>
                      <a href='index.php?add_to_cart=$product_name' class='btn btn-info mb-2'><i class='fa-solid fa-cart-shopping'></i> Add to Cart</a>
                      <a href='index.php?product_name=$product_name' class='btn btn-primary mb-2'><i class='fa-sharp fa-solid fa-eye'> </i>View More</a>
                  </div>
                </div>
      </div>";
                 }
}}


//to get all products


function get_all_products(){
  global $con;
  if(isset($_GET['get_all_products'])){
  $select_products="SELECT * FROM `products` order by rand()";//order by rand()
                 $result=mysqli_query($con,$select_products);

                 while($row_data=mysqli_fetch_assoc($result)){
                  $product_id=$row_data['product_id'];
                  $product_name=$row_data['product_name'];
                  $product_desc=$row_data['product_desc'];
                  $product_key=$row_data['product_keywords'];
                  $mainimage=$row_data['main_image'];
                  $category_name=$row_data['category_name'];
                  $brand_name=$row_data['brand_name'];
                  $price=$row_data['product_price'];

                  echo " <div class='col-lg-3 col-md-4 col-sm-6 col-xs-6'>
                  <div class='card mb-4' id='card' data-aos='flip-right' data-aos-duration='1200'>
                  <img src='../admin_area/product_images/$mainimage' class='card-img-top' alt='$mainimage'>
                  <div class='card-body'>
                    <h5 class='card-title'>$product_name</h5>
                    <p class='card-text'>$product_desc</p>
                    <p class='card-text'><strong>Rs:$price/-</strong></p>
                      <a href='index.php?add_to_cart=$product_name' class='btn btn-info mb-2'><i class='fa-solid fa-cart-shopping'></i> Add to Cart</a>
                      <a href='index.php?product_name=$product_name' class='btn btn-primary mb-2'><i class='fa-sharp fa-solid fa-eye'> </i>View More</a>
                  </div>
                </div>
      </div>";
                 }
}}

//searching products

function searchproducts(){

  global $con;
         if(isset($_GET['search_btn'])){
          $products_search=$_GET['search_products'];
    $select_products="SELECT * FROM `products` WHERE product_keywords like '%$products_search%' ";
                   $result=mysqli_query($con,$select_products);
                   $rowcount=mysqli_num_rows($result);
                   if($rowcount==0){
                    echo "<h2 class='text-center text-danger'>No Results Match!</h2>";
                   }

                   while($row_data=mysqli_fetch_assoc($result)){
                    $product_id=$row_data['product_id'];
                  $product_name=$row_data['product_name'];
                  $product_desc=$row_data['product_desc'];
                  $product_key=$row_data['product_keywords'];
                  $mainimage=$row_data['main_image'];
                  $category_name=$row_data['category_name'];
                  $brand_name=$row_data['brand_name'];
                  $price=$row_data['product_price'];

                  echo " <div class='col-lg-3 col-md-4 col-sm-6 col-xs-6'>
                  <div class='card mb-4' id='card' data-aos='flip-right' data-aos-duration='1200'>
                  <img src='../admin_area/product_images/$mainimage' class='card-img-top' alt='$mainimage'>
                  <div class='card-body'>
                    <h5 class='card-title'>$product_name</h5>
                    <p class='card-text'>$product_desc</p>
                    <p class='card-text'><strong>Rs:$price/-</strong></p>
                      <a href='index.php?add_to_cart=$product_name' class='btn btn-info mb-2'><i class='fa-solid fa-cart-shopping'></i> Add to Cart</a>
                      <a href='index.php?product_name=$product_name' class='btn btn-primary mb-2'><i class='fa-sharp fa-solid fa-eye'> </i>View More</a>
                  </div>
                </div>
      </div>";}}}

function get_viewmore(){
        global $con;
        if(isset($_GET['product_name'])){
        if(!isset($_GET['Category'])){
          if(!isset($_GET['brand'])){
                 $productname=$_GET['product_name'];
        $view_more="SELECT * FROM `products` WHERE product_name='$productname'";
                       $result=mysqli_query($con,$view_more);
      
                       while($row_data=mysqli_fetch_assoc($result)){
                        $product_id=$row_data['product_id'];
                        $product_name=$row_data['product_name'];
                        $product_desc=$row_data['product_desc'];
                        $product_key=$row_data['product_keywords'];
                        $mainimage=$row_data['main_image'];
                        $image2=$row_data['product_image2'];
                        $image3=$row_data['product_image3'];
                        $category_name=$row_data['category_name'];
                        $brand_name=$row_data['brand_name'];
                        $price=$row_data['product_price'];
      
                        echo " <h2>More Images</h2>
                        <div class='col-md-6 col-sm-12 col-xs-12'>
                        <div class='card mb-4' style='align-items: center;'>
                        <img src='../admin_area/product_images/$mainimage' class='card-img-top' style='height:50%; width:50%;
                        object-fit:contain;'>
                      </div>
                      </div>
      
      
                      <div class='col-md-6 col-sm-12 col-xs-12'>
                        <div class='card mb-4' style='align-items: center;'> 
                        <img src='../admin_area/product_images/$image2' class='card-img-top' style='height:50%; width:50%;
                        object-fit:contain;'>
                      </div>
                      </div>
      
                      <div class='col-md-6 col-sm-12 col-xs-12'>
                        <div class='card mb-4' style='align-items: center;'> 
                        <img src='../admin_area/product_images/$image3' class='card-img-top' style='height:250px; width:350px;
                        object-fit:contain;'>
                      </div>
                      </div>
                  
            
            ";
                       }
      }}
      
      }}

//get ip address function

function getIPAddress() {  
  //whether ip is from the share internet  
   if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
              $ip = $_SERVER['HTTP_CLIENT_IP'];  
      }  
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
   }  
//whether ip is from the remote address  
  else{  
           $ip = $_SERVER['REMOTE_ADDR'];  
   }  
   return $ip;  
}  
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip;  


function cart($user_id) {
  if(isset($_GET['add_to_cart'])) {
    global $con;
    $user_ip_add = getIPAddress();  
    $get_product_name = $_GET['add_to_cart'];
    
    // Check if the product is already added to the cart
    $select = "SELECT * FROM `cart_details` WHERE user_id ='$user_id' AND product_name='$get_product_name'"; 
    $result = mysqli_query($con, $select);
    $num_of_rows = mysqli_num_rows($result);
    
    if($num_of_rows > 0) {
      echo "<script>alert('Already Added to Cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    } else {
      $select_products = "SELECT * FROM `products` WHERE product_name = '$get_product_name'";
      $select_result = mysqli_query($con, $select_products);
      $row_data = mysqli_fetch_assoc($select_result);
      $product_price = $row_data['product_price'];
      
      // Insert the product into the cart_details table
      $insert = "INSERT INTO `cart_details` (product_name, ip_address, product_price, user_id) 
      VALUES ('$get_product_name', '$user_ip_add', '$product_price', '$user_id')";
      $result = mysqli_query($con, $insert);
      
      if($result) {
        // Retrieve the newly inserted row from the cart_details table
        $select_cart = "SELECT * FROM `cart_details` WHERE product_name = '$get_product_name'";
        $select_result = mysqli_query($con, $select_cart);
        $row_data = mysqli_fetch_assoc($select_result);
        $quantity = $row_data['quantity'];
        
        // Calculate the new subtotal
        $new_subtotal = $product_price * $quantity;
        
        // Update the subtotal in the database
        $update_subtotal_query = "UPDATE `cart_details` SET subtotal='$new_subtotal' WHERE product_name='$get_product_name'";
        $update_subtotal_result = mysqli_query($con, $update_subtotal_query);
        
        if ($update_subtotal_result) {
          //echo "<script>alert('Product Added to Cart Successfully!')</script>";
          //echo "<script>alert('Subtotal Updated Successfully!')</script>";
          echo "<script>window.open('index.php','_self')</script>";
        } else {
          echo "<script>alert('Failed to Update Subtotal')</script>";
          echo "<script>window.open('index.php','_self')</script>";
        }
      }
    }
  }
}


function no_of_cart() {
  global $con;
  $user_ip_add = getIPAddress();
  
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $select = "SELECT * FROM `cart_details` WHERE user_id = '$user_id'";
  } else {
    $select = "SELECT * FROM `cart_details` WHERE ip_address = '$user_ip_add' AND user_id=''";
  }
  
  $result = mysqli_query($con, $select);
  $num_of_rows = mysqli_num_rows($result);
  
  echo $num_of_rows;
}


   //total cart price

   function total_cart_price() {
    global $con;
    $get_user_ipadd = getIPAddress();
    $subtotal = 0;
  
    if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
      $subtotal_query = "SELECT SUM(subtotal) AS total FROM `cart_details` WHERE user_id='$user_id'";
    } else {
      $subtotal_query = "SELECT SUM(subtotal) AS total FROM `cart_details` WHERE ip_address='$get_user_ipadd' AND user_id=''";
    }
  
    $subtotal_result = mysqli_query($con, $subtotal_query);
    $subtotal_data = mysqli_fetch_assoc($subtotal_result);
    $subtotal = $subtotal_data['total'];
  
    echo $subtotal;
  }
  

// For cart delete button
if (isset($_POST['remove_item'])) {
  $get_product_name = key($_POST['remove_item']);
  $get_user_ipadd=getIPAddress();
  if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
      $sql = "DELETE FROM `cart_details` WHERE user_id='$user_id' AND product_name='$get_product_name'";
  } else {
      $sql = "DELETE FROM `cart_details` WHERE ip_address='$get_user_ipadd' AND product_name='$get_product_name'";
  }
  $res = mysqli_query($con, $sql);
}




//chechout
if(isset($_POST['checkout'])){
  if(!isset($_SESSION['user'])){ //on line controller 127
    header("Location: login.php");
 }
 else{
  
 }
}

if(isset($_POST['place_my_order'])){

  $userid=$_POST['user_id'];
  $amount_due=$_POST['amtdue'];
  $totalproducts=$_POST['totalproducts'];
  $orderstatus="Not Paid";
  $invoice_num=mt_rand();

  $sql="INSERT INTO `user_orders`(`user_id`, `amount_due`, `invoice_number`, `total_products`, `order_status`) 
  VALUES ('$userid','$amount_due','$invoice_num','$totalproducts','$orderstatus')";
$result=mysqli_query($con, $sql);
if(($result)){
  $errors="Order Placed Successfully!";
  header('location: ../any_one_can_access/index.php');
  header('location: ../any_one_can_access/index.php?message=' . urlencode($errors));

  //after placing order delete the cart details of the user
  $delete="DELETE FROM `cart_details` WHERE user_id='$userid'";
  $res=mysqli_query($con,$delete);
  exit();
}
else{
  $errors="Error While Placing Order!";
  header('location: ../admin_area/admin_index.php');
  header('location: admin_index.php?message=' . urlencode($errors));
exit();

}



}




?>